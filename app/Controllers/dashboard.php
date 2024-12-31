<?php

namespace App\Controllers;

use App\Models\dashboardModel;
use App\Models\produkModel;
use App\Models\riwayatModel;
use App\Models\transaksiModel;
use App\Models\memberModel;
use App\Models\userModel;

class dashboard extends BaseController {

    protected $session;
    protected $produkModel;
    protected $dashboardModel;
    protected $riwayatModel;
    protected $transaksiModel;
    protected $memberModel;
    protected $userModel;

    //session setting
    public function __construct()
    {
        // Memuat session service

        $this->session = \Config\Services::session();
        $this->dashboardModel = new dashboardModel();
        $this->produkModel = new ProdukModel();
        $this->riwayatModel = new riwayatModel();
        $this->transaksiModel = new transaksiModel();
        $this->memberModel = new memberModel();
        $this->userModel = new userModel();
    }

    //tampilan menu produk
    public function index(){

        $email = $this->session->get('email');
        $idUser = $this->session->get('id');

        if(!$email){
            return redirect()->to('user');
        }

        $keyword = $this->request->getPost('keyword');
        $cosnt = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;

        if($keyword){
            $produk = $this->dashboardModel->search($keyword);
        } else {
            $produk = $this->dashboardModel;
        }

        //$where = $ProdukModel->where(['id_user' => $idUser])->first();
        //dd($where);
        //$produk = $ProdukModel-> findAll();

        $data = [
            'email' => $email,
            'produk' => $produk->where(['idPemilik' => $idUser])->orderBy('idProduk', 'DESC')->paginate(6, 'produk'),
            'pager' => $this->dashboardModel->pager,
            'const' => $cosnt,
        ];

        echo view('dashboard/navbar', $data);
        echo view('dashboard/dashboard', $data);
    }
    public function profil(){

        $email = $this->session->get('email');
        $idUser = $this->session->get('id');

        if(!$email){
            return redirect()->to('user');
        }

        $cosnt = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;


        //$where = $ProdukModel->where(['id_user' => $idUser])->first();
        //dd($where);
        //$produk = $ProdukModel-> findAll();

        $data = [
            'email' => $email,
            'produk' => $this->produkModel->where(['idPemilik' => $idUser])->orderBy('idProduk', 'DESC')->paginate(6, 'produk'),
            'pager' => $this->produkModel->pager,
            'const' => $cosnt,
        ];

        echo view('dashboard/navbar', $data);
        echo view('dashboard/profil', $data);
    }

    //tampilan menu stok masuk
    public function stokMasuk(){
        $email = $this->session->get('email');
        $idUser = $this->session->get('id');
        $keyword = $this->request->getPost('keyword');

        if(!$email){
            return redirect()->to('user');
        }

        if($keyword){
            $produk = $this->produkModel->search($keyword);
        } else {
            $produk = $this->produkModel;
        }

        //$where = $ProdukModel->where(['id_user' => $idUser])->first();
        //dd($where);
        //$produk = $ProdukModel-> findAll();

        $data = [
            'email' => $email,
            'produk' => $produk->where(['idPemilik' => $idUser])->orderBy('idProduk', 'DESC')->paginate(6, 'produk'),
            'pager' => $produk->pager,
        ];
        echo view('dashboard/navbar', $data);
        echo view('dashboard/stokMasuk', $data);
    }

    //tampilan menu stokKeluar
    public function stokKeluar(){
        $email = $this->session->get('email');
        $idUser = $this->session->get('id');
        $keyword = $this->request->getPost('keyword');

        if(!$email){
            return redirect()->to('user');
        }

        if($keyword){
            $produk = $this->produkModel->search($keyword);
        } else {
            $produk = $this->produkModel;
        }

        $data = [
            'email' => $email,
            'produk' => $produk->where(['idPemilik' => $idUser])->orderBy('idProduk', 'DESC')->paginate(6, 'produk'),
            'pager' => $produk->pager,
        ];
        echo view('dashboard/navbar', $data);
        echo view('dashboard/stokKeluar', $data);
    }

