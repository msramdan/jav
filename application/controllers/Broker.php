<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Broker extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Broker_model');
		$this->load->model('Setting_app_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$broker = $this->Broker_model->get_all();
		$data = array(
			'broker_data' => $broker,
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template', 'broker/broker_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Broker_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'broker_id' => $row->broker_id,
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
				'broker_code' => $row->broker_code,
				'broker_name' => $row->broker_name,
				'address' => $row->address,
				'name_on_tax' => $row->name_on_tax,
				'address_on_tax' => $row->address_on_tax,
				'npwp' => $row->npwp,
			);
			$this->template->load('template', 'broker/broker_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('broker'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			'action' => site_url('broker/create_action'),
			'broker_id' => set_value('broker_id'),
			'broker_code' => set_value('broker_code'),
			'broker_name' => set_value('broker_name'),
			'address' => set_value('address'),
			'name_on_tax' => set_value('name_on_tax'),
			'address_on_tax' => set_value('address_on_tax'),
			'npwp' => set_value('npwp'),
		);
		$this->template->load('template', 'broker/broker_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'broker_code' => $this->input->post('broker_code', TRUE),
				'broker_name' => $this->input->post('broker_name', TRUE),
				'address' => $this->input->post('address', TRUE),
				'name_on_tax' => $this->input->post('name_on_tax', TRUE),
				'address_on_tax' => $this->input->post('address_on_tax', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
			);

			$this->Broker_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('broker'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Broker_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
				'action' => site_url('broker/update_action'),
				'broker_id' => set_value('broker_id', $row->broker_id),
				'broker_code' => set_value('broker_code', $row->broker_code),
				'broker_name' => set_value('broker_name', $row->broker_name),
				'address' => set_value('address', $row->address),
				'name_on_tax' => set_value('name_on_tax', $row->name_on_tax),
				'address_on_tax' => set_value('address_on_tax', $row->address_on_tax),
				'npwp' => set_value('npwp', $row->npwp),
			);
			$this->template->load('template', 'broker/broker_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('broker'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('broker_id')));
		} else {
			$data = array(
				'broker_code' => $this->input->post('broker_code', TRUE),
				'broker_name' => $this->input->post('broker_name', TRUE),
				'address' => $this->input->post('address', TRUE),
				'name_on_tax' => $this->input->post('name_on_tax', TRUE),
				'address_on_tax' => $this->input->post('address_on_tax', TRUE),
				'npwp' => $this->input->post('npwp', TRUE),
			);

			$this->Broker_model->update($this->input->post('broker_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('broker'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Broker_model->get_by_id(decrypt_url($id));

		if ($row) {
			$this->Broker_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('broker'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('broker'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('broker_code', 'broker code', 'trim|required');
		$this->form_validation->set_rules('broker_name', 'broker name', 'trim|required');
		$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('name_on_tax', 'name on tax', 'trim|required');
		$this->form_validation->set_rules('address_on_tax', 'address on tax', 'trim|required');
		$this->form_validation->set_rules('npwp', 'npwp', 'trim|required');

		$this->form_validation->set_rules('broker_id', 'broker_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Broker.php */
/* Location: ./application/controllers/Broker.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-26 13:33:55 */
/* http://harviacode.com */
