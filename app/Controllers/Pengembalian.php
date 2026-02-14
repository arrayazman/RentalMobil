<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengembalianModel;
use App\Models\SewaModel;
use App\Models\MobilModel;

class Pengembalian extends BaseController
{
    /**
     * Menangani Proses Pengembalian Mobil.
     * Fitur: Hitung denda keterlambatan (via trigger/db), update status mobil kembali 'tersedia', dan cetak bukti.
     */
    protected $pengembalianModel;
    protected $sewaModel;
    protected $mobilModel;

    public function __construct()
    {
        $this->pengembalianModel = new PengembalianModel();
        $this->sewaModel = new SewaModel();
        $this->mobilModel = new MobilModel();
    }

    public function index()
    {
        $pengembalians = $this->pengembalianModel->select('pengembalians.*, sewas.tgl_sewa, mobils.no_polisi, pelanggans.nama as nama_pelanggan')
            ->join('sewas', 'sewas.id_sewa = pengembalians.sewa_id')
            ->join('mobils', 'mobils.id_mobil = sewas.mobil_id')
            ->join('pelanggans', 'pelanggans.id_pelanggan = sewas.pelanggan_id')
            ->findAll();

        $data = [
            'title' => 'Data Pengembalian',
            'pengembalians' => $pengembalians
        ];

        return view('pengembalian/index', $data);
    }

    public function create()
    {
        // Only show sewa that hasn't been returned yet check logic could be more complex
        // For now, listing all rentals
        $data = [
            'title' => 'Tambah Pengembalian',
            'sewas' => $this->sewaModel->select('sewas.*, pelanggans.nama, mobils.merk, mobils.no_polisi')
                ->join('pelanggans', 'pelanggans.id_pelanggan = sewas.pelanggan_id')
                ->join('mobils', 'mobils.id_mobil = sewas.mobil_id')
                ->where('sewas.id_sewa NOT IN (SELECT sewa_id FROM pengembalians)')
                ->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('pengembalian/create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->pengembalianModel->getValidationRules())) {
            return redirect()->to('/pengembalian/create')->withInput();
        }

        // Check if already returned
        $existingReturn = $this->pengembalianModel->where('sewa_id', $this->request->getVar('sewa_id'))->first();
        if ($existingReturn) {
            session()->setFlashdata('error', 'Data sewa ini sudah dikembalikan.');
            return redirect()->to('/pengembalian/create');
        }

        $this->pengembalianModel->save([
            'sewa_id' => $this->request->getVar('sewa_id'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali')
        ]);

        // Logic to return car status to 'tersedia'
        $sewa = $this->sewaModel->find($this->request->getVar('sewa_id'));
        if($sewa) {
             $this->mobilModel->save([
                'id_mobil' => $sewa['mobil_id'],
                'status' => 'tersedia'
            ]);
        }

        session()->setFlashdata('success', 'Data pengembalian berhasil ditambahkan.');
        return redirect()->to('/pengembalian');
    }

    public function edit($id)
    {
        $pengembalian = $this->pengembalianModel->find($id);
        if (!$pengembalian) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengembalian tidak ditemukan: ' . $id);
        }

        $data = [
            'title' => 'Edit Pengembalian',
            'pengembalian' => $pengembalian,
             'sewas' => $this->sewaModel->select('sewas.*, pelanggans.nama, mobils.merk, mobils.no_polisi')
                ->join('pelanggans', 'pelanggans.id_pelanggan = sewas.pelanggan_id')
                ->join('mobils', 'mobils.id_mobil = sewas.mobil_id')
                ->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('pengembalian/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->pengembalianModel->getValidationRules())) {
            return redirect()->to('/pengembalian/edit/' . $id)->withInput();
        }

        $this->pengembalianModel->save([
            'id_pengembalian' => $id,
             'sewa_id' => $this->request->getVar('sewa_id'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali')
        ]);

        session()->setFlashdata('success', 'Data pengembalian berhasil diubah.');
        return redirect()->to('/pengembalian');
    }

    public function delete($id)
    {
        $this->pengembalianModel->delete($id);
        session()->setFlashdata('success', 'Data pengembalian berhasil dihapus.');
        return redirect()->to('/pengembalian');
    }

    public function kwitansi($id)
    {
        $pengembalian = $this->pengembalianModel->select('pengembalians.*, sewas.tgl_sewa, sewas.total_biaya, mobils.no_polisi, mobils.merk, pelanggans.nama as nama_pelanggan')
            ->join('sewas', 'sewas.id_sewa = pengembalians.sewa_id')
            ->join('mobils', 'mobils.id_mobil = sewas.mobil_id')
            ->join('pelanggans', 'pelanggans.id_pelanggan = sewas.pelanggan_id')
            ->where('pengembalians.id_pengembalian', $id)
            ->first();

        if (!$pengembalian) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengembalian tidak ditemukan: ' . $id);
        }

        $data = [
            'pengembalian' => $pengembalian
        ];

        return view('pengembalian/kwitansi', $data);
    }
}
