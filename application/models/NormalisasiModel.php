<?php

class NormalisasiModel extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->model('AlternatifModel');
    $this->load->model('KriteriaModel');
  }

  public function index() {
    $alt = $this->AlternatifModel->getAlternatifId();
    $arr = array();
    foreach ($alt as $value) {
      $query = $this->db->query('SELECT nm_alternatif, nm_kriteria, nm_skala, tbl_skala.value FROM tbl_nilai, tbl_alternatif, tbl_skala, tbl_kriteria WHERE tbl_nilai.id_kriteria = tbl_kriteria.id_kriteria AND tbl_nilai.id_skala = tbl_skala.id_skala AND tbl_nilai.id_alternatif = tbl_alternatif.id_alt  AND tbl_nilai.id_alternatif='.$value['id_alt']) ;
      $res = $query->result_array();
      $data['alternatif'] = $res[0]['nm_alternatif'];
      $data['alternatifId'] = $value['id_alt'];
      $data['total'] = 0;
      foreach ($res as $value2) {
        $sqlMax = "SELECT tbl_kriteria.nm_kriteria, MAX(tbl_skala.value) AS max 
                FROM tbl_nilai, tbl_skala, tbl_kriteria, tbl_alternatif 
                WHERE 
                tbl_nilai.id_alternatif=tbl_alternatif.id_alt AND 
                tbl_nilai.id_kriteria=tbl_kriteria.id_kriteria AND 
                tbl_nilai.id_skala=tbl_skala.id_skala AND 
                tbl_kriteria.nm_kriteria='".$value2['nm_kriteria']."' 
                GROUP BY tbl_kriteria.nm_kriteria";
        $max = $this->db->query($sqlMax)->row_array()['max'];
        $temp = $data['kriteria'][$value2['nm_kriteria']] = number_format($value2['value']/$max, 2);
        
        $getBobot = $this->KriteriaModel->getKriteriaWhere('bobot', "nm_kriteria = '".$value2['nm_kriteria']."'")['bobot'];
        $data['total'] += ($temp*$getBobot);
      }
      array_push($arr, $data);
    }
		return $arr;
  }
}