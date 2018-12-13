<?php 
class Uji extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('KriteriaModel');
    $this->load->model('SkalaModel');
    $this->load->model('UjiModel');
  }
  public function index(){
    $data['kriteria'] = $this->KriteriaModel->getKriteria('id_kriteria, nm_kriteria');
    $data['skala'] = $this->SkalaModel->getSkala();

    $this->load->view('partials/header');
    $this->load->view('Uji', $data);
    $this->load->view('partials/footer');
  }

  public function kirim(){
    $this->UjiModel->save($this->input->post());
    $data['allValue'] = $allKriteria = $this->HomeModel->getUji();
		$data['allKriteria'] = $this->KriteriaModel->getKriteria();

		// $json['encode'] = json_encode($this->AlternatifModel->index());
		// $json['subKriteria'] = json_encode($this->HomeModel->subKriteria());

		$this->load->view('partials/header');
		$this->load->view("Home", $data);
		// $this->load->view("Result", $json);
		$this->load->view('partials/footer');
  }

  public function tampil(){
    $data['allValue'] = $allKriteria = $this->UjiModel->getUji();
		$data['allKriteria'] = $this->KriteriaModel->getKriteria();
		$data['allKriteriaJson'] = json_encode($this->KriteriaModel->getKriteria());
		$data['allSkala'] = $this->SkalaModel->getSkala();


		// $json['encode'] = json_encode($this->AlternatifModel->index());
		// $json['subKriteria'] = json_encode($this->HomeModel->subKriteria());

		$this->load->view('partials/header');
		$this->load->view("UjiResult", $data);
		// $this->load->view("Result", $json);
		$this->load->view('partials/footer');

  }
}