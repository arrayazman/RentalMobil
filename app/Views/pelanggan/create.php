<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="/pelanggan/store" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nama') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="no_ktp" class="form-label">No KTP</label>
                <input type="text" class="form-control <?= (session('errors.no_ktp')) ? 'is-invalid' : '' ?>" id="no_ktp" name="no_ktp" value="<?= old('no_ktp') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.no_ktp') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat"><?= old('alamat') ?></textarea>
                 <div class="invalid-feedback">
                    <?= session('errors.alamat') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control <?= (session('errors.no_hp')) ? 'is-invalid' : '' ?>" id="no_hp" name="no_hp" value="<?= old('no_hp') ?>">
                 <div class="invalid-feedback">
                    <?= session('errors.no_hp') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/pelanggan" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
