<?php

class SkalaModel extends CI_Model{
  public function getSkala($id = '*'){
    $this->db->select($id);
    $this->db->from('tbl_skala');
    $query = $this->db->get();
    return $query->result_array();
  }
}