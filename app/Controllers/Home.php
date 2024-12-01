<?php

namespace App\Controllers;

use App\Models\userModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function login(){
        session();
        $data = [
            'validation' => session()->getFlashdata('validation')
        ];
        
        return view('login', $data);
    }

    public function regis(){
        session();
        $data = [
            'validation' => session()->getFlashdata('validation')
        ];
        
        return view('register', $data);
    }
    

    public function save()
    {
        $user = new userModel();
    
        // Validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'is_unique[usermember.email]|required|valid_email',
                'errors' => [
                    'is_unique' => '{field} sudah digunakan',
                    'required' => '{field} belum diisi',
                    'valid_email' => 'masukan {field} anda dengan benar'
                ],
            ],
            'pass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('user')->withInput()->with('validation', $validation);
        }
    
        // Simpan data ke database
        $user->save([
            'email' => $this->request->getVar('email'),
            'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT), // Hash password
        ]);
    
        // Set flashdata
        $email = $this->request->getVar('email');
        session()->setFlashdata('pesan', "Akun anda Berhasil ditambahkan, Silahkan Login");
    
        return redirect()->to('/user/login');
    }

    public function loginProses(){
        $session = session();
        $model = new userModel();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $actor = $model->where('email', $email)->first();

        if($actor){
            if(password_verify($password, $actor['pass'])){
                $session->set([
                    'id' => $actor['id_user'],
                    'email' => $actor['email'],
                    'isLoggedIn' => true
                ]);
                $session->setFlashdata('pesan', "Welcome {$actor['email']}");
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('user/login')->with('error', 'Password salah!');
            }
        }else {
            return redirect()->to('user/login')->with('error', 'Username tidak ditemukan!');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/user/login');
    }
    
}
