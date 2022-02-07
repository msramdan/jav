<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Slider extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Slider_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$slider = $this->Slider_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'slider_data' => $slider,
		);
		$this->template->load('template', 'slider/slider_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Slider_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),

				'slider_id' => $row->slider_id,
				'title' => $row->title,
				'span_title' => $row->span_title,
				'photo' => $row->photo,
			);
			$this->template->load('template', 'slider/slider_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('slider'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('slider/create_action'),
			'slider_id' => set_value('slider_id'),
			'title' => set_value('title'),
			'span_title' => set_value('span_title'),
			'photo' => set_value('photo'),
		);
		$this->template->load('template', 'slider/slider_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$config['upload_path']      = './assets/web/img/slider';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload("photo");
			$data = $this->upload->data();
			$photo = $data['file_name'];
			$data = array(
				'title' => $this->input->post('title', TRUE),
				'span_title' => $this->input->post('span_title', TRUE),
				'photo' => $photo,
			);
			$this->Slider_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('slider'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Slider_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('slider/update_action'),
				'slider_id' => set_value('slider_id', $row->slider_id),
				'title' => set_value('title', $row->title),
				'span_title' => set_value('span_title', $row->span_title),
				'photo' => set_value('photo', $row->photo),
			);
			$this->template->load('template', 'slider/slider_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('slider'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('slider_id', TRUE)));
		} else {
			$config['upload_path']      = './assets/web/img/slider';
			$config['allowed_types']    = 'jpg|png|jpeg|gif';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload("photo")) {
				$id = $this->input->post('slider_id');
				$row = $this->Slider_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {

					$target_file = './assets/web/img/slider/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}


			$data = array(
				'title' => $this->input->post('title', TRUE),
				'span_title' => $this->input->post('span_title', TRUE),
				'photo' => $photo,
			);

			$this->Slider_model->update($this->input->post('slider_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('slider'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Slider_model->get_by_id(decrypt_url($id));
		if ($row) {
			if ($row->photo == null || $row->photo == '') {
			} else {
				$target_file = './assets/web/img/slider/' . $row->photo;
				unlink($target_file);
			}
			$this->Slider_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('slider'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('slider'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('span_title', 'span title', 'trim|required');
		$this->form_validation->set_rules('photo', 'photo', 'trim');

		$this->form_validation->set_rules('slider_id', 'slider_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function download($gambar)
	{
		force_download('assets/web/img/slider/' . $gambar, NULL);
	}
}

