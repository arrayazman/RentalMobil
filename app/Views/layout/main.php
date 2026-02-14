<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Mobil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .content-wrapper {
        flex: 1;
    }

    footer {
        background: #111827;
        color: #ccc;
        padding: 15px 0;
        font-size: 14px;
    }

    footer a {
        color: #facc15;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url() ?>">Rental Mobil</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pelanggan') ?>">Data Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('mobil') ?>">Data Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('sewa') ?>">Transaksi Sewa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pengembalian') ?>">Pengembalian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('laporan') ?>">Laporan</a>
                    </li>

                </ul>
            </div>

            <a class="btn btn-danger" href="<?= base_url('logout') ?>">
                Logout
            </a>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="content-wrapper">
        <div class="container">
            <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center">
        <div class="container">
            © <?= date('Y') ?> Rental Mobil Maju Jaya |
            By Muhammad Nuryahya
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>