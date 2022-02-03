<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	date_default_timezone_set('Asia/Jakarta');

class Setting_app extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$row = $this->Setting_app_model->get_by_id(1);
		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
				'action' => site_url('setting_app/update_action'),
				'app_setting_id' => set_value('app_setting_id', $row->app_setting_id),
				'nama_aplikasi' => set_value('nama_aplikasi', $row->nama_aplikasi),
				'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
				'alamat' => set_value('alamat', $row->alamat),
				'website' => set_value('website', $row->website),
				'photo' => set_value('photo', $row->photo),
				'telpon' => set_value('telpon', $row->telpon),
				'fax' => set_value('fax', $row->fax),
				'email' => set_value('email', $row->email),
			);
			$this->template->load('template', 'setting_app/setting_app_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('setting_app'));
		}
	}

	public function update_action()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$config['upload_path']      = './assets/assets/img/logo';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload("photo")) {
				$id = $this->input->post('id');
				$row = $this->Setting_app_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {
					$target_file = './assets/assets/img/logo/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}

			$data = array(
				'nama_aplikasi' => $this->input->post('nama_aplikasi', TRUE),
				'nama_perusahaan' => $this->input->post('nama_perusahaan', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'website' => $this->input->post('website', TRUE),
				'telpon' => $this->input->post('telpon', TRUE),
				'fax' => $this->input->post('fax', TRUE),
				'email' => $this->input->post('email', TRUE),
				'photo' => $photo,
			);

			$this->Setting_app_model->update($this->input->post('app_setting_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('setting_app'));
		}
	}


	public function _rules()
	{
		$this->form_validation->set_rules('nama_aplikasi', 'nama aplikasi', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('website', 'website', 'trim|required');
		$this->form_validation->set_rules('telpon', 'Telpon', 'trim|required');
		$this->form_validation->set_rules('fax', 'Fax', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('photo', 'photo', 'trim');

		$this->form_validation->set_rules('app_setting_id', 'app_setting_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