    //tampilan tambah produk
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

    //tampilan edit produk
    public function formedit($id){

        $email = $this->session->get('email');
        $idUser = $this->session->get('id');

        $ProdukModel = new ProdukModel();
        $produk = $ProdukModel->where(['idProduk' => $id])->first();
        $data = [
            'email' => $email,
            'iduser' => $idUser,
            'produk' => $produk,
            'validation' => session()->getFlashdata('validation')
        ];
        //dd($data);
        echo view('dashboard/navbar', $data);
        echo view('dashboard/editProduk', $data);
    }

//public function tambah
    public function save(){
        //set waktu berdasarkan wilayah jakarta
        date_default_timezone_set('Asia/Jakarta');
        $ProdukModel = new ProdukModel();
        $riwayatModel = new riwayatModel();
        $idUser = $this->session->get('id');

        //mevalidasi form agar kode produk tidak sama dengan produk laiinya.
        if(!$this->validate([
            'kode_barang' => [
                'rules' => 'is_unique[produk.kodeProduk]',
                'errors' => [
                    'is_unique' => '{field} sudah digunakan'
                ]
            ]
        ])) {
            //mensetkan pesan kesalahan
            $validation = \Config\Services::validation();

            //mengirimkan pesan kesalahan ke tampilan form
            return redirect()->to('/dashboard/add')->withInput()->with('validation', $validation);
        }

        //fungsi untuk memasukkan data produk ke dalam table riwayat
        $riwayatModel->save([
            'idPemilik' => $idUser,
            'kodeProduk' => $this->request->getPost('kode_barang'),
            'namaProduk' => $this->request->getPost('nama_barang'),
            'status' => 'Baru',
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => date('Y-m-d') 
        ]);
        //fungsi untuk memasukkan data produk ke dalam table produk

        $produk = $ProdukModel-> save([
            'idPemilik' => $this->request->getPost('idUser'),
            'kodeProduk' => $this->request->getVar('kode_barang'),
            'namaProduk' => $this->request->getVar('nama_barang'),
            'kategori' => $this->request->getVar('kategori'),
            'jumlah' => $this->request->getVar('jumlah'),
            'harga' => $this->request->getVar('harga'),
        ]);

        //mengatur session untuk memberitahukan produk telah di isi
        session()->setFlashdata('pesan', 'Produk Berhasil Ditambahkan');
        return redirect()->to('/dashboard');
    }


    public function delete($id)
    {
        $produkModel = new produkModel();
    
        // Cek apakah produk dengan idProduk yang diberikan ada
        $produk = $produkModel->where('idProduk', $id)->first();
        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to('/dashboard');
        }
        
        // Hapus produk berdasarkan idProduk
        $produkModel->delete($id);
        
        session()->setFlashdata('pesan', 'Produk berhasil dihapus.');
        return redirect()->to('/dashboard');
    }
    
    //function edit produk
        public function update($idProduk)
    {
        $produkModel = new produkModel();

        // Validasi input
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
        ])) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error
            return redirect()->to('/dashboard/edit/'.$idProduk)->withInput()->with('validation', $validation);
        }

        // Ambil data yang dikirimkan dari form
        $data = [
            'namaProduk' => $this->request->getPost('nama_barang'),
            'kategori' => $this->request->getPost('kategori'),
            'harga' => $this->request->getPost('harga'),
        ];

        // Update data produk
        $produkModel->update($idProduk, $data);

        // Set flash data untuk pesan sukses
        session()->setFlashdata('pesan', 'Produk berhasil diperbarui.');

        return redirect()->to('/dashboard');
    }

