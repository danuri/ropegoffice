<?php

namespace App\Controllers\Aset;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\DistribusiModel;
use App\Models\AsetModel;
use App\Models\CrudModel;

class Distribusi extends BaseController
{
    public function index()
    {
      $asetm = new CrudModel();
      $data['assets'] = $asetm->asetAvailable();
      return view('aset/distribusi/index', $data);
    }

    public function getDistribusi()
    {
      $kategori = new DistribusiModel();
      $kategori->select('aset_pengguna.id, aset_pengguna.nip, aset_pengguna.nama, aset_pengguna.id_aset, aset_pengguna.status, aset_pengguna.lampiran_terima, aset_pengguna.lampiran_kembali, aset_pengguna.tanggal_terima, aset_pengguna.tanggal_kembali, aset.merek, aset.tipe')
                ->join('aset', 'aset.id = id_aset');

      return DataTable::of($kategori)
      // ->edit('nip', function($row, $meta){
      //   return '<strong>' . $row->nama .'</strong><br>'.$row->nip;
      // })
      ->edit('tanggal_terima', function($row, $meta){
        if($row->status == 1){
          return $row->tanggal_terima.'<br><a href="'.base_url('uploads/baterima/'.$row->lampiran_terima).'" target="_blank">Lihat BA</a>';
        }else{
          return $row->tanggal_terima.'<br><a href="'.base_url('aset/distribusi/draftbaterima/'.$row->id).'">Download Draft BA</a> | <a href="javascript:;" onClick="$(\'#file'.$row->id.'\').click()">Upload BA</a>
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
        return '<a href="'.site_url('distribusi/delete/'.$row->id).'" class="btn btn-danger btn-sm" onclick="alert(\'Data akan dihapus?\')">Hapus</a>';
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
        'status' => 0,
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

    function delete($id) {
      $model = new DistribusiModel;
      $model->delete($id);
      return redirect()->back()->with('message', 'Data telah dihapus');
    }

    public function draftBaTerima($id)
    {
      $model = new DistribusiModel();
      $dist = $model->select('aset_pengguna.id, aset_pengguna.nip, aset_pengguna.nama,aset_pengguna.jabatan,aset_pengguna.satuan_kerja, aset_pengguna.id_aset, aset_pengguna.status, aset_pengguna.lampiran_terima, aset_pengguna.lampiran_kembali, aset_pengguna.tanggal_terima, aset_pengguna.tanggal_kembali, aset.merek, aset.tipe, aset.kode_aset')
                ->join('aset', 'aset.id = id_aset')
                ->where('aset_pengguna.id', $id)->first();

      $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/penyerahan.docx');

      $predefinedMultilevel = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_EMPTY);

      $templateProcessor->setValue('nama', $dist->nama);
      $templateProcessor->setValue('nip', $dist->nip);
      $templateProcessor->setValue('jabatan', $dist->jabatan);
      $templateProcessor->setValue('satker', $dist->satuan_kerja);
      $templateProcessor->setValue('hari', hari($dist->tanggal_terima));
      $templateProcessor->setValue('tanggal', date('d',strtotime($dist->tanggal_terima)));
      $templateProcessor->setValue('bulan', date('m',strtotime($dist->tanggal_terima)));
      $templateProcessor->setValue('tahun', date('Y',strtotime($dist->tanggal_terima)));
      $templateProcessor->setValue('merk', $dist->merek);
      $templateProcessor->setValue('tipe', $dist->tipe);
      $templateProcessor->setValue('sn', $dist->kode_aset);

      $filename = 'draft_ba_terima_'.$dist->nama.'.docx';
      $templateProcessor->saveAs('draft/'.$filename);

      return $this->response->download('draft/'.$filename,null);
    }

    public function draftBaKembali($id)
    {
      $model = new DistribusiModel();
      $dist = $model->select('aset_pengguna.id, aset_pengguna.nip, aset_pengguna.nama,aset_pengguna.jabatan,aset_pengguna.satuan_kerja, aset_pengguna.id_aset, aset_pengguna.status, aset_pengguna.lampiran_terima, aset_pengguna.lampiran_kembali, aset_pengguna.tanggal_terima, aset_pengguna.tanggal_kembali, aset.merek, aset.tipe, aset.kode_aset')
                ->join('aset', 'aset.id = id_aset')
                ->where('aset_pengguna.id', $id)->first();

      $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/pengembalian.docx');

      $predefinedMultilevel = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_EMPTY);

      $templateProcessor->setValue('nama', $dist->nama);
      $templateProcessor->setValue('nip', $dist->nip);
      $templateProcessor->setValue('jabatan', $dist->jabatan);
      $templateProcessor->setValue('satker', $dist->satuan_kerja);
      $templateProcessor->setValue('hari', hari($dist->tanggal_kembali));
      $templateProcessor->setValue('tanggal', date('d',strtotime($dist->tanggal_kembali)));
      $templateProcessor->setValue('bulan', date('m',strtotime($dist->tanggal_kembali)));
      $templateProcessor->setValue('tahun', date('Y',strtotime($dist->tanggal_kembali)));
      $templateProcessor->setValue('merk', $dist->merek);
      $templateProcessor->setValue('tipe', $dist->tipe);
      $templateProcessor->setValue('sn', $dist->kode_aset);

      $filename = 'draft_ba_kembali_'.$dist->nama.'.docx';
      $templateProcessor->saveAs('draft/'.$filename);

      return $this->response->download('draft/'.$filename,null);
    }
}
