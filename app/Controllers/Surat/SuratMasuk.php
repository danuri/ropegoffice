<?php

namespace App\Controllers\Surat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\SuratmasukModel;

class SuratMasuk extends BaseController
{
    public function index()
    {
        return view('surat/surat_masuk');
    }

    public function getData()
    {
      $surat = new SuratmasukModel();
      $surat->select('id,srt_kode,srt_asal_tanggal,srt_asal_nama,srt_asal_perihal,srt_asal,srt_status,srt_arah');
      $surat->where('srt_tahun',date('Y'));

      return DataTable::of($surat)
      ->add('action', function($row){
        return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit customer: '.$row->id.'\')">View</button>';
      })
      ->toJson(true);
    }

    public function save()
    {
      $model = new SuratmasukModel;

      $param = [
        'srt_via' => $this->request->getVar('srt_via'),
        'srt_via_agenda' => $this->request->getVar('srt_via_agenda'),
        'srt_via_tanggal' => $this->request->getVar('srt_via_tanggal'),
        'srt_asal' => $this->request->getVar('srt_asal'),
        'srt_asal_nomor' => $this->request->getVar('srt_asal_nomor'),
        'srt_asal_tanggal' => $this->request->getVar('srt_asal_tanggal'),
        'srt_asal_perihal' => $this->request->getVar('srt_asal_perihal'),
        'srt_asal_nama' => $this->request->getVar('srt_asal_nama'),
        'srt_kode' => $this->request->getVar('srt_kode'),
        'srt_tanggal_terima' => $this->request->getVar('srt_tanggal_terima'),
        'srt_arah' => $this->request->getVar('srt_arah'),
        'srt_sifat' => $this->request->getVar('srt_sifat'),
      ];

      $insert = $model->insert($param);

      return redirect()->back()->with('message', 'Kategori telah ditambahkan');
    }

    public function detail()
    {
      // code...
    }
}
