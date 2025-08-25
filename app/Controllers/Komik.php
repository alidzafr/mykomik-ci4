<?php namespace App\Controllers;

class Komik extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Daftar Komik'];

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