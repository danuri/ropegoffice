<?php

namespace App\Controllers\Aset;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use \Hermawan\DataTables\DataTable;
use App\Models\KategoriModel;
use App\Models\AsetModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new KategoriModel;
        $data['kategori'] = $model->findAll();

        return view('aset/index', $data);
    }

    public function getAset()
    {
      $kategori = new AsetModel();
      $kategori->select('id, kode_aset, kategori_id, merek, tipe, tanggal, foto, created_by');

      return DataTable::of($kategori)
      ->add('imgfoto', function($row){
        return '<a class="glightbox" data-lightbox="image-1" data-title="'.$row->merek.' / '.$row->tipe.'" href="'.base_url('uploads/'.$row->foto).'"><img src="'.base_url('uploads/'.$row->foto).'" class="rounded avatar-xl" alt="image"></a>';
      })
      ->add('nama', function($row){
        return $row->merek.' / '.$row->tipe;
      })
      ->add('status', function($row){
        return 'Tersedia';
      })
      ->add('action', function($row){
        return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit customer: '.$row->id.'\')">Edit</button>';
      })
      ->toJson(true);
    }

    public function asetSave()
    {
      $validationRule = [
            'foto' => [
                'label' => 'Foto Aset',
                'rules' => [
                    'uploaded[foto]',
                    'is_image[foto]',
                    'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                ],
            ],
        ];
        if (! $this->validateData([], $validationRule)) {
            return $this->response->setJSON(['status'=>'error','message'=>'Foto gagal diunggah']);
        }

      $img = $this->request->getFile('foto');

      if ($img->isValid() && ! $img->hasMoved()) {
          $newName = $img->getRandomName();
          $img->move('./uploads', $newName);
      }

      $model = new AsetModel;

      $foto = '';
      $param = [
        'kode_aset' => $this->request->getVar('kode'),
        'kategori_id' => $this->request->getVar('kategori'),
        'merek' => $this->request->getVar('merek'),
        'tipe' => $this->request->getVar('tipe'),
        'tanggal' => $this->request->getVar('tanggal'),
        'foto' => $newName,
        'created_by' => session('nip'),
      ];

      $insert = $model->insert($param);

      return $this->response->setJSON(['status'=>'success','message'=>'Data berhasil ditambahkan']);
    }

    public function kategori()
    {
      $model = new KategoriModel;
      $data['kategori'] = $model->findAll();

      return view('aset/kategori', $data);
    }

    public function getKategori()
    {
      $kategori = new KategoriModel();
      $kategori->select('id, kode, nama_kategori, created_by');

      return DataTable::of($kategori)
      ->add('action', function($row){
        return '<a href="'.site_url('aset/kategori/delete/'.$row->id).'" type="button" class="btn btn-primary btn-sm" onclick="return confirm(\'Data akan dihapus?\')">Delete</a>';
      })
      ->toJson(true);
    }

    public function kategoriSave()
    {
      $model = new KategoriModel;

      $param = [
        'kode' => $this->request->getVar('kode'),
        'nama_kategori' => $this->request->getVar('nama'),
        'created_by' => session('nip'),
      ];

      $insert = $model->insert($param);

      return redirect()->back()->with('message', 'Kategori telah ditambahkan');
    }

    public function kategoriDelete($id)
    {
      $model = new KategoriModel;

      $insert = $model->delete($id);

      return redirect()->back()->with('message', 'Kategori telah dihapus');
    }
}
