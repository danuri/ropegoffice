<?php

namespace App\Models;

use CodeIgniter\Model;

class SimpegModel extends Model
{
  protected $db;

  public function __construct()
  {
    $this->db = \Config\Database::connect('simpeg', false);

  }

  public function getRow($table,$where)
  {
    $builder = $this->db->table($table);
    $query = $builder->getWhere($where);

    return $query->getRow();
  }

  public function getArray($table,$where=false)
  {
    $builder = $this->db->table($table);

    if($where){
      $query = $builder->getWhere($where);
    }else{
      $query = $builder->get();
    }

    return $query->getResult();
  }

  public function setquery($query)
  {
    $query = $this->db->query($query);
    return $query;
  }

  public function getPegawai($nip)
  {
    $query = $this->db->query("SELECT * FROM TEMP_PEGAWAI WHERE NIP_BARU='$nip'")->getRow();
    return $query;
  }

  public function searchPegawai($nip,$satker)
  {
    $query = $this->db->query("SELECT * FROM TEMP_PEGAWAI WHERE NIP_BARU='$nip' AND KODE_SATUAN_KERJA LIKE '$satker%'")->getRow();
    return $query;
  }

  public function getParentSatker()
  {
    $query = $this->db->query("SELECT * FROM TM_SATUAN_KERJA WHERE JENIS_SATKER='PARENT'")->getResult();
    return $query;
  }

  public function getTempPegawai($kode)
  {
    $query = $this->db->query("SELECT NIP,NIP_BARU,NAMA_LENGKAP,AGAMA,TEMPAT_LAHIR,TANGGAL_LAHIR,JENIS_KELAMIN,PENDIDIKAN,JENJANG_PENDIDIKAN,LEVEL_JABATAN,PANGKAT,GOL_RUANG,TMT_CPNS,TMT_PANGKAT,
                              MK_TAHUN,MK_BULAN,TIPE_JABATAN,TAMPIL_JABATAN,TMT_JABATAN,SATKER_1,SATKER_2,KODE_SATKER_3,SATKER_3,KODE_SATKER_4,SATKER_4,SATKER_5,HARI_KERJA,USIA_PENSIUN,TMT_PENSIUN,STATUS_PEGAWAI,NO_HP,EMAIL,HARI_KERJA
                              FROM TEMP_PEGAWAI WHERE KODE_SATUAN_KERJA LIKE '$kode%'")->getResult();
    return $query;
  }

  public function query_row($query)
  {
    $query = $this->db->query($query)->getRow();
    return $query;
  }

  public function query_array($query)
  {
    $query = $this->db->query($query)->getResult();
    return $query;
  }

  public function getCount($table,$where=false)
  {
    $builder = $this->db->table($table);

    if($where){
      $query = $builder->getWhere($where);
    }else{
      $query = $builder->get();
    }

    return $query->countAllResults();
  }
}
