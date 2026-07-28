<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DataLengkapMahasiswaController;
use App\Http\Controllers\ReferensiKejuaraanController;
use App\Http\Controllers\PendaftaranPrestasiController;
use App\Http\Controllers\CapaianPrestasiController;
use App\Http\Controllers\FuzzyKlasifikasiController;
use App\Models\User;

Route::get('/', function () {
    $count = function ($table, $model) {
        return \Illuminate\Support\Facades\Schema::hasTable($table) ? $model::count() : 0;
    };

    $fuzzyService = new \App\Services\FuzzyPrestasiService();
    $fuzzyResults = $fuzzyService->classifyAll();

    $summary = [
        'sangat' => 0,
        'berprestasi' => 0,
        'cukup' => 0,
        'kurang' => 0,
        'tidak_ada' => 0,
    ];
    foreach ($fuzzyResults as $r) {
        match ($r['label']) {
            'Sangat Berprestasi' => $summary['sangat']++,
            'Berprestasi'        => $summary['berprestasi']++,
            'Cukup Berprestasi'  => $summary['cukup']++,
            'Kurang Berprestasi' => $summary['kurang']++,
            default              => $summary['tidak_ada']++,
        };
    }

    return view('welcome', [
        'totalMahasiswa' => $count('mahasiswa_tabel', \App\Models\Mahasiswa::class),
        'totalDosen' => $count('dosen_tabel', \App\Models\Dosen::class),
        'totalReferensi' => $count('referensi_kejuaraan', \App\Models\ReferensiKejuaraan::class),
        'totalPendaftaran' => $count('pendaftaran_prestasi', \App\Models\PendaftaranPrestasi::class),
        'totalCapaian' => $count('capaian_prestasi', \App\Models\CapaianPrestasi::class),
        'fuzzyResults' => $fuzzyResults,
        'fuzzySummary' => $summary,
    ]);
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('data-mahasiswa');
    }

    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended(route('data-mahasiswa'))
            ->with('success', 'Login berhasil.');
    }

    return back()
        ->withErrors(['email' => 'Email atau password tidak sesuai.'])
        ->onlyInput('email');
})->name('login.store');

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->route('data-mahasiswa');
    }

    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    // Role default saat pendaftaran adalah 'mahasiswa'
    $roleSlug = 'mahasiswa';
    $role = \App\Models\Role::where('slug', $roleSlug)->first();
    
    // Jika role belum ada di database, buatkan (sebagai pengaman)
    if (!$role) {
        $role = \App\Models\Role::create([
            'nama_role' => 'Mahasiswa',
            'slug' => $roleSlug,
            'level_akses' => 1,
            'is_active' => true
        ]);
    }

    $user->roles()->attach($role->id);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route('data-mahasiswa')
        ->with('success', 'Register berhasil. Selamat datang!');
})->name('register.store');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')
        ->with('success', 'Anda sudah logout.');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    // Manajemen User (Admin Only)
    Route::get('/hak-akses/users', [\App\Http\Controllers\UserManagementController::class, 'index'])->name('users.index');
    Route::post('/hak-akses/users/{id}/update-role', [\App\Http\Controllers\UserManagementController::class, 'updateRole'])->name('users.update-role');

    Route::get('/halaman_satu', function () {
        return view('halaman_satu');
    });

    Route::get('/halaman_dua', function () {
        return view('halaman_dua');
    });

    Route::get('create-mahasiswa', [MahasiswaController::class, 'create'])
        ->name('create-mahasiswa')->middleware('can:mahasiswa.create');

    Route::post('simpan-mahasiswa', [MahasiswaController::class, 'store'])
        ->name('store-mahasiswa')->middleware('can:mahasiswa.create');

    Route::get('data-mahasiswa', [MahasiswaController::class, 'index'])
        ->name('data-mahasiswa');

    Route::get('mahasiswa/{NIM}', [MahasiswaController::class, 'show'])
        ->name('show-mahasiswa');

    Route::get('edit-mahasiswa/{NIM}', [MahasiswaController::class, 'edit'])
        ->name('edit-mahasiswa')->middleware('can:mahasiswa.update');

    Route::get('hapus-mahasiswa/{NIM}', [MahasiswaController::class, 'destroy'])
        ->name('hapus-mahasiswa')->middleware('can:mahasiswa.delete');

    Route::put('update-mahasiswa/{NIM}', [MahasiswaController::class, 'update'])
        ->name('update-mahasiswa')->middleware('can:mahasiswa.update');

    // Route Hak Akses - Roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('can:hak-akses.read');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:hak-akses.create');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store')->middleware('can:hak-akses.create');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:hak-akses.update');
    Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('can:hak-akses.update');
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('can:hak-akses.delete');

    // Routes untuk Mata Kuliah
    Route::get('create-mata-kuliah', [MataKuliahController::class, 'create'])
        ->name('mata-kuliah.create')->middleware('can:mata-kuliah.create');

    Route::post('store-mata-kuliah', [MataKuliahController::class, 'store'])
        ->name('mata-kuliah.store')->middleware('can:mata-kuliah.create');

    Route::get('data-mata-kuliah', [MataKuliahController::class, 'index'])
        ->name('mata-kuliah.index');

    Route::get('mata-kuliah/{kode_matkul}', [MataKuliahController::class, 'show'])
        ->name('mata-kuliah.show')
        ->where('kode_matkul', '[^/]+');

    Route::get('edit-mata-kuliah/{kode_matkul}', [MataKuliahController::class, 'edit'])
        ->name('mata-kuliah.edit')
        ->where('kode_matkul', '[^/]+')->middleware('can:mata-kuliah.update');

    Route::put('update-mata-kuliah/{kode_matkul}', [MataKuliahController::class, 'update'])
        ->name('mata-kuliah.update')
        ->where('kode_matkul', '[^/]+')->middleware('can:mata-kuliah.update');

    Route::delete('delete-mata-kuliah/{kode_matkul}', [MataKuliahController::class, 'destroy'])
        ->name('mata-kuliah.destroy')
        ->where('kode_matkul', '[^/]+')->middleware('can:mata-kuliah.delete');

    // Routes untuk Dosen
    Route::get('create-dosen', [DosenController::class, 'create'])
        ->name('dosen.create')->middleware('can:dosen.create');

    Route::post('store-dosen', [DosenController::class, 'store'])
        ->name('dosen.store')->middleware('can:dosen.create');

    Route::get('data-dosen', [DosenController::class, 'index'])
        ->name('dosen.index');

    Route::get('dosen/{NIP}', [DosenController::class, 'show'])
        ->name('dosen.show');

    Route::get('edit-dosen/{NIP}', [DosenController::class, 'edit'])
        ->name('dosen.edit')->middleware('can:dosen.update');

    Route::put('update-dosen/{NIP}', [DosenController::class, 'update'])
        ->name('dosen.update')->middleware('can:dosen.update');

    Route::delete('delete-dosen/{NIP}', [DosenController::class, 'destroy'])
        ->name('dosen.destroy')->middleware('can:dosen.delete');

    // Routes untuk Tahun Akademik
    Route::get('create-tahun-akademik', [TahunAkademikController::class, 'create'])
        ->name('tahun-akademik.create')->middleware('can:tahun-akademik.create');

    Route::post('store-tahun-akademik', [TahunAkademikController::class, 'store'])
        ->name('tahun-akademik.store')->middleware('can:tahun-akademik.create');

    Route::get('data-tahun-akademik', [TahunAkademikController::class, 'index'])
        ->name('tahun-akademik.index');

    Route::get('tahun-akademik/{id}', [TahunAkademikController::class, 'show'])
        ->name('tahun-akademik.show');

    Route::get('edit-tahun-akademik/{id}', [TahunAkademikController::class, 'edit'])
        ->name('tahun-akademik.edit')->middleware('can:tahun-akademik.update');

    Route::put('update-tahun-akademik/{id}', [TahunAkademikController::class, 'update'])
        ->name('tahun-akademik.update')->middleware('can:tahun-akademik.update');

    Route::delete('delete-tahun-akademik/{id}', [TahunAkademikController::class, 'destroy'])
        ->name('tahun-akademik.destroy')->middleware('can:tahun-akademik.delete');

    // Routes untuk Bimbingan
    Route::get('create-bimbingan', [BimbinganController::class, 'create'])
        ->name('bimbingan.create')->middleware('can:bimbingan.create');

    Route::post('store-bimbingan', [BimbinganController::class, 'store'])
        ->name('bimbingan.store')->middleware('can:bimbingan.create');

    Route::get('data-bimbingan', [BimbinganController::class, 'index'])
        ->name('bimbingan.index');

    Route::get('bimbingan/{id}', [BimbinganController::class, 'show'])
        ->name('bimbingan.show');

    Route::get('edit-bimbingan/{id}', [BimbinganController::class, 'edit'])
        ->name('bimbingan.edit')->middleware('can:bimbingan.update');

    Route::put('update-bimbingan/{id}', [BimbinganController::class, 'update'])
        ->name('bimbingan.update')->middleware('can:bimbingan.update');

    Route::delete('delete-bimbingan/{id}', [BimbinganController::class, 'destroy'])
        ->name('bimbingan.destroy')->middleware('can:bimbingan.delete');

    // Routes untuk Data Lengkap Mahasiswa
    Route::get('create-data-lengkap-mahasiswa', [DataLengkapMahasiswaController::class, 'create'])
        ->name('data-lengkap-mahasiswa.create')->middleware('can:data-lengkap-mahasiswa.create');

    Route::post('store-data-lengkap-mahasiswa', [DataLengkapMahasiswaController::class, 'store'])
        ->name('data-lengkap-mahasiswa.store')->middleware('can:data-lengkap-mahasiswa.create');

    Route::get('data-lengkap-mahasiswa', [DataLengkapMahasiswaController::class, 'index'])
        ->name('data-lengkap-mahasiswa.index');

    Route::get('data-lengkap-mahasiswa/{id}', [DataLengkapMahasiswaController::class, 'show'])
        ->name('data-lengkap-mahasiswa.show');

    Route::get('edit-data-lengkap-mahasiswa/{id}', [DataLengkapMahasiswaController::class, 'edit'])
        ->name('data-lengkap-mahasiswa.edit')->middleware('can:data-lengkap-mahasiswa.update');

    Route::put('update-data-lengkap-mahasiswa/{id}', [DataLengkapMahasiswaController::class, 'update'])
        ->name('data-lengkap-mahasiswa.update')->middleware('can:data-lengkap-mahasiswa.update');

    Route::delete('delete-data-lengkap-mahasiswa/{id}', [DataLengkapMahasiswaController::class, 'destroy'])
        ->name('data-lengkap-mahasiswa.destroy')->middleware('can:data-lengkap-mahasiswa.delete');

    // Routes untuk Referensi Kejuaraan
    Route::get('create-referensi-kejuaraan', [ReferensiKejuaraanController::class, 'create'])
        ->name('referensi-kejuaraan.create')->middleware('can:referensi-kejuaraan.create');

    Route::post('store-referensi-kejuaraan', [ReferensiKejuaraanController::class, 'store'])
        ->name('referensi-kejuaraan.store')->middleware('can:referensi-kejuaraan.create');

    Route::get('data-referensi-kejuaraan', [ReferensiKejuaraanController::class, 'index'])
        ->name('referensi-kejuaraan.index');

    Route::get('referensi-kejuaraan/{ref_id}', [ReferensiKejuaraanController::class, 'show'])
        ->name('referensi-kejuaraan.show');

    Route::get('edit-referensi-kejuaraan/{ref_id}', [ReferensiKejuaraanController::class, 'edit'])
        ->name('referensi-kejuaraan.edit')->middleware('can:referensi-kejuaraan.update');

    Route::put('update-referensi-kejuaraan/{ref_id}', [ReferensiKejuaraanController::class, 'update'])
        ->name('referensi-kejuaraan.update')->middleware('can:referensi-kejuaraan.update');

    Route::delete('delete-referensi-kejuaraan/{ref_id}', [ReferensiKejuaraanController::class, 'destroy'])
        ->name('referensi-kejuaraan.destroy')->middleware('can:referensi-kejuaraan.delete');

    // Routes untuk Pendaftaran Prestasi
    Route::get('create-pendaftaran-prestasi', [PendaftaranPrestasiController::class, 'create'])
        ->name('pendaftaran-prestasi.create')->middleware('can:pendaftaran-prestasi.create');

    Route::post('store-pendaftaran-prestasi', [PendaftaranPrestasiController::class, 'store'])
        ->name('pendaftaran-prestasi.store')->middleware('can:pendaftaran-prestasi.create');

    Route::get('data-pendaftaran-prestasi', [PendaftaranPrestasiController::class, 'index'])
        ->name('pendaftaran-prestasi.index');

    Route::get('pendaftaran-prestasi/{id}', [PendaftaranPrestasiController::class, 'show'])
        ->name('pendaftaran-prestasi.show');

    Route::get('edit-pendaftaran-prestasi/{id}', [PendaftaranPrestasiController::class, 'edit'])
        ->name('pendaftaran-prestasi.edit')->middleware('can:pendaftaran-prestasi.update');

    Route::put('update-pendaftaran-prestasi/{id}', [PendaftaranPrestasiController::class, 'update'])
        ->name('pendaftaran-prestasi.update')->middleware('can:pendaftaran-prestasi.update');

    Route::delete('delete-pendaftaran-prestasi/{id}', [PendaftaranPrestasiController::class, 'destroy'])
        ->name('pendaftaran-prestasi.destroy')->middleware('can:pendaftaran-prestasi.delete');

    Route::patch('pendaftaran-prestasi/{id}/verifikasi', [PendaftaranPrestasiController::class, 'verify'])
        ->name('pendaftaran-prestasi.verify')->middleware('can:pendaftaran-prestasi.verify');

    // Routes untuk Capaian Prestasi
    Route::get('create-capaian-prestasi', [CapaianPrestasiController::class, 'create'])
        ->name('capaian-prestasi.create')->middleware('can:capaian-prestasi.create');

    Route::post('store-capaian-prestasi', [CapaianPrestasiController::class, 'store'])
        ->name('capaian-prestasi.store')->middleware('can:capaian-prestasi.create');

    Route::get('data-capaian-prestasi', [CapaianPrestasiController::class, 'index'])
        ->name('capaian-prestasi.index');

    Route::get('capaian-prestasi/{id}', [CapaianPrestasiController::class, 'show'])
        ->name('capaian-prestasi.show');

    Route::get('file-capaian-prestasi/{id}', [CapaianPrestasiController::class, 'file'])
        ->name('capaian-prestasi.file');

    Route::get('edit-capaian-prestasi/{id}', [CapaianPrestasiController::class, 'edit'])
        ->name('capaian-prestasi.edit')->middleware('can:capaian-prestasi.update');

    Route::put('update-capaian-prestasi/{id}', [CapaianPrestasiController::class, 'update'])
        ->name('capaian-prestasi.update')->middleware('can:capaian-prestasi.update');

    Route::delete('delete-capaian-prestasi/{id}', [CapaianPrestasiController::class, 'destroy'])
        ->name('capaian-prestasi.destroy')->middleware('can:capaian-prestasi.delete');

    Route::get('fuzzy-klasifikasi', [FuzzyKlasifikasiController::class, 'index'])
        ->name('fuzzy-klasifikasi.index');
    Route::post('fuzzy-klasifikasi/refresh', [FuzzyKlasifikasiController::class, 'refresh'])
        ->name('fuzzy-klasifikasi.refresh');
    Route::get('fuzzy-klasifikasi/{NIM}', [FuzzyKlasifikasiController::class, 'show'])
        ->name('fuzzy-klasifikasi.show');
});

Route::get('/fuzzy-grafik', fn () => view('fuzzy-grafik'));
