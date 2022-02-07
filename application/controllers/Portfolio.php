<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Portfolio extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Portfolio_model');
		$this->load->model('Service_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$portfolio = $this->Portfolio_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'portfolio_data' => $portfolio,
		);
		$this->template->load('template', 'portfolio/portfolio_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Portfolio_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'portfolio_id' => $row->portfolio_id,
				'title' => $row->title,
				'service_id' => $row->service_id,
				'description' => $row->description,
				'photo' => $row->photo,
			);
			$this->template->load('template', 'portfolio/portfolio_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('portfolio'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'service' => $this->Service_model->get_all(),
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('portfolio/create_action'),
			'portfolio_id' => set_value('portfolio_id'),
			'title' => set_value('title'),
			'service_id' => set_value('service_id'),
			'description' => set_value('description'),
			'photo' => set_value('photo'),
		);
		$this->template->load('template', 'portfolio/portfolio_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {

			$config['upload_path']      = './assets/web/img/portfolio';
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
				'service_id' => $this->input->post('service_id', TRUE),
				'description' => $this->input->post('description', TRUE),
				'photo' => $photo,
			);

			$this->Portfolio_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('portfolio'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Portfolio_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'service' => $this->Service_model->get_all(),
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('portfolio/update_action'),
				'portfolio_id' => set_value('portfolio_id', $row->portfolio_id),
				'title' => set_value('title', $row->title),
				'service_id' => set_value('service_id', $row->service_id),
				'description' => set_value('description', $row->description),
				'photo' => set_value('photo', $row->photo),
			);
			$this->template->load('template', 'portfolio/portfolio_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('portfolio'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('portfolio_id', TRUE)));
		} else {
			$config['upload_path']      = './assets/web/img/portfolio';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload("photo")) {
				$id = $this->input->post('portfolio_id');
				$row = $this->Portfolio_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {

					$target_file = './assets/web/img/portfolio/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}

			$data = array(
				'title' => $this->input->post('title', TRUE),
				'service_id' => $this->input->post('service_id', TRUE),
				'description' => $this->input->post('description', TRUE),
				'photo' => $photo,
			);

			$this->Portfolio_model->update($this->input->post('portfolio_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('portfolio'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Portfolio_model->get_by_id(decrypt_url($id));

		if ($row) {
			if ($row->photo == null || $row->photo == '') {
			} else {
				$target_file = './assets/web/img/portfolio/' . $row->photo;
				unlink($target_file);
			}
			$this->Portfolio_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('portfolio'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('portfolio'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('service_id', 'service id', 'trim|required');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('photo', 'photo', 'trim');

		$this->form_validation->set_rules('portfolio_id', 'portfolio_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function download($gambar)
	{
		force_download('assets/web/img/portfolio/' . $gambar, NULL);
	}
}
