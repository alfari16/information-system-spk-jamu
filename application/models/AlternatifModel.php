<?php
class AlternatifModel extends CI_Model{
  function index(){
    $this->db->select("*");
    $this->db->from("tbl_alternatif");
    $query = $this->db->get();
    return $query->result_array();
  }

  function insert($array){
    $this->db->insert('tbl_alternatif', $array);
    $this->db->select('id_alt');
    $this->db->where($array);
    $this->db->from('tbl_alternatif');
    $query = $this->db->get();
    return $query->row_array();
  }

  function delete($id){
    $this->db->where('id_alternatif', $id);
    $this->db->delete('tbl_nilai');
    $this->db->where('id_alt', $id);
    $this->db->delete('tbl_alternatif');
  }

  public function getAlternatifId(){
    $this->db->select('id_alt');
    $this->db->from('tbl_alternatif');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getAlternatif($params = '*'){
    $this->db->select($params);
    $this->db->from('tbl_alternatif');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function generateAlternatifValue($id){
    $alternatifs = $this->getAlternatifId();
    $skala = $this->SkalaModel->getSkalaId()['id_skala'];
    foreach ($alternatifs as $alternatif) {
      $this->db->insert('tbl_nilai', [
        'id_kriteria' => $id,
        'id_alternatif' => $alternatif['id_alt'],
        'id_skala' => $skala
      ]);
    }
  }
}