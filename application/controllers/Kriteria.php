<?php

class Kriteria extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('KriteriaModel');
    $this->load->model('AlternatifModel');
    $this->load->model('HomeModel');
  }

  public function index() {
    $data['items'] = $this->KriteriaModel->index();
    $this->load->view("partials/header");
    $this->load->view("Kriteria", $data);
    $this->load->view("partials/footer");
  }

  public function insert(){
    $id = $this->KriteriaModel->insert($this->input->post());
    $this->AlternatifModel->generateAlternatifValue($id);
    redirect(base_url('kriteria'));
  }

  public function delete($id){
    $this->KriteriaModel->delete($id);
    redirect(base_url('kriteria'));
  }
}