<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Achievements extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Achievements_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Achievements_model->get_by_id(1);
		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('achievements/update_action'),
				'achievements_id' => set_value('achievements_id', $row->achievements_id),
				'clients' => set_value('clients', $row->clients),
				'projects' => set_value('projects', $row->projects),
				'gifts' => set_value('gifts', $row->gifts),
				'offices' => set_value('offices', $row->offices),
			);
			$this->template->load('template', 'achievements/achievements_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('achievements'));
		}
	}




	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'clients' => $this->input->post('clients', TRUE),
				'projects' => $this->input->post('projects', TRUE),
				'gifts' => $this->input->post('gifts', TRUE),
				'offices' => $this->input->post('offices', TRUE),
			);

			$this->Achievements_model->update($this->input->post('achievements_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('achievements'));
		}
	}


	public function _rules()
	{
		$this->form_validation->set_rules('clients', 'clients', 'trim|required');
		$this->form_validation->set_rules('projects', 'projects', 'trim|required');
		$this->form_validation->set_rules('gifts', 'gifts', 'trim|required');
		$this->form_validation->set_rules('offices', 'offices', 'trim|required');

		$this->form_validation->set_rules('achievements_id', 'achievements_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
