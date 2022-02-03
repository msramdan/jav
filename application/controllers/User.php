<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('User_model');
		$this->load->model('Setting_app_model');
		$this->load->model('Level_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$user = $this->User_model->get_all();
		$data = array(
			'user_data' => $user,
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template', 'user/user_list', $data);
	}

	public function edit_profile()
	{
		$row = $this->User_model->get_by_id($this->session->userdata('userid'));
		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('user/update_profile'),
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
				'user_id' => set_value('user_id', $row->user_id),
				'level_id' => set_value('level_id', $row->level_id),
				'nama_user' => set_value('nama_user', $row->nama_user),
				'username' => set_value('username', $row->username),
				'email' => set_value('email', $row->email),
				'photo' => set_value('photo', $row->photo),
			);
			$this->template->load('template', 'user/edit_profile', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('dashboard'));
		}
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->User_model->get_by_id($id);
		if ($row) {
			$data = array(
				'user_id' => $row->user_id,
				'nama_user' => $row->nama_user,
				'username' => $row->username,
				'password' => $row->password,
				'level_id' => $row->level_id,
				'email' => $row->email,
				'photo' => $row->photo,
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			);
			$this->template->load('template', 'user/user_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('user'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'level' => $this->Level_model->get_all(),
			'action' => site_url('user/create_action'),
			'user_id' => set_value('user_id'),
			'nama_user' => set_value('nama_user'),
			'username' => set_value('username'),
			'password' => set_value('password'),
			'level_id' => set_value('level_id'),
			'email' => set_value('email'),
			'photo' => set_value('photo'),
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template', 'user/user_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {

			$config['upload_path']      = './assets/assets/img/user';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload("photo");
			$data = $this->upload->data();

			$photo = $data['file_name'];


			$data = array(
				'nama_user' => $this->input->post('nama_user', TRUE),
				'username' => $this->input->post('username', TRUE),
				'password' => sha1($this->input->post('password', TRUE)),
				'level_id' => $this->input->post('level_id', TRUE),
				'email' => $this->input->post('email', TRUE),
				'photo' => $photo,

			);

			$this->User_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('user'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->User_model->get_by_id($id);
		if ($row) {
			$data = array(
				'button' => 'Update',
				'level' => $this->Level_model->get_all(),
				'action' => site_url('user/update_action'),
				'user_id' => set_value('user_id', $row->user_id),
				'nama_user' => set_value('nama_user', $row->nama_user),
				'username' => set_value('username', $row->username),
				'password' => set_value('password', $row->password),
				'level_id' => set_value('level_id', $row->level_id),
				'email' => set_value('email', $row->email),
				'photo' => set_value('photo', $row->photo),
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			);
			$this->template->load('template', 'user/user_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('user'));
		}
	}

	public function update_action()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('user_id', TRUE));
		} else {

			$config['upload_path']      = './assets/assets/img/user';
			$config['allowed_types']    = 'jpg|png|jpeg|gif';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("photo")) {
				$id = $this->input->post('user_id');
				$row = $this->User_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {

					$target_file = './assets/assets/img/user/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}

			if ($this->input->post('password') == '' || $this->input->post('password') == null) {
				$data = array(
					'nama_user' => $this->input->post('nama_user', TRUE),
					'username' => $this->input->post('username', TRUE),
					'level_id' => $this->input->post('level_id', TRUE),
					'email' => $this->input->post('email', TRUE),
					'photo' => $photo,
				);
			} else {
				$data = array(
					'nama_user' => $this->input->post('nama_user', TRUE),
					'username' => $this->input->post('username', TRUE),
					'password' => sha1($this->input->post('password', TRUE)),
					'level_id' => $this->input->post('level_id', TRUE),
					'email' => $this->input->post('email', TRUE),
					'photo' => $photo,
				);
			}



			$this->User_model->update($this->input->post('user_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('user'));
		}
	}

	public function delete($id)
	{
		$row = $this->User_model->get_by_id($id);

		if ($row) {
			if ($row->photo == null || $row->photo == '') {
			} else {
				$target_file = './assets/assets/img/user/' . $row->photo;
				unlink($target_file);
			}

			$this->User_model->delete($id);
			$error = $this->db->error();
			if ($error['code'] != 0) {
				$this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
			} else {
				$this->session->set_flashdata('message', 'Delete Record Success');
			}
			redirect(site_url('user'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('user'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		// $this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('level_id', 'level id', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('photo', 'photo', 'trim');
		$this->form_validation->set_rules('user_id', 'user_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function download($gambar)
	{
		force_download('assets/assets/img/user/' . $gambar, NULL);
	}


	public function update_profile()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('user_id', TRUE));
		} else {

			$config['upload_path']      = './assets/assets/img/user';
			$config['allowed_types']    = 'jpg|png|jpeg|gif';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("photo")) {
				$id = $this->input->post('user_id');
				$row = $this->User_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {

					$target_file = './assets/assets/img/user/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}

			if ($this->input->post('password') == '' || $this->input->post('password') == null) {
				$data = array(
					'nama_user' => $this->input->post('nama_user', TRUE),
					'username' => $this->input->post('username', TRUE),
					'level_id' => $this->input->post('level_id', TRUE),
					'email' => $this->input->post('email', TRUE),
					'photo' => $photo,
				);
			} else {
				$data = array(
					'nama_user' => $this->input->post('nama_user', TRUE),
					'username' => $this->input->post('username', TRUE),
					'password' => sha1($this->input->post('password', TRUE)),
					'level_id' => $this->input->post('level_id', TRUE),
					'email' => $this->input->post('email', TRUE),
					'photo' => $photo,
				);
			}

			$this->User_model->update($this->input->post('user_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('user/edit_profile'));
		}
	}
}
