<?php 
class HomeModel extends CI_Model {
  // public function index(){
  //   $this->db->select('*');
  //   $this->db->from('tbl_kriteria');
  //   $query = $this->db->get();
  //   return $query->result_array();
  // }

  // public function kriteriaValue(){
  //   $arr = array();
  //   $allKriteria = $this->index();

  //   foreach ($allKriteria as $kriteria) {
  //     $id = $kriteria['id'];

  //     $rawQuery = "SELECT * FROM tbl_nilai WHERE id_kriteria=$id";
  //     $query = $this->db->query($rawQuery);
  //     $arr[$kriteria['nama_kriteria']] = $query->result_array();
  //   }

  //   // $query = $this->db->query($query);
  //   return $arr;
  // }

  // public function subKriteria(){
  //   $this->db->select('*');
  //   $this->db->from('tbl_nilai');
  //   $query = $this->db->get();
  //   return $query->result_array();
  // }

  public function index() {
    $alt = $this->getAlternatif();
    $arr = array();
    foreach ($alt as $value) {
      $query = $this->db->query('SELECT nm_alternatif, nm_kriteria, nm_skala FROM tbl_nilai, tbl_alternatif, tbl_skala, tbl_kriteria WHERE tbl_nilai.id_kriteria = tbl_kriteria.id_kriteria AND tbl_nilai.id_skala = tbl_skala.id_skala AND tbl_nilai.id_alternatif = tbl_alternatif.id_alt  AND tbl_nilai.id_alternatif='.$value['id_alt']) ;
      $res = $query->result_array();
      $data['alternatif'] = $res[0]['nm_alternatif'];
      foreach ($res as $value) {
        $data['kriteria'][$value['nm_kriteria']] = $value['nm_skala'];
      }
      array_push($arr, $data);
    }
		return $arr;
	}

	public function getKriteria() {
		$query = $this->db->query('SELECT nm_kriteria, nm_skala AS bobot FROM `tbl_kriteria`, tbl_skala, tbl_bobot WHERE tbl_kriteria.id_kriteria=tbl_bobot.id_kriteria AND tbl_skala.id_skala=tbl_bobot.id_skala');
		return $query->result_array();
  }
  
  public function getAlternatif(){
    $this->db->select('id_alt');
    $this->db->from('tbl_alternatif');
    $query = $this->db->get();
    return $query->result_array();
  }
}