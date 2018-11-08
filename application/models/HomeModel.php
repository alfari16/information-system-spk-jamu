<?php 
class HomeModel extends CI_Model {
  public function index() {
    $alt = $this->getAlternatifId();
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

	public function getKriteria() {
		$query = $this->db->query('SELECT id_kriteria, nm_kriteria, bobot FROM `tbl_kriteria`');
		return $query->result_array();
  }

	public function getKriteriaId() {
		$query = $this->db->query('SELECT id_kriteria FROM `tbl_kriteria`');
		return $query->result_array();
  }
  
  public function getSkalaId(){
    $this->db->select('id_skala');
    $this->db->from('tbl_skala');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function getSkala(){
    $this->db->select('*');
    $this->db->from('tbl_skala');
    $query = $this->db->get();
    return $query->result_array();
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

  public function generateKriteriaValue($id){
    $kriterias = $this->getKriteriaId();
    $skala = $this->getSkalaId()['id_skala'];
    foreach ($kriterias as $kriteria) {
      $this->db->insert('tbl_nilai', [
        'id_alternatif' => $id,
        'id_kriteria' => $kriteria['id_kriteria'],
        'id_skala' => $skala
      ]);
    }
  }

  public function generateAlternatifValue($id){
    $alternatifs = $this->getAlternatifId();
    $skala = $this->getSkalaId()['id_skala'];
    foreach ($alternatifs as $alternatif) {
      $this->db->insert('tbl_nilai', [
        'id_kriteria' => $id,
        'id_alternatif' => $alternatif['id_alt'],
        'id_skala' => $skala
      ]);
    }
  }

  public function update($val){
    $where = [
			'id_alternatif' => $val['id_alternatif'],
			'id_kriteria' => $val['id_kriteria']
		];
    $this->db->where($where);
		$this->db->update('tbl_nilai', $val);
  }





  //new normalisasi
  public function normalisasiIndex() {
    $alt = $this->getAlternatifId();
    $arr = array();
    foreach ($alt as $value) {
      $query = $this->db->query('SELECT nm_alternatif, nm_kriteria, nm_skala, tbl_skala.value FROM tbl_nilai, tbl_alternatif, tbl_skala, tbl_kriteria WHERE tbl_nilai.id_kriteria = tbl_kriteria.id_kriteria AND tbl_nilai.id_skala = tbl_skala.id_skala AND tbl_nilai.id_alternatif = tbl_alternatif.id_alt  AND tbl_nilai.id_alternatif='.$value['id_alt']) ;
      $res = $query->result_array();
      $data['alternatif'] = $res[0]['nm_alternatif'];
      $data['alternatifId'] = $value['id_alt'];
      foreach ($res as $value2) {
        $sqlMax = "SELECT tbl_kriteria.nm_kriteria, MAX(tbl_skala.value) AS max FROM tbl_nilai, tbl_skala, tbl_kriteria, tbl_alternatif WHERE tbl_nilai.id_alternatif=tbl_alternatif.id_alt AND tbl_nilai.id_kriteria=tbl_kriteria.id_kriteria AND tbl_nilai.id_skala=tbl_skala.id_skala AND tbl_kriteria.nm_kriteria='".$value2['nm_kriteria']."' GROUP BY tbl_kriteria.nm_kriteria";
        $max = $this->db->query($sqlMax)->row_array()['max'];
        $data['kriteria'][$value2['nm_kriteria']] = $value2['value']/$max;
      }
      array_push($arr, $data);
    }
		return $arr;
	}
}