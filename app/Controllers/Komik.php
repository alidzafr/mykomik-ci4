<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    // Object Oriented Programming
    // Biar bisa dipake di semua class turnannya
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];
        return view('/komik/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Daftar Komik'];

        return view('/komik/create', $data);
    }

    public function store()
    {
        $tempArr = [
            $judul = $this->request->getPost('judul'),
            $penulis = $this->request->getPost('penulis'),
            $sampul = $this->request->getFile('sampul')->getClientName()
        ];

        dd($tempArr);
    }
}
