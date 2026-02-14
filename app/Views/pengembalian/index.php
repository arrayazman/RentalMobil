<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/pengembalian/create" class="btn btn-sm btn-primary">Tambah Pengembalian</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Mobil</th>
                <th scope="col">Tgl Sewa</th>
                <th scope="col">Tgl Kembali</th>
                <th scope="col">Denda</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengembalians as $k => $p) : ?>
            <tr>
                <td><?= $k + 1 ?></td>
                <td><?= $p['nama_pelanggan'] ?></td>
                <td> <?= $p['no_polisi'] ?></td>
                <td><?= date('d-m-Y', strtotime($p['tgl_sewa'])) ?></td>
                <td><?= date('d-m-Y', strtotime($p['tgl_kembali'])) ?></td>
                <td>Rp <?= number_format($p['denda'], 0, ',', '.') ?></td>
                <td>
                    <a href="/pengembalian/kwitansi/<?= $p['id_pengembalian'] ?>" target="_blank"
                        class="btn btn-info btn-sm">Cetak</a>
                    <a href="/pengembalian/edit/<?= $p['id_pengembalian'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <!-- <form action="/pengembalian/delete/<?= $p['id_pengembalian'] ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                    </form> -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>