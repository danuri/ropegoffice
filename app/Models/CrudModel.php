<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
  protected $db;

  public function __construct()
  {
    $this->db = \Config\Database::connect('default', false);

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

  public function getActivities($id)
  {
    $query = $this->db->query("exec sp_get_aktifitas @usul='".$id."'")->getResult();
    return $query;
  }

  public function getPerjadin($nip)
  {
    $query = $this->db->query("SELECT
                              	tr_perjadin_peserta.*,
                              	tr_perjadin.kegiatan,
                              	tr_perjadin.sasaran,
                              	tr_perjadin.tahun_anggaran,
                              	tr_perjadin.tgl_awal,
                              	tr_perjadin.tgl_akhir,
                              	tr_perjadin.nomor_surat,
                              	tr_perjadin.surat_tugas,
                              	tr_perjadin.created_at
                              FROM
                              	tr_perjadin_peserta
                              	INNER JOIN
                              	tr_perjadin
                              	ON
                              		tr_perjadin_peserta.kode_perjadin = tr_perjadin.kode
                              WHERE
                              	tr_perjadin_peserta.nip = '$nip'")->getResult();
    return $query;
  }

  public function getperjadinDetail($id)
  {
    $query = $this->db->query("SELECT
                              	tr_perjadin_peserta.*,
                              	tr_perjadin.kegiatan,
                              	tr_perjadin.sasaran,
                              	tr_perjadin.tahun_anggaran,
                              	tr_perjadin.tgl_awal,
                              	tr_perjadin.tgl_akhir,
                              	tr_perjadin.nomor_surat,
                              	tr_perjadin.surat_tugas,
                              	tr_perjadin.created_at
                              FROM
                              	tr_perjadin_peserta
                              	INNER JOIN
                              	tr_perjadin
                              	ON
                              		tr_perjadin_peserta.kode_perjadin = tr_perjadin.kode
                              WHERE
                              	tr_perjadin_peserta.id = '$id'")->getResult();
    return $query;
  }

}
