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
                'rules' => 'is_unique[pemilikToko.email]|required|valid_email',
                'errors' => [
                    'is_unique' => '{field} sudah digunakan',
                    'required' => '{field} belum diisi',
                    'valid_email' => 'masukan {field} anda dengan benar'
                ],
            ],
            'pass' => [
                'rules' => 'required|min_length[7]|regex_match[/^[A-Za-z0-9]*$/]',
                'errors' => [
                    'required' => 'password belum diisi',
                    'min_length' => 'password minimal 7 karakter',
                    'regex_match' => 'password tidak mengunakan karakter khusus'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('user')->withInput()->with('validation', $validation);
        }
    
        // Simpan data ke database
        $user->save([
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT), // Hash password
            'namaToko' => 'tokosaya.co',
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

        $user = $model->where('email', $email)->first();

        if($user){
            if(password_verify($password, $user['password'])){
                $session->set([
                    'id' => $user['idPemilik'],
                    'email' => $user['email'],
                    'isLoggedIn' => true
                ]);
                $idUser = $user['idPemilik'];

                $tanggal = $user['tanggalAkhir'];
                $tanggalSekarang = date('Y-m-d');

                $tanggalAkhir = strtotime($tanggal);
                $tanggalSekarang = strtotime($tanggalSekarang);

                $tanggal = ([
                    'tanggalAkhir' => $tanggalAkhir,
                    'tanggalSekarang' => $tanggalSekarang
                ]);

                $data = ([
                    'status' => 'tidakAktif'
                ]);

                if($tanggalAkhir < $tanggalSekarang){
                    $model->update($user['idPemilik'], $data);
                }
                $session->setFlashdata('pesan', "Welcome {$user['email']}");
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
