<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MobilModel;

class Mobil extends BaseController
{
    /**
     * Mengelola Data Mobil (CRUD).
     * Fitur: List mobil, tambah mobil baru, edit data, dan hapus mobil.
     */
    protected $mobilModel;

    public function __construct()
    {
        $this->mobilModel = new MobilModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Mobil',
            'mobils' => $this->mobilModel->findAll()
        ];

        return view('mobil/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Mobil',
            'validation' => \Config\Services::validation()
        ];

        return view('mobil/create', $data);
    }

    public function store()
    {
        $rules = [
            'no_polisi' => 'required|is_unique[mobils.no_polisi]',
            'merk'      => 'required',
            'tipe'      => 'required',
            'harga_per_hari' => 'required|numeric',
            'status'    => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/mobil/create')->withInput();
        }

        $this->mobilModel->save([
            'no_polisi' => $this->request->getVar('no_polisi'),
            'merk' => $this->request->getVar('merk'),
            'tipe' => $this->request->getVar('tipe'),
            'harga_per_hari' => $this->request->getVar('harga_per_hari'),
            'status' => $this->request->getVar('status'),
        ]);

        session()->setFlashdata('success', 'Data mobil berhasil ditambahkan.');
        return redirect()->to('/mobil');
    }

    public function edit($id)
    {
        $mobil = $this->mobilModel->find($id);
        if (!$mobil) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data mobil tidak ditemukan: ' . $id);
        }

        $data = [
            'title' => 'Edit Mobil',
            'mobil' => $mobil,
            'validation' => \Config\Services::validation()
        ];

        return view('mobil/edit', $data);
    }

    public function update($id)
    {
        // Custom validation for unique rule (ignore current record)
        $rules = [
            'no_polisi' => "required|is_unique[mobils.no_polisi,id_mobil,{$id}]",
            'merk'      => 'required',
            'tipe'      => 'required',
            'harga_per_hari' => 'required|numeric',
            'status'    => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/mobil/edit/' . $id)->withInput();
        }

        $this->mobilModel->save([
            'id_mobil' => $id,
            'no_polisi' => $this->request->getVar('no_polisi'),
            'merk' => $this->request->getVar('merk'),
            'tipe' => $this->request->getVar('tipe'),
            'harga_per_hari' => $this->request->getVar('harga_per_hari'),
            'status' => $this->request->getVar('status'),
        ]);

        session()->setFlashdata('success', 'Data mobil berhasil diubah.');
        return redirect()->to('/mobil');
    }

    public function delete($id)
    {
        try {
            $this->mobilModel->delete($id);
            session()->setFlashdata('success', 'Data mobil berhasil dihapus.');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
             session()->setFlashdata('error', 'Gagal menghapus data. Mobil ini sedang disewa atau memiliki riwayat transaksi.');
        }

        return redirect()->to('/mobil');
    }
}