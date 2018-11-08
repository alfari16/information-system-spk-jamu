<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("AlternatifModel");
		$this->load->model("HomeModel");
		$this->load->model("KriteriaModel");
		$this->load->model("SkalaModel");
	}

	public function index(){
		$data['allValue'] = $allKriteria = $this->HomeModel->index();
		$data['allKriteria'] = $this->KriteriaModel->getKriteria();
		$data['allKriteriaJson'] = json_encode($this->KriteriaModel->getKriteria());
		$data['allSkala'] = $this->SkalaModel->getSkala();


		// $json['encode'] = json_encode($this->AlternatifModel->index());
		// $json['subKriteria'] = json_encode($this->HomeModel->subKriteria());

		$this->load->view('partials/header');
		$this->load->view("Home", $data);
		// $this->load->view("Result", $json);
		$this->load->view('partials/footer');
	}

	public function edit() {
		$this->HomeModel->update($this->input->post());
		redirect(base_url());
	}
}
