<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="/pengembalian/update/<?= $pengembalian['id_pengembalian'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_pengembalian" value="<?= $pengembalian['id_pengembalian'] ?>">
            <div class="mb-3">
                <label for="sewa_id" class="form-label">Data Sewa</label>
                <select class="form-select <?= (session('errors.sewa_id')) ? 'is-invalid' : '' ?>" id="sewa_id" name="sewa_id">
                    <option value="" disabled>Pilih Sewa</option>
                    <?php foreach ($sewas as $s) : ?>
                        <option value="<?= $s['id_sewa'] ?>" <?= (old('sewa_id', $pengembalian['sewa_id']) == $s['id_sewa']) ? 'selected' : '' ?>><?= $s['nama'] ?> - <?= $s['merk'] ?> (<?= $s['no_polisi'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.sewa_id') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control <?= (session('errors.tgl_kembali')) ? 'is-invalid' : '' ?>" id="tgl_kembali" name="tgl_kembali" value="<?= old('tgl_kembali', $pengembalian['tgl_kembali']) ?>">
                 <div class="invalid-feedback">
                    <?= session('errors.tgl_kembali') ?>
                </div>
            </div>

            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/pengembalian" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
