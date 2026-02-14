<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Sewa Mobil</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; border: 1px solid #ccc; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 5px; }
        .total-box { text-align: right; margin-top: 20px; font-size: 18px; font-weight: bold; }
        .signature { margin-top: 50px; text-align: right; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
        @media print {
            .no-print { display: none; }
            .container { border: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <div class="title">KWITANSI PEMBAYARAN</div>
            <div>Rental Mobil Maju Jaya</div>
            <div>Jl. Kebon Jeruk No. 123, Jakarta</div>
        </div>

        <table class="info-table">
            <tr>
                <td width="200">No. Kwitansi</td>
                <td>: #KW-<?= str_pad($sewa['id_sewa'], 5, '0', STR_PAD_LEFT) ?></td>
            </tr>
            <tr>
                <td>Tanggal Sewa</td>
                <td>: <?= date('d F Y', strtotime($sewa['tgl_sewa'])) ?></td>
            </tr>
            <tr>
                <td>Telah Terima Dari</td>
                <td>: <strong><?= $sewa['nama_pelanggan'] ?></strong></td>
            </tr>
             <tr>
                <td>Untuk Pembayaran</td>
                <td>: Sewa Mobil <?= $sewa['merk'] ?> (<?= $sewa['no_polisi'] ?>)</td>
            </tr>
             <tr>
                <td>Lama Sewa</td>
                <td>: <?= $sewa['lama_sewa'] ?> Hari</td>
            </tr>
        </table>

        <div class="total-box">
            Total Bayar: Rp <?= number_format($sewa['total_biaya'], 0, ',', '.') ?>,-
        </div>

        <div class="signature">
            <p>Jakarta, <?= date('d F Y') ?></p>
            <br><br><br>
            <p>( Admin )</p>
        </div>

        <div class="footer">
            Terima kasih atas kepercayaan Anda menggunakan jasa kami.
        </div>
        
        <div class="no-print" style="margin-top: 20px; text-align: center;">
            <button onclick="window.print()">Cetak</button>
            <button onclick="window.close()">Tutup</button>
        </div>
    </div>
</body>
</html>
