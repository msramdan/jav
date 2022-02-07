<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Setting_app_model');
		$this->load->model('Achievements_model');
		$this->load->model('Contact_model');
		$this->load->model('Message_model');
		$this->load->model('Affilation_model');
		$this->load->model('Service_model');
		$this->load->model('About_model');
		$this->load->model('Slider_model');
		$this->load->model('Video_promo_model');
		$this->load->model('Portfolio_model');
		$this->load->model('Team_model');
	}

	public function index()
	{
		$query = $this->db->query("SELECT portfolio.service_id,service_name FROM portfolio join service on service.service_id = portfolio.service_id GROUP BY portfolio.service_id");
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'achievements' =>  $this->Achievements_model->get_by_id(1),
			'affilation' =>  $this->Affilation_model->get_by_id(1),
			'contact_data' =>  $this->Contact_model->get_all(),
			'service_data' => $this->Service_model->get_all(),
			'service_data_grup' => $query,
			'about' => $this->About_model->get_by_id(1),
			'slider_data' => $this->Slider_model->get_all(),
			'video_promo' =>$this->Video_promo_model->get_by_id(1),
			'portfolio_data' => $this->Portfolio_model->get_all(),
			'team_data' => $this->Team_model->get_all(),
		);
		$this->load->view('web', $data);
	}

	public function contact_save()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'message' => $this->input->post('message'),
			'email' => $this->input->post('email'),
			'create_date' => date('Y-m-d'),
		);
		$this->Message_model->insert($data);
		if ($this->db->affected_rows() > 0) {
			$params = array("success" => true);
		} else {
			$params = array("success" => false);
		}
		echo json_encode($params);
	}
}
