<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class About extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('About_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->About_model->get_by_id(1);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('about/update_action'),
				'about_id' => set_value('about_id', $row->about_id),
				'description' => set_value('description', $row->description),
				'photo' => set_value('photo', $row->photo),
			);
			$this->template->load('template', 'about/about_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('about'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$config['upload_path']      = './assets/web/img/about';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload("photo")) {
				$id = $this->input->post('about_id');
				$row = $this->About_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {
					$target_file = './assets/web/img/about/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}
			$data = array(
				'description' => $this->input->post('description', TRUE),
				'photo' => $photo,
			);

			$this->About_model->update($this->input->post('about_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('about'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('photo', 'photo', 'trim');
		$this->form_validation->set_rules('about_id', 'about_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
