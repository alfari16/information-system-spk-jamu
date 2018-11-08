<?php

class SkalaModel extends CI_Model{
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
}