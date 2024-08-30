<?php

namespace App\Controllers\Surat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\AgendakeluarModel;
use App\Models\SimpegModel;

class AgendaKeluar extends BaseController
{
    public function index()
    {
        $pegawai = new SimpegModel;
        $data['pegawai'] = $pegawai->getTempPegawai('010211');

        return view('surat/agenda_keluar', $data);
    }

    public function getData()
    {
      $agenda = new AgendakeluarModel();
      $agenda->where('tahun',date('Y'));
      $agenda->orderBy('nomor_sampai', 'DESC');

      return DataTable::of($agenda)
      ->add('pemohon', function($row){
        return '<b>'.$row->nama_pemohon.'</b><br>'.$row->satker;
      })
      ->format('nomor_mulai', function($value, $meta){
        return setzeroagenda($value);
      })
      ->format('nomor_sampai', function($value, $meta){
        return setzeroagenda($value);
      })
      ->add('action', function($row){
        return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit customer: \')">View</button>';
      })
      ->toJson(true);
    }

    public function add()
    {
      $perihal = $this->request->getVar('perihal');
      $jumlah = $this->request->getVar('jumlah');
      $pemohon = explode("#",$this->request->getVar('pemohon'));
      $startnum = $this->getLast();
      $firstnum = $startnum+1;
      $lastnum = $firstnum+$jumlah;

      $model = new AgendakeluarModel();
      $param = [
        'tahun'=>'2024',
        'nip_pemohon'=>$pemohon[0],
        'nama_pemohon'=>$pemohon[1],
        'kode_satker'=>$pemohon[2],
        'satker'=>$pemohon[3],
        'perihal'=>$perihal,
        'jumlah_nomor'=>$jumlah,
        'nomor_mulai'=>$firstnum,
        'nomor_sampai'=>$lastnum,
      ];

      $insert = $model->insert($param);

      return $this->response->setJSON(['status'=>'success','message'=>'Data berhasil ditambahkan']);
    }

    public function getLast()
    {
      $this->db = \Config\Database::connect('default', false);
      $query = $this->db->query("SELECT MAX(nomor_sampai) AS nomor_sampai FROM agenda_keluar LIMIT 0,1")->getRow();

      if($query){
        return $query->nomor_sampai;
      }else{
        return 1;
      }
    }
}
