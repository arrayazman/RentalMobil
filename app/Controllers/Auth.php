<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // If already logged in, redirect to home
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            // Since we seeded with password_hash, use password_verify
            $verify_pass = password_verify($password, $pass);
            
            // For older simple md5/plain text if necessary, but we stick to secure one
            // $verify_pass = ($password == $pass);

            if ($verify_pass) {
                $ses_data = [
                    'id'       => $data['id'],
                    'username' => $data['username'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('error', 'Password Salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}