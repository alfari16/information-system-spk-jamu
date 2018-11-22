<?php

class SpkModel extends CI_Model{

  function __construct(){
    parent::__construct();
    $this->load->model('AlternatifModel');
    $this->load->model('KriteriaModel');
  }

  public function index() {
    $arr = [];
    foreach ($this->vectorS() as $item) {
      $data = $item;
      $data['vektorV'] = round($item['vektorS']/$this->totalVectorS(), 2);
      array_push($arr, $data);
      // echo $data['vektorS']." / ".$this->totalVectorS();
      // echo "<br>";
      // var_dump($data);
      // echo "<br><br>";
    }
    return $arr;
  }

  public function totalVectorS(){
    $total = 0;
    foreach ($this->vectorS() as $item) {
      $total += $item['vektorS'];
    }

    return $total;
  }

  public function vectorS() {
    $arr = [];
    $kriterias = $this->KriteriaModel->getKriteria();
    foreach ($this->rawData() as $item) {
      $temp = $item;
      $temp['vektorS'] = 1;
      foreach ($kriterias as $kriteria) {
        $bobot = $kriteria['bobot']/100;
        $multiData = pow($temp['kriteria'][$kriteria['nm_kriteria']], $bobot);
        $temp['vektorS'] *= $multiData;
      }
      $temp['vektorS'] = round($temp['vektorS'], 2);
      // var_dump($temp);
      // echo "<br><br>";
      array_push($arr, $temp);
    }
    return $arr;
  }
  
  public function rawData() {
    $alt = $this->AlternatifModel->getAlternatifId();
    $arr = array();
    foreach ($alt as $value) {
      $query = $this->db->query('SELECT nm_alternatif, nm_kriteria, nm_skala, tbl_skala.value FROM tbl_nilai, tbl_alternatif, tbl_skala, tbl_kriteria WHERE tbl_nilai.id_kriteria = tbl_kriteria.id_kriteria AND tbl_nilai.id_skala = tbl_skala.id_skala AND tbl_nilai.id_alternatif = tbl_alternatif.id_alt  AND tbl_nilai.id_alternatif='.$value['id_alt']) ;
      $res = $query->result_array();
      $data['alternatif'] = $res[0]['nm_alternatif'];
      $data['alternatifId'] = $value['id_alt'];
      foreach ($res as $value) {
        $data['kriteria'][$value['nm_kriteria']] = $value['value'];
      }
      array_push($arr, $data);
    }
		return $arr;
  }

}