//function tambah Barang
    public function tambahJumlah($idProduk)
    {
        date_default_timezone_set('Asia/Jakarta');
        $ProdukModel = new produkModel();
        $riwayatModel = new riwayatModel();
        $idUser = $this->session->get('id');

        // Validasi input untuk jumlah yang ditambahkan
        if (!$this->validate([
            'jumlah' => 'required|numeric|min_length[1]' // Validasi untuk memastikan jumlah adalah angka dan lebih besar dari 0
        ])) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error
            return redirect()->to('/dashboard/masuk/'.$idProduk)->withInput()->with('validation', service('validation'));
        }

        // Ambil data yang dikirimkan dari form
        $jumlahTambah = $this->request->getPost('jumlah');

        // Ambil data produk untuk mendapatkan jumlah stok saat ini
        $produk = $ProdukModel->find($idProduk);

        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to('/dashboard/masuk');
        }

        // Tambahkan jumlah produk yang baru ke stok yang sudah ada
        $newJumlah = $produk['jumlah'] + $jumlahTambah;

        $riwayatModel->save([
            'idPemilik' => $idUser,
            'kodeProduk' => $this->request->getPost('kodeProduk'),
            'namaProduk' => $this->request->getPost('namaProduk'),
            'tanggal' => date('Y-m-d'),
            'status' => 'Masuk',
            'jumlah' => $jumlahTambah
        ]);

        // Update jumlah produk dengan menambahkannya
        $ProdukModel->update($idProduk, ['jumlah' => $newJumlah]);

        // Set flash data untuk pesan sukses
        session()->setFlashdata('pesan', 'Jumlah produk berhasil ditambahkan.');

        return redirect()->to('/dashboard/masuk');
    }

//function kurang barang
    public function kurangJumlah($idProduk)
    {
        date_default_timezone_set('Asia/Jakarta');
        $ProdukModel = new produkModel();
        $riwayatModel = new riwayatModel();
        $idUser = $this->session->get('id');

        // Validasi input untuk jumlah yang ditambahkan
        if (!$this->validate([
            'jumlah' => 'required|numeric|min_length[1]' // Validasi untuk memastikan jumlah adalah angka dan lebih besar dari 0
        ])) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error
            return redirect()->to('/dashboard/keluar/'.$idProduk)->withInput()->with('validation', service('validation'));
        }

        // Ambil data yang dikirimkan dari form
        $jumlahTambah = $this->request->getPost('jumlah');

        // Ambil data produk untuk mendapatkan jumlah stok saat ini
        $produk = $ProdukModel->find($idProduk);

        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to('/dashboard/keluar');
        }

        // Tambahkan jumlah produk yang baru ke stok yang sudah ada
        $newJumlah = $produk['jumlah'] - $jumlahTambah;

        // Update jumlah produk dengan menambahkannya

        $riwayatModel->save([
            'idPemilik' => $idUser,
            'kodeProduk' => $this->request->getPost('kodeProduk'),
            'namaProduk' => $this->request->getPost('namaProduk'),
            'tanggal' => date('Y-m-d'),
            'status' => 'Keluar',
            'jumlah' => $jumlahTambah
        ]);

        $ProdukModel->update($idProduk, ['jumlah' => $newJumlah]);

        // Set flash data untuk pesan sukses
        session()->setFlashdata('pesan', 'Jumlah produk berhasil diKurang.');

        return redirect()->to('/dashboard/keluar');
    }
    public function riwayat(){

            $email = $this->session->get('email');
            $idUser = $this->session->get('id');

            if(!$email){
                return redirect()->to('user');
            }

            $status = $this->userModel->select('status')->where('idPemilik', $idUser)->first();

            $cosnt = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;

            //$where = $ProdukModel->where(['id_user' => $idUser])->first();
            //dd($where);
            //$produk = $ProdukModel-> findAll();

            $data = [
                'email' => $email,
                'produk' => $this->riwayatModel->where(['idPemilik' => $idUser])->orderBy('idRiwayat', 'DESC')->paginate(6, 'riwayat'),
                'pager' => $this->riwayatModel->pager,
                'const' => $cosnt,
            ];

            echo view('dashboard/navbar', $data);

            $status = $status['status'];

            if($status == 'tidakAktif'){
                echo view('blank');
            } else {
                echo view('dashboard/riwayat', $data);
            }
    }

    
}    