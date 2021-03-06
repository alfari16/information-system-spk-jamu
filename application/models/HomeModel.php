<?php 
class HomeModel extends CI_Model {
  public function __construct(){
		parent::__construct();
		$this->load->model("SkalaModel");
		$this->load->model("AlternatifModel");
  }

  public function index() {
    $alt = $this->AlternatifModel->getAlternatifId();
    $arr = array();
    foreach ($alt as $value) {
      $query = $this->db->query('SELECT nm_alternatif, nm_kriteria, nm_skala FROM tbl_nilai, tbl_alternatif, tbl_skala, tbl_kriteria WHERE tbl_nilai.id_kriteria = tbl_kriteria.id_kriteria AND tbl_nilai.id_skala = tbl_skala.id_skala AND tbl_nilai.id_alternatif = tbl_alternatif.id_alt  AND tbl_nilai.id_alternatif='.$value['id_alt']) ;
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

  public function update($val){
    $where = [
			'id_alternatif' => $val['id_alternatif'],
			'id_kriteria' => $val['id_kriteria']
		];
    $this->db->where($where);
		$this->db->update('tbl_nilai', $val);
  }

  
}