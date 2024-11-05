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
      $kategori->select('aset_pengguna.id, aset_pengguna.nip, aset_pengguna.nama, aset_pengguna.id_aset, aset_pengguna.status, aset_pengguna.lampiran_terima, aset_pengguna.lampiran_kembali, aset_pengguna.tanggal_terima, aset_pengguna.tanggal_kembali, aset.merek, aset.tipe')
                ->join('aset', 'aset.id = id_aset');

      return DataTable::of($kategori)
      ->edit('nip', function($row, $meta){
        return '<strong>' . $row->nama .'</strong><br>'.$row->nip;
      })
      ->edit('tanggal_terima', function($row, $meta){
        if($row->status == 1){
          return $row->tanggal_terima.'<br><a href="'.base_url('uploads/baterima/'.$row->lampiran_terima).'" target="_blank">Lihat BA</a>';
        }else{
          return $row->tanggal_terima.'<br><a href="">Download Draft BA</a> | <a href="javascript:;" onClick="$(\'#file'.$row->id.'\').click()">Upload BA</a>
          <form method="POST" action="'. site_url('aset/distribusi/uploadbaterima').'" style="display: none;" id="form'.$row->id.'" enctype="multipart/form-data">
            <input type="hidden" name="id" value="'.$row->id.'">
            <input type="file" name="dokumen" id="file'.$row->id.'" onchange="$(\'#form'.$row->id.'\').submit()">
          </form>
          ';
        }
      })
      ->edit('tanggal_kembali', function($row, $meta){
        if($row->tanggal_kembali){
          return $row->tanggal_kembali.'<br><a href="'.base_url('uploads/baterima/'.$row->lampiran_kembali).'" target="_blank">Lihat BA</a>';
        }else{
          return $row->tanggal_kembali.'<br><a href="">Download Draft BA</a> | <a href="javascript:;" onClick="uploadKembali('.$row->id.')">Upload BA</a>';
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

    public function uploadbaterima()
    {
      $validationRule = [
            'foto' => [
                'label' => 'BA Terima',
                'rules' => [
                    'uploaded[dokumen]',
                    'mime_in[dokumen,application/pdf]',
                ],
            ],
        ];
        if (! $this->validateData([], $validationRule)) {
            return redirect()->back()->with('message', 'BA gagal diunggah');
        }

      $img = $this->request->getFile('dokumen');

      if ($img->isValid() && ! $img->hasMoved()) {
          $newName = $img->getRandomName();
          $img->move('./uploads/baterima', $newName);
      }

      $model = new DistribusiModel;

      $foto = '';
      $param = [
        'status' => 1,
        'lampiran_terima' => $newName
      ];
      $id = $this->request->getVar('id');
      $insert = $model->update($id,$param);

      return redirect()->back()->with('message', 'BA telah diunggah');
    }

    public function uploadbakembali()
    {
      $validationRule = [
            'foto' => [
                'label' => 'BA Kembali',
                'rules' => [
                    'uploaded[dokumen]',
                    'mime_in[dokumen,application/pdf]',
                ],
            ],
        ];
        if (! $this->validateData([], $validationRule)) {
            return redirect()->back()->with('message', 'BA gagal diunggah');
        }

      $img = $this->request->getFile('dokumen');

      if ($img->isValid() && ! $img->hasMoved()) {
          $newName = $img->getRandomName();
          $img->move('./uploads/baterima', $newName);
      }

      $model = new DistribusiModel;

      $foto = '';
      $param = [
        'status' => 1,
        'tanggal_kembali' => $this->request->getVar('tanggal'),
        'lampiran_kembali' => $newName
      ];
      $id = $this->request->getVar('id');
      $insert = $model->update($id,$param);

      return redirect()->back()->with('message', 'BA telah diunggah');
    }
}
