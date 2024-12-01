<?php

namespace App\Controllers;

class landpage extends BaseController
{
    public function index()
    {
        echo view('landpage/header');
        echo view('landpage/homepage');
        echo view('landpage/footer');
    }

    public function harga()
    {
        echo view('landpage/header');
        echo view('landpage/harga');
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
}