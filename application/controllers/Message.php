<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Message extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Message_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$message = $this->Message_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'message_data' => $message,
		);
		$this->template->load('template', 'message/message_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Message_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),

				'message_id' => $row->message_id,
				'first_name' => $row->first_name,
				'last_name' => $row->last_name,
				'message' => $row->message,
				'email' => $row->email,
				'create_date' => $row->create_date,
			);
			$this->template->load('template', 'message/message_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('message'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('message/create_action'),
			'message_id' => set_value('message_id'),
			'first_name' => set_value('first_name'),
			'last_name' => set_value('last_name'),
			'message' => set_value('message'),
			'email' => set_value('email'),
			'create_date' => set_value('create_date'),
		);
		$this->template->load('template', 'message/message_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'first_name' => $this->input->post('first_name', TRUE),
				'last_name' => $this->input->post('last_name', TRUE),
				'message' => $this->input->post('message', TRUE),
				'email' => $this->input->post('email', TRUE),
				'create_date' => date('Y-m-d'),
			);

			$this->Message_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('message'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Message_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('message/update_action'),
				'message_id' => set_value('message_id', $row->message_id),
				'first_name' => set_value('first_name', $row->first_name),
				'last_name' => set_value('last_name', $row->last_name),
				'message' => set_value('message', $row->message),
				'email' => set_value('email', $row->email),
				'create_date' => set_value('create_date', $row->create_date),
			);
			$this->template->load('template', 'message/message_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('message'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('message_id', TRUE)));
		} else {
			$data = array(
				'first_name' => $this->input->post('first_name', TRUE),
				'last_name' => $this->input->post('last_name', TRUE),
				'message' => $this->input->post('message', TRUE),
				'email' => $this->input->post('email', TRUE),
				'create_date' => $this->input->post('create_date', TRUE),
			);

			$this->Message_model->update($this->input->post('message_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('message'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Message_model->get_by_id(decrypt_url($id));

		if ($row) {
			$this->Message_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('message'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('message'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
		$this->form_validation->set_rules('message', 'message', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('message_id', 'message_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Message.php */
/* Location: ./application/controllers/Message.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-05 15:47:26 */
/* http://harviacode.com */
