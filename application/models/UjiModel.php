<?php
class UjiModel extends CI_Model{
  public function save($query){
    $temp = "";
    $bool = false;
    foreach ($query as $kriteria => $skala) {
      if($bool) $temp .= ",";
      $temp .= "(DEFAULT, $kriteria, $skala)";
      $bool = true;
    }
    $this->db->query("INSERT INTO tbl_uji VALUES $temp");
  }

  public function getRank(){
    return $this->db->query('SELECT tbl_nilai.id_alternatif AS id_alt, nm_alternatif, nm_kriteria, nm_skala, COUNT(*) AS total FROM tbl_nilai, tbl_alternatif, tbl_skala, tbl_kriteria, tbl_uji WHERE tbl_nilai.id_kriteria = tbl_kriteria.id_kriteria AND tbl_nilai.id_skala = tbl_skala.id_skala AND tbl_nilai.id_alternatif = tbl_alternatif.id_alt AND tbl_uji.id_kriteria = tbl_nilai.id_kriteria AND tbl_uji.id_skala=tbl_nilai.id_skala GROUP BY nm_alternatif ORDER BY total DESC')->result_array();
  }

  public function getUji() {
    $alt = $this->getRank();
    $arr = array();
    foreach ($alt as $value) {
      $query = $this->db->query('SELECT nm_alternatif, nm_kriteria, nm_skala FROM tbl_nilai, tbl_alternatif, tbl_skala, tbl_kriteria WHERE tbl_nilai.id_kriteria = tbl_kriteria.id_kriteria AND tbl_nilai.id_skala = tbl_skala.id_skala AND tbl_nilai.id_alternatif = tbl_alternatif.id_alt AND tbl_nilai.id_alternatif='.$value['id_alt']) ;
      $res = $query->result_array();
      $data['alternatif'] = $res[0]['nm_alternatif'];
      $data['alternatifId'] = $value['id_alt'];
      foreach ($res as $value) {
        $data['kriteria'][$value['nm_kriteria']] = $value['nm_skala'];
      }
      array_push($arr, $data);
    }
		return $arr;
	}
}