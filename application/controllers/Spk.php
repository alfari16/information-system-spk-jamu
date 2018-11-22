<?php 
class Spk extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('SpkModel');
    $this->load->model('KriteriaModel');
  }

  function index() {
    $data['allValue'] = $this->SpkModel->index();
    $data['allValueJson'] = json_encode($this->SpkModel->index());
    $data['allKriteria'] = $this->KriteriaModel->getKriteria();

    $this->load->view('partials/header');
    $this->load->view('Spk', $data);
    $this->load->view('partials/footer');
  }
}