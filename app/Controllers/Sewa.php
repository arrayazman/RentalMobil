<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SewaModel;
use App\Models\MobilModel;
use App\Models\PelangganModel;

class Sewa extends BaseController
{
    /**
     * Menangani Transaksi Penyewaan Mobil.
     * Fitur: Input sewa baru, hitung total biaya otomatis, update status mobil, dan cetak kwitansi.
     */
    protected $sewaModel;
    protected $mobilModel;
    protected $pelangganModel;

    public function __construct()
    {
        $this->sewaModel = new SewaModel();
        $this->mobilModel = new MobilModel();
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        // Join with Mobil and Pelanggan for display, and Pengembalian for status
        $sewas = $this->sewaModel->select('sewas.*, mobils.no_polisi, mobils.merk, pelanggans.nama as nama_pelanggan, pengembalians.tgl_kembali, pengembalians.denda')
            ->join('mobils', 'mobils.id_mobil = sewas.mobil_id')
            ->join('pelanggans', 'pelanggans.id_pelanggan = sewas.pelanggan_id')
            ->join('pengembalians', 'pengembalians.sewa_id = sewas.id_sewa', 'left')
            ->findAll();

        $data = [
            'title' => 'Data Sewa',
            'sewas' => $sewas
        ];

        return view('sewa/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Sewa',
            'mobils' => $this->mobilModel->where('status', 'tersedia')->findAll(),
            'pelanggans' => $this->pelangganModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('sewa/create', $data);
    }

    public function store()
    {
        $rules = $this->sewaModel->getValidationRules();
        unset($rules['total_biaya']);

        if (!$this->validate($rules)) {
            return redirect()->to('/sewa/create')->withInput();
        }

        $mobil = $this->mobilModel->find($this->request->getVar('mobil_id'));
        $lama_sewa = $this->request->getVar('lama_sewa');
        $total_biaya = $mobil['harga_per_hari'] * $lama_sewa;

        $this->sewaModel->save([
            'pelanggan_id' => $this->request->getVar('pelanggan_id'),
            'mobil_id' => $this->request->getVar('mobil_id'),
            'tgl_sewa' => $this->request->getVar('tgl_sewa'),
            'lama_sewa' => $lama_sewa,
            'total_biaya' => $total_biaya,
        ]);
        
        // Update status mobil jadi sedang disewa
        $this->mobilModel->save([
            'id_mobil' => $this->request->getVar('mobil_id'),
            'status' => 'sedang disewa'
        ]);

        session()->setFlashdata('success', 'Data sewa berhasil ditambahkan.');
        return redirect()->to('/sewa');
    }

    public function edit($id)
    {
        $sewa = $this->sewaModel->find($id);
        if (!$sewa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data sewa tidak ditemukan: ' . $id);
        }

        $data = [
            'title' => 'Edit Sewa',
            'sewa' => $sewa,
            'mobils' => $this->mobilModel->findAll(),
            'pelanggans' => $this->pelangganModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('sewa/edit', $data);
    }

    public function update($id)
    {
        // Validation rules minus total_biaya because it's calculated
        $rules = $this->sewaModel->getValidationRules();
        unset($rules['total_biaya']);

        if (!$this->validate($rules)) {
            return redirect()->to('/sewa/edit/' . $id)->withInput();
        }

        $mobil = $this->mobilModel->find($this->request->getVar('mobil_id'));
        $lama_sewa = $this->request->getVar('lama_sewa');
        $total_biaya = $mobil['harga_per_hari'] * $lama_sewa;
        
        // Handle logic update logic if necessary (e.g. changing car updates status)
        // For simplicity, we just update the record here.

        $this->sewaModel->save([
            'id_sewa' => $id,
            'pelanggan_id' => $this->request->getVar('pelanggan_id'),
            'mobil_id' => $this->request->getVar('mobil_id'),
            'tgl_sewa' => $this->request->getVar('tgl_sewa'),
            'lama_sewa' => $lama_sewa,
            'total_biaya' => $total_biaya,
        ]);

        session()->setFlashdata('success', 'Data sewa berhasil diubah.');
        return redirect()->to('/sewa');
    }

    public function delete($id)
    {
        // Logic to return car status to 'tersedia' if needed
        $sewa = $this->sewaModel->find($id);
        
        try {
            $this->sewaModel->delete($id);
            // Optional: reset status mobil if needed, but keeping it simple for now
            session()->setFlashdata('success', 'Data sewa berhasil dihapus.');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', 'Gagal menghapus data. Data sewa ini memiliki data pengembalian terkait.');
        }

        return redirect()->to('/sewa');
    }

    public function kwitansi($id)
    {
        $sewa = $this->sewaModel->select('sewas.*, mobils.no_polisi, mobils.merk, pelanggans.nama as nama_pelanggan')
            ->join('mobils', 'mobils.id_mobil = sewas.mobil_id')
            ->join('pelanggans', 'pelanggans.id_pelanggan = sewas.pelanggan_id')
            ->where('sewas.id_sewa', $id)
            ->first();

        if (!$sewa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data sewa tidak ditemukan: ' . $id);
        }

        $data = [
            'sewa' => $sewa
        ];

        return view('sewa/kwitansi', $data);
    }
}
