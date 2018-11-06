<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("AlternatifModel");
		$this->load->model("HomeModel");
		
	}

	public function index(){
		$data['allValue'] = $allKriteria = $this->HomeModel->index();
		$data['allKriteria'] = $this->HomeModel->getKriteria();
		$data['allKriteriaJson'] = json_encode($this->HomeModel->getKriteria());
		$data['allSkala'] = $this->HomeModel->getSkala();


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
