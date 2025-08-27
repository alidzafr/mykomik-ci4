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
        session();
        $data = [
            'title' => 'Daftar Komik',
            'validation' => \Config\Services::validation()
        ];

        return view('/komik/create', $data);
    }

    public function store()
    {
        $rules = [
            'judul' => [
                'rules' => 'required|min_length[3]|is_unique[komik.judul]',
                'errors' => [
                    'required'   => 'Judul harus diisi.',
                    'min_length' => 'Judul minimal 3 karakter.',
                    'is_unique'  => 'Judul komik tidak boleh sama.'
                ]
            ],
            'penulis' => [
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'required' => 'penulis harus diisi.',
                    'max_length' => 'Jumlah huruf tidak boleh melebihi 30'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'required' => 'penerbit harus diisi.',
                    'max_length' => 'Jumlah huruf tidak boleh melebihi 30'
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar sampul terlebih dahulu.',
                    'max_size' => 'Ukuran maksimal 1MB.',
                    'is_image' => 'File yang anda pilih bukan gambar.',
                    'mime_in'  => 'Sampul hanya boleh JPG/PNG.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        // ambil gambar, rename & move ke public/img
        $fileSampul = $this->request->getFile('sampul');
        $namaSampul =  $fileSampul->getRandomName();
        $fileSampul->move('img', $namaSampul);

        // url_title = mengkonversi huruf kecil dan separator menjadi -
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'data berhasil disimpan');

        return redirect()->to('/');

        // $tempArr = [
        //     $judul = $this->request->getVar('judul'),
        //     $inislug = $slug,   
        //     $penulis = $this->request->getVar('penulis'),
        //     $penulis = $this->request->getVar('penerbit'),
        //     $sampul = $fileSampul->getName()
        // ];

        // dd($tempArr);
    }

    public function detail($slug)
    {
        // echo $slug;
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik($slug),
            'nav1' => '',
            'nav2' => ''
        ];
        // Jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan');
        }

        return view('komik/detail', $data);
    }


    public function delete($id)
    {
        $komik = $this->komikModel->find($id);

        // gambar tidak dihapus apabila isinya default.jpg
        if ($komik['sampul'] != 'default.jpg') {
            unlink('img/' . $komik['sampul']);
        }

        $this->komikModel->delete($id);

        session()->setFlashdata('pesan', 'data berhasil dihapus');

        return redirect()->to('/');
    }
}
