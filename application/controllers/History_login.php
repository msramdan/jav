<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class History_login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('History_login_model');
		$this->load->model('Setting_app_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$history_login = $this->History_login_model->get_all();
		$data = array(
			'history_login_data' => $history_login,
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template', 'history_login/history_login_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->History_login_model->get_by_id($id);
		if ($row) {
			$data = array(
				'history_login_id' => $row->history_login_id,
				'user_id' => $row->user_id,
				'info' => $row->info,
				'tanggal' => $row->tanggal,
				'user_agent' => $row->user_agent,
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			);
			$this->template->load('template', 'history_login/history_login_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('history_login'));
		}
	}
}
