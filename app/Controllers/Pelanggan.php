<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    /**
     * Mengelola Data Pelanggan (CRUD).
     * Fitur: List pelanggan, input data pelanggan baru, edit, dan hapus.
     */
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pelanggan',
            'pelanggans' => $this->pelangganModel->findAll()
        ];

        return view('pelanggan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pelanggan',
            'validation' => \Config\Services::validation()
        ];

        return view('pelanggan/create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->pelangganModel->getValidationRules())) {
            return redirect()->to('/pelanggan/create')->withInput();
        }

        $this->pelangganModel->save([
            'nama' => $this->request->getVar('nama'),
            'no_ktp' => $this->request->getVar('no_ktp'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
        ]);

        session()->setFlashdata('success', 'Data pelanggan berhasil ditambahkan.');
        return redirect()->to('/pelanggan');
    }

    public function edit($id)
    {
        $pelanggan = $this->pelangganModel->find($id);
        if (!$pelanggan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelanggan tidak ditemukan: ' . $id);
        }

        $data = [
            'title' => 'Edit Pelanggan',
            'pelanggan' => $pelanggan,
            'validation' => \Config\Services::validation()
        ];

        return view('pelanggan/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->pelangganModel->getValidationRules())) {
            return redirect()->to('/pelanggan/edit/' . $id)->withInput();
        }

        $this->pelangganModel->save([
            'id_pelanggan' => $id,
            'nama' => $this->request->getVar('nama'),
            'no_ktp' => $this->request->getVar('no_ktp'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
        ]);

        session()->setFlashdata('success', 'Data pelanggan berhasil diubah.');
        return redirect()->to('/pelanggan');
    }

    public function delete($id)
    {
        try {
            $this->pelangganModel->delete($id);
            session()->setFlashdata('success', 'Data pelanggan berhasil dihapus.');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', 'Gagal menghapus data. Pelanggan ini sedang menyewa mobil atau memiliki riwayat transaksi.');
        }

        return redirect()->to('/pelanggan');
    }

    public function cetak()
    {
        $data = [
            'pelanggans' => $this->pelangganModel->findAll()
        ];
        return view('pelanggan/cetak', $data);
    }
}
