<?php

namespace App\Controllers;
use App\Models\memberModel;
use App\Models\userModel;
use App\Models\transaksiModel;

class landpage extends BaseController
{
    protected $session;
    protected $memberModel;
    protected $userModel;
    protected $transaksiModel;

    public function __Construct(){
        $this->session = \Config\Services::session();
        $this->memberModel = new memberModel;
        $this->userModel = new userModel;
        $this->transaksiModel = new transaksiModel;
    }
    public function index()
    {
        echo view('landpage/header');
        echo view('landpage/homepage');
        echo view('landpage/footer');
    }

    public function harga()
    {
        $data = [
            'title' => 'membership',
            'membership' => $this->memberModel->findAll()
        ];

        echo view('landpage/header');
        echo view('landpage/harga', $data);
    }

    public function praTransaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $idUser = $this->session->get('id');
        if(!$idUser){
            session()->setFlashdata('pesan', "Silahkan Login untuk berlanganan");
            return redirect()->to('user/login');
        }
        $idMember = $this->request->getPost('idmembership');


        $user = $this->userModel->where(['idPemilik' => $idUser])->first();
        $hargas = $this->memberModel->select('harga')->where(['idMembership' => $idMember])->first();
        $durasi = $this->memberModel->select('durasi')->where(['idMembership' => $idMember])->first();
        $tanggal = $this->userModel->select('tanggalAkhir')->where(['idPemilik' => $idUser])->first();

        $harga = $hargas['harga'];
        $tanggal = $tanggal['tanggalAkhir'];
        $tanggalSekarang = date('Y-m-d');

        $durasi = $durasi['durasi'];


        /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        // composer require midtrans/midtrans-php
                                    
        // Alternatively, if you are not using **Composer**, you can download midtrans-php library 
        // (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
        // the file manually.   

        // require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-q4ppcQcdpq527CEJu77uY4Gf';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order_id = 'order-id-' . uniqid() . '-' . rand(1000, 9999);

        $params = array(
             'transaction_details' => array(
                 'order_id' => $order_id,
                 'gross_amount' => $harga,
             ),
             'customer_details' => array(
                'email' => $user['email'],
                'nama' => $user['namaToko']
             ),
         );
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $this->transaksiModel->save([
            'idTransaksi' => $order_id,
            'idPemilik' => $idUser,
            'idMembership' => $idMember,
            'noToken' => $snapToken
        ]);

        $tanggalAkhir = strtotime($tanggal);
        $tanggalSekarangIni = strtotime($tanggalSekarang);

        if($tanggalAkhir < $tanggalSekarangIni){
            $tanggalAkhir = strtotime("+$durasi days", $tanggalSekarangIni ); 
        } else {
            $tanggalAkhir = strtotime("+$durasi days", $tanggalAkhir);
        }

        $tanggalAkhirBaru = date("Y-m-d", $tanggalAkhir);

        
        $data = ([
            'status' => 'Aktif',
            'tanggalAkhir' => $tanggalAkhirBaru,
        ]);
        


        $this->userModel->update($idUser, $data);

        return redirect()->to('https://app.sandbox.midtrans.com/snap/v2/vtweb/'.$snapToken);
    }
    public function kebijakan()
    {
        echo view('landpage/header');
        echo view('landpage/kebijakan');
    }
    public function kontak()
    {
        echo view('landpage/header');
        echo view('landpage/kontak');
    }


    public function about(){
        return view('welcome_message');
    }

        // /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        // composer require midtrans/midtrans-php
                                    
        // Alternatively, if you are not using **Composer**, you can download midtrans-php library 
        // (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
        // the file manually.   

        // require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        // //SAMPLE REQUEST START HERE

        // // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = 'SB-Mid-server-q4ppcQcdpq527CEJu77uY4Gf';
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => rand(),
        //         'gross_amount' => 10000,
        //     ),
        //     'customer_details' => array(
        //         'first_name' => 'budi',
        //         'last_name' => 'pratama',
        //         'email' => 'budi.pra@example.com',
        //         'phone' => '08111222333',
        //     ),
        // );
        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        // $data = ([
        //     'title' => 'pembayaran',
        //     'token' => $snapToken
        // ]);
}