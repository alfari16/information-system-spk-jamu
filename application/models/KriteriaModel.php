<?php

class KriteriaModel extends CI_Model{
  public function __construct(){
		parent::__construct();
		$this->load->model("AlternatifModel");
		$this->load->model("HomeModel");
  }
  
  public function index() {
    $query = $this->db->query('SELECT * FROM `tbl_kriteria` ORDER BY tbl_kriteria.id_kriteria');
    return $query->result_array();
  }

  public function insert($post) {
    $this->db->insert('tbl_kriteria', $post);
    $this->db->select('id_kriteria');
    $this->db->from('tbl_kriteria');
    $this->db->where($post);
    $res = $this->db->get()->row_array();
    return $res['id_kriteria'];
  }

  function delete($id){
    $this->db->where('id_kriteria', $id);
    $this->db->delete('tbl_nilai');
    $this->db->where('id_kriteria', $id);
    $this->db->delete('tbl_kriteria');
  }

  public function getKriteria() {
		$query = $this->db->query('SELECT id_kriteria, nm_kriteria, bobot FROM `tbl_kriteria`');
		return $query->result_array();
  }

	public function getKriteriaId() {
		$query = $this->db->query('SELECT id_kriteria FROM `tbl_kriteria`');
		return $query->result_array();
  }

  public function generateKriteriaValue($id){
    $kriterias = $this->getKriteriaId();
    $skala = $this->SkalaModel->getSkalaId()['id_skala'];
    foreach ($kriterias as $kriteria) {
      $this->db->insert('tbl_nilai', [
        'id_alternatif' => $id,
        'id_kriteria' => $kriteria['id_kriteria'],
        'id_skala' => $skala
      ]);
    }
  }
}