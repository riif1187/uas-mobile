@extends('layout.app')

@section('title', 'Edit Referensi Kejuaraan')

@section('content')
    <div class="card-body p-4">
        <h3 class="title-page mb-4">Edit Referensi Kejuaraan</h3>

        <form action="{{ route('referensi-kejuaraan.update', $referensi->ref_id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_kejuaraan" class="form-label">Nama Kejuaraan</label>
                        <input type="text" id="nama_kejuaraan" name="nama_kejuaraan"
                            class="form-control @error('nama_kejuaraan') is-invalid @enderror"
                            value="{{ old('nama_kejuaraan', $referensi->nama_kejuaraan) }}" required>
                        @error('nama_kejuaraan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bobot_poin" class="form-label">Bobot Poin</label>
                        <input type="number" id="bobot_poin" name="bobot_poin"
                            class="form-control @error('bobot_poin') is-invalid @enderror"
                            value="{{ old('bobot_poin', $referensi->bobot_poin) }}" min="0" required>
                        @error('bobot_poin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update
                </button>
                <a href="{{ route('referensi-kejuaraan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection
