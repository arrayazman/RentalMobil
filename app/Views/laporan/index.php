<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Filter Laporan
            </div>
            <div class="card-body">
                <form action="/laporan/cetak" method="post" target="_blank">
                    <div class="mb-3">
                        <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
