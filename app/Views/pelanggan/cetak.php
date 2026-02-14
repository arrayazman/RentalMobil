<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .no-print { margin-top: 20px; text-align: center; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Laporan Data Pelanggan</h2>
    <p>Tanggal Cetak: <?= date('d F Y') ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No KTP</th>
                <th>Alamat</th>
                <th>No HP</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="no-print">
        <button onclick="window.print()">Cetak</button>
        <button onclick="window.close()">Tutup</button>
    </div>

</body>
</html>
