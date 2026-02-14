<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>Laporan Penyewaan Mobil</h2>
        <p>Periode: <?= date('d-m-Y', strtotime($tgl_awal)) ?> s/d <?= date('d-m-Y', strtotime($tgl_akhir)) ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Mobil</th>
                <th>Tgl Sewa</th>
                <th>Lama</th>
                <th>Total Biaya</th>
                <th>Tgl Kembali</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sewas as $k => $s) : ?>
                <tr>
                    <td><?= $k + 1 ?></td>
                    <td><?= $s['nama_pelanggan'] ?></td>
                    <td><?= $s['merk'] ?> - <?= $s['no_polisi'] ?></td>
                    <td><?= date('d-m-Y', strtotime($s['tgl_sewa'])) ?></td>
                    <td><?= $s['lama_sewa'] ?> Hari</td>
                    <td>Rp <?= number_format($s['total_biaya'], 0, ',', '.') ?></td>
                    <td>
                        <?= $s['tgl_kembali'] ? date('d-m-Y', strtotime($s['tgl_kembali'])) : '-' ?>
                    </td>
                    <td>
                        <?= $s['denda'] ? 'Rp ' . number_format($s['denda'], 0, ',', '.') : '-' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
