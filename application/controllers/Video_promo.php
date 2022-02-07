<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Video_promo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Video_promo_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Video_promo_model->get_by_id(1);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('video_promo/update_action'),
				'video_promo_id' => set_value('video_promo_id', $row->video_promo_id),
				'link' => set_value('link', $row->link),
			);
			$this->template->load('template', 'video_promo/video_promo_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('video_promo'));
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
				'link' => $this->input->post('link', TRUE),
			);

			$this->Video_promo_model->update($this->input->post('video_promo_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('video_promo'));
		}
	}


	public function _rules()
	{
		$this->form_validation->set_rules('link', 'link', 'trim|required');

		$this->form_validation->set_rules('video_promo_id', 'video_promo_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
