<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/mobil/create" class="btn btn-sm btn-primary">Tambah Mobil</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Polisi</th>
                <th scope="col">Merk</th>
                <th scope="col">Tipe</th>
                <th scope="col">Harga / Hari</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mobils as $k => $m) : ?>
                <tr>
                    <td><?= $k + 1 ?></td>
                    <td><?= $m['no_polisi'] ?></td>
                    <td><?= $m['merk'] ?></td>
                    <td><?= $m['tipe'] ?></td>
                    <td>Rp <?= number_format($m['harga_per_hari'], 0, ',', '.') ?></td>
                    <td>
                        <span class="badge bg-<?= ($m['status'] == 'tersedia') ? 'success' : 'secondary' ?>">
                            <?= $m['status'] ?>
                        </span>
                    </td>
                    <td>
                        <a href="/mobil/edit/<?= $m['id_mobil'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/mobil/delete/<?= $m['id_mobil'] ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
