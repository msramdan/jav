<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Service extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Service_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$service = $this->Service_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'service_data' => $service,
		);
		$this->template->load('template', 'service/service_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Service_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),

				'service_id' => $row->service_id,
				'service_name' => $row->service_name,
				'icon' => $row->icon,
			);
			$this->template->load('template', 'service/service_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('service'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('service/create_action'),
			'service_id' => set_value('service_id'),
			'service_name' => set_value('service_name'),
			'icon' => set_value('icon'),
		);
		$this->template->load('template', 'service/service_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'service_name' => $this->input->post('service_name', TRUE),
				'icon' => $this->input->post('icon', TRUE),
			);
			$this->Service_model->insert($data);
			$service_id =  $this->db->insert_id();

			$service_detail_name       		= $_POST['service_detail_name'];
			if ($service_detail_name) {
				$jumlah_data = count($service_detail_name);
				for ($i = 0; $i < $jumlah_data; $i++) {
					$service_detail['service_id'] = $service_id;
					$service_detail['service_detail_name'] = $service_detail_name[$i];
					$this->db->insert('service_detail', $service_detail);
				}
			}

			
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('service'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Service_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('service/update_action'),
				'service_id' => set_value('service_id', $row->service_id),
				'service_name' => set_value('service_name', $row->service_name),
				'icon' => set_value('icon', $row->icon),
			);
			$this->template->load('template', 'service/service_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('service'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('service_id', TRUE)));
		} else {

			
			//delete detail insurer
			$this->db->where('service_id', $this->input->post('service_id', TRUE));
			$this->db->delete('service_detail');

			// input baru
			$service_detail_name       		= $_POST['service_detail_name'];
			if ($service_detail_name) {
				$jumlah_data = count($service_detail_name);
				for ($i = 0; $i < $jumlah_data; $i++) {
					$service_detail['service_id'] = $this->input->post('service_id', TRUE);
					$service_detail['service_detail_name'] = $service_detail_name[$i];
					$this->db->insert('service_detail', $service_detail);
				}
			}

			$data = array(
				'service_name' => $this->input->post('service_name', TRUE),
				'icon' => $this->input->post('icon', TRUE),
			);

			$this->Service_model->update($this->input->post('service_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('service'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Service_model->get_by_id(decrypt_url($id));

		if ($row) {
			$this->Service_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('service'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('service'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('service_name', 'service name', 'trim|required');
		$this->form_validation->set_rules('icon', 'icon', 'trim|required');

		$this->form_validation->set_rules('service_id', 'service_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Service.php */
/* Location: ./application/controllers/Service.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-06 01:35:13 */
/* http://harviacode.com */
