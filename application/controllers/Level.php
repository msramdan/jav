<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Level extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Level_model');
		$this->load->model('Menu_model');
		$this->load->model('Setting_app_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$level = $this->Level_model->get_all();
		$data = array(
			'level_data' => $level,
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template', 'level/level_list', $data);
	}

	public function changeaccess()
	{
		$subMenuId = $this->input->post('subMenuId');
		$levelId = $this->input->post('levelId');

		$data = [
			'level_id' => $levelId,
			'sub_menu_id' => $subMenuId
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
	}

	public function changeaccess_read()
	{
		$subMenuId = $this->input->post('subMenuId');
		$levelId = $this->input->post('levelId');
		$data = [
			'level_id' => $levelId,
			'sub_menu_id' => $subMenuId
		];

		$result = $this->db->get_where('user_access_menu', $data);
		$row = $result->row();
		if ($row->read == 1) {
			$data = [
				'read' => 0
			];
		} else {
			$data = [
				'read' => 1
			];
		}
		$this->db->where('level_id', $levelId);
		$this->db->where('sub_menu_id', $subMenuId);
		$this->db->update('user_access_menu', $data);
	}

	public function changeaccess_create()
	{
		$subMenuId = $this->input->post('subMenuId');
		$levelId = $this->input->post('levelId');
		$data = [
			'level_id' => $levelId,
			'sub_menu_id' => $subMenuId
		];

		$result = $this->db->get_where('user_access_menu', $data);
		$row = $result->row();
		if ($row->create == 1) {
			$data = [
				'create' => 0
			];
		} else {
			$data = [
				'create' => 1
			];
		}
		$this->db->where('level_id', $levelId);
		$this->db->where('sub_menu_id', $subMenuId);
		$this->db->update('user_access_menu', $data);
	}

	public function changeaccess_update()
	{
		$subMenuId = $this->input->post('subMenuId');
		$levelId = $this->input->post('levelId');
		$data = [
			'level_id' => $levelId,
			'sub_menu_id' => $subMenuId
		];

		$result = $this->db->get_where('user_access_menu', $data);
		$row = $result->row();
		if ($row->update == 1) {
			$data = [
				'update' => 0
			];
		} else {
			$data = [
				'update' => 1
			];
		}
		$this->db->where('level_id', $levelId);
		$this->db->where('sub_menu_id', $subMenuId);
		$this->db->update('user_access_menu', $data);
	}

	public function changeaccess_delete()
	{
		$subMenuId = $this->input->post('subMenuId');
		$levelId = $this->input->post('levelId');
		$data = [
			'level_id' => $levelId,
			'sub_menu_id' => $subMenuId
		];

		$result = $this->db->get_where('user_access_menu', $data);
		$row = $result->row();
		if ($row->delete == 1) {
			$data = [
				'delete' => 0
			];
		} else {
			$data = [
				'delete' => 1
			];
		}
		$this->db->where('level_id', $levelId);
		$this->db->where('sub_menu_id', $subMenuId);
		$this->db->update('user_access_menu', $data);
	}

	public function changeaccess_export()
	{
		$subMenuId = $this->input->post('subMenuId');
		$levelId = $this->input->post('levelId');
		$data = [
			'level_id' => $levelId,
			'sub_menu_id' => $subMenuId
		];

		$result = $this->db->get_where('user_access_menu', $data);
		$row = $result->row();
		if ($row->export == 1) {
			$data = [
				'export' => 0
			];
		} else {
			$data = [
				'export' => 1
			];
		}
		$this->db->where('level_id', $levelId);
		$this->db->where('sub_menu_id', $subMenuId);
		$this->db->update('user_access_menu', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Level_model->get_by_id($id);
		if ($row) {
			$data = array(
				'level_id' => $row->level_id,
				'nama_level' => $row->nama_level,
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			);
			$this->template->load('template', 'level/level_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('level'));
		}
	}

	public function role($id)
	{
		$data['role'] = $this->db->get_where('level', ['level_id' => $id])->row_array();
		$data['row'] = $this->Menu_model->get();
		$data['sett_apps'] = $this->Setting_app_model->get_by_id(1);
		$this->template->load('template', 'level/role', $data);
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'action' => site_url('level/create_action'),
			'level_id' => set_value('level_id'),
			'nama_level' => set_value('nama_level'),
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template', 'level/level_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nama_level' => $this->input->post('nama_level', TRUE),
			);

			$this->Level_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('level'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Level_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('level/update_action'),
				'level_id' => set_value('level_id', $row->level_id),
				'nama_level' => set_value('nama_level', $row->nama_level),
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
				
			);
			$this->template->load('template', 'level/level_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('level'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('level_id', TRUE));
		} else {
			$data = array(
				'nama_level' => $this->input->post('nama_level', TRUE),
			);

			$this->Level_model->update($this->input->post('level_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('level'));
		}
	}

	public function delete($id)
	{
		$row = $this->Level_model->get_by_id($id);

		if ($row) {
			$this->Level_model->delete($id);
			$error = $this->db->error();	
			if ($error['code'] != 0) {
				$this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
			} else {
				$this->session->set_flashdata('message', 'Delete Record Success');
			}
			redirect(site_url('level'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('level'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_level', 'nama level', 'trim|required');

		$this->form_validation->set_rules('level_id', 'level_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
