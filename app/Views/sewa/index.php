<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/sewa/create" class="btn btn-sm btn-primary">Tambah Sewa</a>
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
                <th scope="col">Lama (Hari)</th>
                <th scope="col">Total Biaya</th>
                <th scope="col">Tgl Kembali</th>
                <th scope="col">Denda</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sewas as $k => $s) : ?>
            <tr>
                <td><?= $k + 1 ?></td>
                <td><?= $s['nama_pelanggan'] ?></td>
                <td><?= $s['merk'] ?> - <?= $s['no_polisi'] ?></td>
                <td><?= date('d-m-Y', strtotime($s['tgl_sewa'])) ?></td>
                <td><?= $s['lama_sewa'] ?></td>
                <td>Rp <?= number_format($s['total_biaya'], 0, ',', '.') ?></td>
                <td>
                    <?php if ($s['tgl_kembali']) : ?>
                        <?= date('d-m-Y', strtotime($s['tgl_kembali'])) ?>
                    <?php else : ?>
                        <span class="badge bg-warning text-dark">Belum</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($s['denda'] > 0) : ?>
                        <span class="text-danger">Rp <?= number_format($s['denda'], 0, ',', '.') ?></span>
                    <?php elseif($s['tgl_kembali']) : ?>
                        -
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/sewa/kwitansi/<?= $s['id_sewa'] ?>" target="_blank" class="btn btn-info btn-sm">Cetak</a>
                    <a href="/sewa/edit/<?= $s['id_sewa'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="/sewa/delete/<?= $s['id_sewa'] ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>