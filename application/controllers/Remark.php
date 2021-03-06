<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Remark extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Remark_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$remark = $this->Remark_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'remark_data' => $remark,
		);
		$this->template->load('template', 'remark/remark_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Remark_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),

				'remark_id' => $row->remark_id,
				'remark_code' => $row->remark_code,
				'remark_name' => $row->remark_name,
				'status_case' => $row->status_case,
			);
			$this->template->load('template', 'remark/remark_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('remark'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('remark/create_action'),
			'remark_id' => set_value('remark_id'),
			'remark_code' => set_value('remark_code'),
			'remark_name' => set_value('remark_name'),
			'status_case' => set_value('status_case'),
		);
		$this->template->load('template', 'remark/remark_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'remark_code' => $this->input->post('remark_code', TRUE),
				'remark_name' => $this->input->post('remark_name', TRUE),
				'status_case' => $this->input->post('status_case', TRUE),
			);

			$this->Remark_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('remark'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Remark_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('remark/update_action'),
				'remark_id' => set_value('remark_id', $row->remark_id),
				'remark_code' => set_value('remark_code', $row->remark_code),
				'remark_name' => set_value('remark_name', $row->remark_name),
				'status_case' => set_value('status_case', $row->status_case),
			);
			$this->template->load('template', 'remark/remark_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('remark'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('remark_id', TRUE)));
		} else {
			$data = array(
				'remark_code' => $this->input->post('remark_code', TRUE),
				'remark_name' => $this->input->post('remark_name', TRUE),
				'status_case' => $this->input->post('status_case', TRUE),
			);

			$this->Remark_model->update($this->input->post('remark_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('remark'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Remark_model->get_by_id(decrypt_url($id));

		if ($row) {
			$this->Remark_model->delete(decrypt_url($id));
			$error = $this->db->error();
			if ($error['code'] != 0) {
				$this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
			} else {
				$this->session->set_flashdata('message', 'Delete Record Success');
			}
			redirect(site_url('remark'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('remark'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('remark_code', 'remark code', 'trim|required');
		$this->form_validation->set_rules('remark_name', 'remark name', 'trim|required');
		$this->form_validation->set_rules('status_case', 'status case', 'trim|required');

		$this->form_validation->set_rules('remark_id', 'remark_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Remark.php */
/* Location: ./application/controllers/Remark.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-01 14:36:37 */
/* http://harviacode.com */
