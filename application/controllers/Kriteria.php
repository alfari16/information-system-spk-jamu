<?php

class Kriteria extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('KriteriaModel');
    $this->load->model('HomeModel');
  }

  public function index() {
    $data['items'] = $this->KriteriaModel->index();
    $data['bobot'] = $this->KriteriaModel->getSkala();

    // var_dump($temp['Rasa']['nilai'][0]['nilai_kriteria']);
    // var_dump($temp['Rasa']['bobot']);

    $this->load->view("partials/header");
    $this->load->view("Kriteria", $data);
    $this->load->view("partials/footer");
  }

  public function insert(){
    $temp = [
      'nm_kriteria' => $this->input->post('nm_kriteria'),
      'keterangan' => $this->input->post('keterangan')
    ];
    $id = $this->KriteriaModel->insert($temp, $this->input->post());
    $this->HomeModel->generateAlternatifValue($id);
    redirect(base_url('kriteria'));
  }

  public function delete($id){
    $this->KriteriaModel->delete($id);
    redirect(base_url('kriteria'));
  }
}