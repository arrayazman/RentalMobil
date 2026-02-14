<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Rental Mobil <b>Maju Jaya</b></h1>
        <p class="col-md-8 fs-4"> </p>
        <hr class="my-4">
        <p>Silakan pilih menu di bawah ini untuk memulai:</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-start">
            <a href="/pelanggan" class="btn btn-success btn-lg px-4 gap-3">Data Pelanggan</a>
            <a href="/mobil" class="btn btn-primary btn-lg px-4 gap-3">Data Mobil</a>
            <a href="/sewa" class="btn btn-warning btn-lg px-4 gap-3">Transaksi Sewa</a>
            <a href="/pengembalian" class="btn btn-info btn-lg px-4 gap-3">Pengembalian</a>
            <a href="/laporan" class="btn btn-secondary btn-lg px-4 gap-3">Laporan</a>
        </div>
    </div>
</div>

<div class="row align-items-md-stretch">
    <div class="col-md-6">
        <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            <h2>Fitur Utama</h2>
            <ul>
                <li>Manajemen Data Mobil (Stok, Harga)</li>
                <li>Manajemen Data Pelanggan</li>
                <li>Pencatatan Sewa (Otomatis update status mobil)</li>
                <li>Pencatatan Pengembalian (Hitung denda & update status)</li>
                <li>Laporan Riwayat Sewa </li>

            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>