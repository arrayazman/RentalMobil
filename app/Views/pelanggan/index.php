<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/pelanggan/cetak" target="_blank" class="btn btn-sm btn-secondary me-2">Cetak Data Pelanggan</a>
        <a href="/pelanggan/create" class="btn btn-sm btn-primary">Tambah Pelanggan</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">No KTP</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pelanggans as $k => $p) : ?>
            <tr>
                <td><?= $k + 1 ?></td>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['no_ktp'] ?></td>
                <td><?= $p['alamat'] ?></td>
                <td><?= $p['no_hp'] ?></td>
                <td>
                    <a href="/pelanggan/edit/<?= $p['id_pelanggan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="/pelanggan/delete/<?= $p['id_pelanggan'] ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>