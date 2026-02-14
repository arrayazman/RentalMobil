<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Controller Halaman Utama (Dashboard).
     * Menampilkan menu akses cepat ke fitur-fitur aplikasi.
     */
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('home/index', $data);
    }
}