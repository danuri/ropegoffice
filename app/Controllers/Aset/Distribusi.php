<?php

namespace App\Controllers\Aset;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\DistribusiModel;
use App\Models\AsetModel;

class Distribusi extends BaseController
{
    public function index()
    {
      $asetm = new AsetModel();
      $data['assets'] = $asetm->findAll();
      return view('aset/distribusi/index', $data);
    }

    public function getDistribusi()
    {
      $kategori = new DistribusiModel();
      $kategori->select('id, nip, id_aset, status, tanggal_terima, tanggal_kembali');

      return DataTable::of($kategori)
      ->add('action', function($row){
        return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit customer: '.$row->id.'\')">Edit</button>';
      })
      ->toJson(true);
    }

    public function save()
    {
      $model = new DistribusiModel;

      $param = [
        'nip' => $this->request->getVar('nip'),
        'nama' => $this->request->getVar('nama'),
        'jabatan' => $this->request->getVar('jabatan'),
        'satuan_kerja' => $this->request->getVar('satker'),
        'id_aset' => $this->request->getVar('id_aset'),
        'tanggal_terima' => $this->request->getVar('tanggal_terima'),
        'status' => 1,
        'created_by' => session('nip'),
      ];

      $insert = $model->insert($param);

      return $this->response->setJSON(['status'=>'success','message'=>'Data berhasil ditambahkan']);
    }
}
