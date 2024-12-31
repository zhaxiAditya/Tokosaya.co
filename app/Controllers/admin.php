<?php

namespace App\Controllers;

use App\Models\dashboardModel;
use App\Models\produkModel;
use App\Models\riwayatModel;
use App\Models\transaksiModel;
use App\Models\memberModel;
use App\Models\userModel;

class admin extends BaseController {

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

        // $email = $this->session->get('email');
        // $idUser = $this->session->get('id');

        // if(!$email){
        //     return redirect()->to('user');
        // }

        // $keyword = $this->request->getPost('keyword');
        // $cosnt = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;

        // if($keyword){
        //     $produk = $this->dashboardModel->search($keyword);
        // } else {
        //     $produk = $this->dashboardModel;
        

        //$where = $ProdukModel->where(['id_user' => $idUser])->first();
        //dd($where);
        //$produk = $ProdukModel-> findAll();

        $data = [
            'email' => 'admin',
            'user' => $this->userModel->findALl(),
        ];

        echo view('admin/navbar', $data);
        echo view('admin/dashboard', $data);
    }
        //tampilan menu produk
        public function transaksi(){

            // $email = $this->session->get('email');
            // $idUser = $this->session->get('id');
    
            // if(!$email){
            //     return redirect()->to('user');
            // }
    
            // $keyword = $this->request->getPost('keyword');
            // $cosnt = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;
    
            // if($keyword){
            //     $produk = $this->dashboardModel->search($keyword);
            // } else {
            //     $produk = $this->dashboardModel;
            
    
            //$where = $ProdukModel->where(['id_user' => $idUser])->first();
            //dd($where);
            //$produk = $ProdukModel-> findAll();
    
            $data = [
                'email' => 'admin',
                'user' => $this->transaksiModel->findALl(),
            ];
    
            echo view('admin/navbar', $data);
            echo view('admin/transaksi', $data);
        } 
}    