<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index($pesan = NULL)
    {
        $data["pesan_ui"] = $pesan;
        return view('login/auth-login', $data);
    }

    public function cek()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = new UserModel();
        $dataUser = $user->find($username);

        if ($dataUser == NULL) {
            // User tidak ditemukan
            $data["pesan_ui"] = '<div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i> Username tidak ditemukan </div>';
            return view('login/auth-login', $data);
        } else {
            // User ditemukan 
            if ($password == $dataUser->password) {
                // Password benar
                $session = session();
                $session_data =  [
                    "username" => $dataUser->username,
                    "role" => $dataUser->role
                ];
                $session->set($session_data);
                return redirect()->to(base_url("public/home"));
            } else {
                // Password salah
                $data["pesan_ui"] = '<div class="alert alert-danger"><i class="bi bi-file-excel"></i> Password Salah </div>';
                return view('login/auth-login', $data);
            }
        }
    }

    public function register($pesan = NULL)
    {
        $data["pesan_ui"] = $pesan;
        return view('register/auth-regis', $data);
    }

    public function daftar()
    {
        $username = $this->request->getPost('username');

        $user = new UserModel();

        $dataUser = $user->find($username);

        if ($dataUser == NULL) {
            // username bisa digunakan
            $user = new UserModel();
            $dataUser = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama' => $this->request->getPost('nama'),
                'role' => $this->request->getPost('role'),
            ];
            $user->insertData($dataUser);

            $data["pesan_ui"] = '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login</div>';
            return view('register/auth-regis', $data);
        } else {
            // username tidak tersedia
            $data["pesan_ui"] = '<div class="alert alert-danger" role="alert">Username tidak tersedia!</div>';
            return view('register/auth-regis', $data);
        }
    }

    public function terms()
    {
        if ($this->input->post('checkbox')) {
            return TRUE;
        } else {
            $data["pesan_ui"] = '<div class="alert alert-danger" role="alert">Please accept our terms and conditions</div>';
            return view('register/auth-regis', $data);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url("public/Login"));
    }
}
