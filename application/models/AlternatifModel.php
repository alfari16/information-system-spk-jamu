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
  }

  function delete($id){
    $this->db->where('id_alt', $id);
    $this->db->delete('tbl_alternatif');
  }
}