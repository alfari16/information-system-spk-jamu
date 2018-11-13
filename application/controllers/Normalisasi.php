<?php

class Normalisasi extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model("AlternatifModel");
    $this->load->model("NormalisasiModel");
    $this->load->model("KriteriaModel");
  }

  public function index(){
    $data['allValue'] = $this->NormalisasiModel->index();
    $data['allValueJson'] = json_encode($this->NormalisasiModel->index());
		$data['allKriteria'] = $this->KriteriaModel->getKriteria();

		$this->load->view('partials/header');
		$this->load->view("Normalisasi", $data);
		$this->load->view('partials/footer');
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
    $this->KriteriaModel->generateKriteriaValue($id);
    redirect(base_url('alternatif'));
  }
}