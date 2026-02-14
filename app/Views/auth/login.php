<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Rental Mobil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: linear-gradient(135deg, #1f2933, #2d3748);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .login-header {
        background: #111827;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .login-header h4 {
        margin: 0;
        font-weight: 600;
    }

    .login-body {
        padding: 30px;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
    }

    .btn-login {
        background-color: #2563eb;
        border: none;
        border-radius: 8px;
        padding: 10px;
        font-weight: 500;
    }

    .btn-login:hover {
        background-color: #1d4ed8;
    }

    .brand-name {
        font-weight: 700;
        color: #facc15;
    }
    </style>
</head>

<body>

    <div class="col-md-4 col-sm-10">
        <div class="card shadow-lg login-card">

            <div class="login-header">
                <h4>Rental Mobil <span class="brand-name">Maju Jaya</span></h4>
                <small>Silakan login untuk melanjutkan</small>
            </div>

            <div class="login-body">

                <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                            required>
                    </div>

                    <button class="btn btn-login w-100 text-white">
                        Login
                    </button>

                </form>
            </div>
        </div>
    </div>

</body>

</html>