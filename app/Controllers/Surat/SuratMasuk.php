<?php

namespace App\Controllers\Surat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
      $surat->select('id,srt_kode_urut,srt_kode,srt_tanggal_terima,srt_asal_tanggal,srt_asal_nama,srt_asal_perihal,srt_asal,srt_status,srt_arah');
    //   $surat->where('srt_tahun',date('Y'));

      return DataTable::of($surat)
      ->add('action', function($row){
        return '<div class="dropdown">
                    <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-settings-2-line"></i>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                        <li><a class="dropdown-item" href="javascript:;" onClick="detail(\''.$row->id.'\')">View</a></li>
                        <li><a class="dropdown-item" href="javascript:;" onClick="detail(\''.$row->id.'\')">History</a></li>
                        <li><a class="dropdown-item" href="javascript:;" onClick="window.open(\''.site_url('surat/surat_masuk/cetak/'.$row->id).'\')">Cetak</a></li>
                        <li><a class="dropdown-item" href="'.site_url('surat/surat_masuk/delete/'.$row->id).'" onClick="return confirm(\'Surat akan dihapus?\')">Delete</a></li>
                    </ul>
                </div>';
      })->filter(function ($builder, $request) {

        if ($request->tahun)
            $builder->where('srt_tahun', $request->tahun);
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
        'srt_tahun' => date('Y'),
      ];

      $insert = $model->insert($param);

      return redirect()->back()->with('message', 'Surat telah ditambahkan');
    }

    public function detail($id)
    {
      $model = new SuratmasukModel;
      $surat = $model->find($id);
      ?>
      <form action="">
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_via" class="form-label">Masuk Surat Via</label>
            </div>
            <div class="col-lg-4">
              <input type="text" class="form-control" name="srt_via" id="srt_via" value="<?= $surat->srt_via?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_via_agenda" class="form-label">Nomor Agenda</label>
            </div>
            <div class="col-lg-4">
              <input type="text" class="form-control" name="srt_via_agenda" id="srt_via_agenda" value="<?= $surat->srt_via_agenda?>" disabled>
            </div>
            <div class="col-lg-2">
                <label for="srt_via_tanggal" class="form-label">Tanggal Agenda</label>
            </div>
            <div class="col-lg-3">
              <input type="date" class="form-control" name="srt_via_tanggal" id="srt_via_tanggal" value="<?= $surat->srt_via_tanggal?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_asal" class="form-label">Asal Surat</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="srt_asal" id="srt_asal" value="<?= $surat->srt_asal?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_asal_nomor" class="form-label">Nomor Surat</label>
            </div>
            <div class="col-lg-4">
                <input type="text" class="form-control" name="srt_asal_nomor" id="srt_asal_nomor" value="<?= $surat->srt_asal_nomor?>" disabled>
            </div>
            <div class="col-lg-2">
                <label for="srt_asal_tanggal" class="form-label">Tanggal Surat</label>
            </div>
            <div class="col-lg-3">
                <input type="date" class="form-control" name="srt_asal_tanggal" id="srt_asal_tanggal" value="<?= $surat->srt_asal_tanggal?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_asal_perihal" class="form-label">Perihal</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="srt_asal_perihal" id="srt_asal_perihal" value="<?= $surat->srt_asal_perihal?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_asal_nama" class="form-label">Atas Nama</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="srt_asal_nama" id="srt_asal_nama" value="<?= $surat->srt_asal_nama?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_asal_nama" class="form-label">Agenda TU</label>
            </div>
            <div class="col-lg-4">
                <input type="text" class="form-control" name="srt_kode" id="srt_kode" value="<?= $surat->srt_kode?>" disabled>
            </div>
            <div class="col-lg-2">
                <label for="srt_asal_nama" class="form-label">Tanggal Diterima</label>
            </div>
            <div class="col-lg-3">
                <input type="date" class="form-control" name="srt_tanggal_terima" id="srt_tanggal_terima" value="<?= $surat->srt_tanggal_terima?>" disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_arah" class="form-label">Arah Surat</label>
            </div>
            <div class="col-lg-4">
                <select class="form-select" name="srt_arah" id="srt_arah" disabled>
                  <option value="Ka Tim I">Ka Tim I</option>
                  <option value="Ka Tim II">Ka Tim II</option>
                  <option value="Ka Tim III">Ka Tim III</option>
                  <option value="Kasubbag TU">Kasubbag TU</option>
                  <option value="Karopeg">Karopeg</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <label for="srt_arah" class="form-label">Sifat Surat</label>
            </div>
            <div class="col-lg-4">
                <input type="text" class="form-control" name="srt_sifat" id="srt_sifat" value="<?= $surat->srt_sifat?>" disabled>
            </div>
        </div>
    </form>
      <?php
    }

    public function cetak($id)
    {
      $model = new SuratmasukModel;
      $data['surat'] = $model->find($id);
      return view('surat/cetak',$data);
    }

    public function delete($id)
    {
      $model = new SuratmasukModel;
      $delete = $model->delete($id);

      return redirect()->back()->with('message', 'Data telah dihapus');
    }

    public function export($tahun)
    {
      $kode = kodekepala(session('kelola'));

      $model = new SuratmasukModel;
      $surat = $model->where('srt_tahun', $tahun)->findAll();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'id');
      $sheet->setCellValue('B1', 'srt_arah');
      $sheet->setCellValue('C1', 'srt_asal');
      $sheet->setCellValue('D1', 'srt_asal_nama');
      $sheet->setCellValue('E1', 'srt_asal_nomor');
      $sheet->setCellValue('F1', 'srt_asal_perihal');
      $sheet->setCellValue('G1', 'srt_asal_tanggal');
      $sheet->setCellValue('H1', 'srt_kode');
      $sheet->setCellValue('I1', 'srt_kode_urut');
      $sheet->setCellValue('J1', 'srt_status');
      $sheet->setCellValue('K1', 'srt_tanggal_terima');
      $sheet->setCellValue('L1', 'srt_tahun');
      $sheet->setCellValue('M1', 'srt_via');
      $sheet->setCellValue('N1', 'srt_via_agenda');
      $sheet->setCellValue('O1', 'srt_via_tanggal');
      $sheet->setCellValue('P1', 'srt_sifat');
      $sheet->setCellValue('Q1', 'created_by');
      $sheet->setCellValue('R1', 'created_at');

      $i = 2;
      foreach ($surat as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->id,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->getCell('B'.$i)->setValueExplicit($row->srt_arah,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('C'.$i, $row->srt_asal);
        $sheet->setCellValue('D'.$i, $row->srt_asal_nama);
        $sheet->setCellValue('E'.$i, $row->srt_asal_nomor);
        $sheet->setCellValue('F'.$i, $row->srt_asal_perihal);
        $sheet->setCellValue('G'.$i, $row->srt_asal_tanggal);
        $sheet->setCellValue('H'.$i, $row->srt_kode);
        $sheet->setCellValue('I'.$i, $row->srt_kode_urut);
        $sheet->setCellValue('J'.$i, $row->srt_status);
        $sheet->setCellValue('K'.$i, $row->srt_tanggal_terima);
        $sheet->setCellValue('L'.$i, $row->srt_tahun);
        $sheet->setCellValue('M'.$i, $row->srt_via);
        $sheet->setCellValue('N'.$i, $row->srt_via_agenda);
        $sheet->setCellValue('O'.$i, $row->srt_via_tanggal);
        $sheet->setCellValue('P'.$i, $row->srt_sifat);
        $sheet->setCellValue('Q'.$i, $row->created_by);
        $sheet->setCellValue('R'.$i, $row->created_at);

        $i++;
      }
      $sheet->setTitle('Surat Masuk '.$tahun);
        
      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="SuratMasuk_'.$tahun.'.xlsx"');
      $writer->save('php://output');
    }
}
