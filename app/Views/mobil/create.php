<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="/mobil/store" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="no_polisi" class="form-label">No Polisi</label>
                <input type="text" class="form-control <?= (session('errors.no_polisi')) ? 'is-invalid' : '' ?>" id="no_polisi" name="no_polisi" value="<?= old('no_polisi') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.no_polisi') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="merk" class="form-label">Merk</label>
                <input type="text" class="form-control <?= (session('errors.merk')) ? 'is-invalid' : '' ?>" id="merk" name="merk" value="<?= old('merk') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.merk') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <input type="text" class="form-control <?= (session('errors.tipe')) ? 'is-invalid' : '' ?>" id="tipe" name="tipe" value="<?= old('tipe') ?>">
                 <div class="invalid-feedback">
                    <?= session('errors.tipe') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="harga_per_hari" class="form-label">Harga per Hari</label>
                <input type="number" class="form-control <?= (session('errors.harga_per_hari')) ? 'is-invalid' : '' ?>" id="harga_per_hari" name="harga_per_hari" value="<?= old('harga_per_hari') ?>">
                 <div class="invalid-feedback">
                    <?= session('errors.harga_per_hari') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="tersedia" <?= (old('status') == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
                    <option value="sedang disewa" <?= (old('status') == 'sedang disewa') ? 'selected' : '' ?>>Sedang Disewa</option>
                    <option value="maintenance" <?= (old('status') == 'maintenance') ? 'selected' : '' ?>>Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/mobil" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
