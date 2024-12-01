<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class dashboard extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Memuat session service
        $this->session = \Config\Services::session();
    }
    public function index(){

        $email = $this->session->get('email');
        $idUser = $this->session->get('id');

        if(!$email){
            return redirect()->to('user');
        }

        $ProdukModel = new ProdukModel();

        //$where = $ProdukModel->where(['id_user' => $idUser])->first();
        //dd($where);
        //$produk = $ProdukModel-> findAll();

        $data = [
            'email' => $email,
            'produk' => $ProdukModel->where(['id_user' => $idUser])->findAll(),
        ];

        echo view('dashboard/navbar', $data);
        echo view('dashboard/dashboard', $data);
    }

    public function formadd(){

        $email = $this->session->get('email');
        $idUser = $this->session->get('id');
        $data = [
            'email' => $email,
            'iduser' => $idUser,
            'validation' => session()->getFlashdata('validation')
        ];
        echo view('dashboard/navbar', $data);
        echo view('dashboard/addProduk', $data);
    }

    public function save(){
        $ProdukModel = new ProdukModel();

        //validasi form
        if(!$this->validate([
            'kode_barang' => [
                'rules' => 'is_unique[produk.idProduk]',
                'errors' => [
                    'is_unique' => '{field} sudah digunakan'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            //dd($validation);
            return redirect()->to('/dashboard/add')->withInput()->with('validation', $validation);
        }

        /*$hallo = [
            'id_user' => $this->request->getVar('idUser'),
            'idProduk' => $this->request->getVar('kode_barang'),
            'namaProduk' => $this->request->getVar('nama_barang'),
            'kategori' => $this->request->getVar('kategori'),
            'jumlah' => $this->request->getVar('jumlah'),
            'harga' => $this->request->getVar('harga'),
            'exp' => $this->request->getVar('expDate')
        ];

        dd($hallo);*/
        $produk = $ProdukModel-> save([
            'id_user' => $this->request->getPost('idUser'),
            'idProduk' => $this->request->getVar('kode_barang'),
            'namaProduk' => $this->request->getVar('nama_barang'),
            'kategori' => $this->request->getVar('kategori'),
            'jumlah' => $this->request->getVar('jumlah'),
            'harga' => $this->request->getVar('harga'),
            'exp' => $this->request->getVar('expDate')
        ]);

        session()->setFlashdata('pesan', 'Produk Berhasil Ditambahkan');
        return redirect()->to('/dashboard');
    }
}