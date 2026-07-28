<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Prestasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: #ecf0f1;
            color: #2c3e50;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 2px 12px rgba(44, 62, 80, 0.12);
            overflow: hidden;
        }

        .auth-header {
            background: #2c3e50;
            color: #fff;
            padding: 22px 24px;
        }

        .auth-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .auth-body {
            padding: 24px;
        }

        .form-label {
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.1);
        }

        .btn-auth {
            width: 100%;
            background: #27ae60;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-weight: 600;
            padding: 10px 16px;
        }

        .btn-auth:hover {
            background: #219150;
            color: #fff;
        }

        .auth-link {
            color: #3498db;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-link:hover {
            color: #2980b9;
        }

        .alert {
            border-radius: 4px;
            border-left: 4px solid;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #fadbd8;
            color: #c0392b;
            border-left-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-header">
                <h1><i class="bi bi-person-plus"></i> Register</h1>
            </div>
            <div class="auth-body">
                <?php if (isset($errors) && $errors->any()): ?>
                    <div class="alert alert-danger">
                        <strong><i class="bi bi-exclamation-circle"></i> Terjadi kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach ($errors->all() as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= route('register.store') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors) && $errors->has('name') ? 'is-invalid' : '' ?>"
                            id="name"
                            name="name"
                            value="<?= e(old('name')) ?>"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control <?= isset($errors) && $errors->has('email') ? 'is-invalid' : '' ?>"
                            id="email"
                            name="email"
                            value="<?= e(old('email')) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control <?= isset($errors) && $errors->has('password') ? 'is-invalid' : '' ?>"
                            id="password"
                            name="password"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-auth">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                </form>

                <p class="text-center mt-4 mb-0">
                    Sudah punya akun?
                    <a class="auth-link" href="<?= route('login') ?>">Login</a>
                </p>
                <p class="text-center mt-2 mb-0">
                    <a class="auth-link" href="<?= url('/') ?>">Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
