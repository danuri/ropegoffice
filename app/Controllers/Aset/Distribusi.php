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
      $kategori->select('aset_pengguna.id, aset_pengguna.nip, aset_pengguna.nama, aset_pengguna.id_aset, aset_pengguna.status, aset_pengguna.tanggal_terima, aset_pengguna.tanggal_kembali, aset.merek, aset.tipe')
                ->join('aset', 'aset.id = id_aset');

      return DataTable::of($kategori)
      ->edit('nip', function($row, $meta){
        return '<strong>' . $row->nama .'</strong><br>'.$row->nip;
      })
      ->edit('tanggal_terima', function($row, $meta){
        if($row->tanggal_terima){
          return $row->tanggal_terima.'<br><a href="">Lihat BA</a>';
        }else{
          return $row->tanggal_terima.'<br><a href="">Download Draft BA</a> | <a href="">Upload BA</a>';
        }
      })
      ->edit('tanggal_kembali', function($row, $meta){
        if($row->tanggal_kembali){
          return $row->tanggal_kembali.'<br><a href="">Lihat BA</a>';
        }else{
          return '<button type="button" class="btn btn-success btn-sm">Atur Pengembalian</button>';
        }
      })
      ->edit('id_aset', function($row, $meta){
        return $row->merek .' - '.$row->tipe;
      })
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
