<?php

class KriteriaModel extends CI_Model{
  public function index() {
    $query = $this->db->query('SELECT tbl_kriteria.id_kriteria, nm_kriteria, keterangan, nm_skala AS bobot FROM `tbl_kriteria`, tbl_bobot, tbl_skala WHERE tbl_kriteria.id_kriteria=tbl_bobot.id_kriteria AND tbl_skala.id_skala=tbl_bobot.id_skala ORDER BY tbl_kriteria.id_kriteria');
    return $query->result_array();
  }

  public function subKriteria() {
    foreach ($this->kriteria() as $value) {
      $this->db->select('*');
      $this->db->from('tabel_nilai');
      $this->db->where(['id_kriteria' => $value['id']]);
      $query = $this->db->get();
      $arr[$value['nama_kriteria']] = [
        'nilai' => $query->result_array(),
        'bobot' => $value['bobot']
      ];
    }
    return $arr;
  }

  public function insertKriteria($arr){
    $query = $this->db->insert('tbl_kriteria', $arr);
    $this->db->select('id');
    $this->db->from('tbl_kriteria');
    $this->db->where(['nama_kriteria' => $arr['nama_kriteria']]);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function insertSubKriteria($id, $arr){
    $decr = 3;
    foreach ($arr as $value) {
      $this->db->insert('tabel_nilai', [
        'id' => 'DEFAULT', 
        'id_kriteria' => $id, 
        'nilai_kriteria' => $value, 
        'nilai_kriteria_raw' => $decr
      ]);
      $decr--;
    }
  }

  public function insert($arr, $post) {
    $this->db->insert('tbl_kriteria', $arr);
    $this->db->select('id_kriteria');
    $this->db->from('tbl_kriteria');
    $this->db->where($arr);
    $res = $this->db->get()->row_array();  
    $this->insertBobot([
      'id_kriteria' => $res['id_kriteria'],
      'id_skala' => $post['skala']
    ]);
    return $res['id_kriteria'];
  }

  public function insertBobot($arr) {
    $this->db->insert('tbl_bobot', $arr);
  }

  function delete($id){
    $this->db->where('id_kriteria', $id);
    $this->db->delete('tbl_nilai');
    $this->db->where('id_kriteria', $id);
    $this->db->delete('tbl_bobot');
    $this->db->where('id_kriteria', $id);
    $this->db->delete('tbl_kriteria');
  }

  public function getSkala() {
    $this->db->select('*');
    $this->db->from('tbl_skala');
    $query = $this->db->get();
    return $query->result_array();
  }
}