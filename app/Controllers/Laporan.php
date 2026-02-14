<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SewaModel;

class Laporan extends BaseController
{
    /**
     * Modul Laporan.
     * Fitur: Memfilter data sewa berdasarkan rentang tanggal dan mencetak rekap laporan.
     */
    protected $sewaModel;

    public function __construct()
    {
        $this->sewaModel = new SewaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Sewa',
            'sewas' => [] 
        ];
        return view('laporan/index', $data);
    }

    public function cetak()
    {
        $tgl_awal = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $sewas = $this->sewaModel->select('sewas.*, mobils.no_polisi, mobils.merk, pelanggans.nama as nama_pelanggan, pengembalians.tgl_kembali, pengembalians.denda')
            ->join('mobils', 'mobils.id_mobil = sewas.mobil_id')
            ->join('pelanggans', 'pelanggans.id_pelanggan = sewas.pelanggan_id')
            ->join('pengembalians', 'pengembalians.sewa_id = sewas.id_sewa', 'left') // Left join to show rentals not yet returned
            ->where('sewas.tgl_sewa >=', $tgl_awal)
            ->where('sewas.tgl_sewa <=', $tgl_akhir)
            ->findAll();

        $data = [
            'title' => 'Laporan Sewa Mobil',
            'sewas' => $sewas,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ];

        return view('laporan/cetak', $data);
    }
}
