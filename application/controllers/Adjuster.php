<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Adjuster extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Adjuster_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$adjuster = $this->Adjuster_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'adjuster_data' => $adjuster,
		);
		$this->template->load('template', 'adjuster/adjuster_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Adjuster_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),

				'adjuster_id' => $row->adjuster_id,
				'adjuster_code' => $row->adjuster_code,
				'adjuster_name' => $row->adjuster_name,
			);
			$this->template->load('template', 'adjuster/adjuster_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adjuster'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('adjuster/create_action'),
			'adjuster_id' => set_value('adjuster_id'),
			'adjuster_code' => set_value('adjuster_code'),
			'adjuster_name' => set_value('adjuster_name'),
		);
		$this->template->load('template', 'adjuster/adjuster_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'adjuster_code' => $this->input->post('adjuster_code', TRUE),
				'adjuster_name' => $this->input->post('adjuster_name', TRUE),
			);

			$this->Adjuster_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('adjuster'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Adjuster_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('adjuster/update_action'),
				'adjuster_id' => set_value('adjuster_id', $row->adjuster_id),
				'adjuster_code' => set_value('adjuster_code', $row->adjuster_code),
				'adjuster_name' => set_value('adjuster_name', $row->adjuster_name),
			);
			$this->template->load('template', 'adjuster/adjuster_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adjuster'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('adjuster_id', TRUE)));
		} else {
			$data = array(
				'adjuster_code' => $this->input->post('adjuster_code', TRUE),
				'adjuster_name' => $this->input->post('adjuster_name', TRUE),
			);

			$this->Adjuster_model->update($this->input->post('adjuster_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('adjuster'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Adjuster_model->get_by_id(decrypt_url($id));

		if ($row) {
			$this->Adjuster_model->delete(decrypt_url($id));
			$error = $this->db->error();	
			if ($error['code'] != 0) {
				$this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
			} else {
				$this->session->set_flashdata('message', 'Delete Record Success');
			}
			redirect(site_url('adjuster'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adjuster'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('adjuster_code', 'adjuster code', 'trim|required');
		$this->form_validation->set_rules('adjuster_name', 'adjuster name', 'trim|required');

		$this->form_validation->set_rules('adjuster_id', 'adjuster_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Adjuster.php */
/* Location: ./application/controllers/Adjuster.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-27 16:56:11 */
/* http://harviacode.com */
