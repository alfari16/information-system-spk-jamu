<?php

class Alternatif extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model("AlternatifModel");
    $this->load->model("HomeModel");
  }

  public function index(){
    $data['items'] = $this->AlternatifModel->index();
    // var_dump($this->AlternatifModel->index());

    $this->load->view("partials/header");
    $this->load->view("Alternatif", $data);
    $this->load->view("partials/footer");
  }

  public function delete($id){
    $this->AlternatifModel->delete($id);
    redirect(base_url("alternatif"));
  }

  public function insert(){
    $array = array(
      'nm_alternatif' => $this->input->post('nm_alternatif'),
      'keterangan' => $this->input->post('keterangan'),
    );
    $id = $this->AlternatifModel->insert($array)['id_alt'];
    $this->HomeModel->generateKriteriaValue($id);
    redirect(base_url('alternatif'));
  }
}