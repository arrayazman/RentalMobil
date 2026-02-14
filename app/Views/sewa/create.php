<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="/sewa/store" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                <select class="form-select <?= (session('errors.pelanggan_id')) ? 'is-invalid' : '' ?>" id="pelanggan_id" name="pelanggan_id">
                    <option value="" selected disabled>Pilih Pelanggan</option>
                    <?php foreach ($pelanggans as $p) : ?>
                        <option value="<?= $p['id_pelanggan'] ?>" <?= (old('pelanggan_id') == $p['id_pelanggan']) ? 'selected' : '' ?>><?= $p['nama'] ?> (<?= $p['no_ktp'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.pelanggan_id') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="mobil_id" class="form-label">Mobil</label>
                <select class="form-select <?= (session('errors.mobil_id')) ? 'is-invalid' : '' ?>" id="mobil_id" name="mobil_id">
                    <option value="" selected disabled>Pilih Mobil</option>
                    <?php foreach ($mobils as $m) : ?>
                        <option value="<?= $m['id_mobil'] ?>" <?= (old('mobil_id') == $m['id_mobil']) ? 'selected' : '' ?>><?= $m['merk'] ?> - <?= $m['tipe'] ?> (Rp <?= number_format($m['harga_per_hari']) ?>/hari)</option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.mobil_id') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="tgl_sewa" class="form-label">Tanggal Sewa</label>
                <input type="date" class="form-control <?= (session('errors.tgl_sewa')) ? 'is-invalid' : '' ?>" id="tgl_sewa" name="tgl_sewa" value="<?= old('tgl_sewa', date('Y-m-d')) ?>">
                 <div class="invalid-feedback">
                    <?= session('errors.tgl_sewa') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="lama_sewa" class="form-label">Lama Sewa (Hari)</label>
                <input type="number" class="form-control <?= (session('errors.lama_sewa')) ? 'is-invalid' : '' ?>" id="lama_sewa" name="lama_sewa" value="<?= old('lama_sewa') ?>">
                 <div class="invalid-feedback">
                    <?= session('errors.lama_sewa') ?>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/sewa" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
