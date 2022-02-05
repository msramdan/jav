<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sub_menu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Sub_menu_model');
		$this->load->model('Setting_app_model');
		$this->load->model('Menu_model');
		$this->load->library('form_validation');
	}

	public function read($id)
	{
		$row = $this->Sub_menu_model->get_by_id($id);
		if ($row) {
			$data = array(
				'sub_menu_id' => $row->sub_menu_id,
				'menu_id' => $row->menu_id,
				'nama_sub_menu' => $row->nama_sub_menu,
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
				'url' => $row->url,
			);
			$this->template->load('template', 'sub_menu/sub_menu_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('sub_menu'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'menu' => $this->Menu_model->get_all(),
			'action' => site_url('sub_menu/create_action'),
			'sub_menu_id' => set_value('sub_menu_id'),
			'menu_id' => set_value('menu_id'),
			'nama_sub_menu' => set_value('nama_sub_menu'),
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			'url' => set_value('url'),
		);
		$this->template->load('template', 'sub_menu/sub_menu_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'menu_id' => $this->input->post('menu_id', TRUE),
				'nama_sub_menu' => $this->input->post('nama_sub_menu', TRUE),
				'url' => $this->input->post('url', TRUE),
			);

			$this->Sub_menu_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('menu'));
		}
	}

	public function update($id)
	{
		$row = $this->Sub_menu_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'menu' => $this->Menu_model->get_all(),
				'action' => site_url('sub_menu/update_action'),
				'sub_menu_id' => set_value('sub_menu_id', $row->sub_menu_id),
				'menu_id' => set_value('menu_id', $row->menu_id),
				'nama_sub_menu' => set_value('nama_sub_menu', $row->nama_sub_menu),
				'url' => set_value('url', $row->url),
				'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			);
			$this->template->load('template', 'sub_menu/sub_menu_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('menu'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('sub_menu_id', TRUE));
		} else {
			$data = array(
				'menu_id' => $this->input->post('menu_id', TRUE),
				'nama_sub_menu' => $this->input->post('nama_sub_menu', TRUE),
				'url' => $this->input->post('url', TRUE),
			);

			$this->Sub_menu_model->update($this->input->post('sub_menu_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('menu'));
		}
	}

	public function delete($id)
	{
		$row = $this->Sub_menu_model->get_by_id($id);

		if ($row) {
			$this->Sub_menu_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('menu'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('menu'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('menu_id', 'menu id', 'trim|required');
		$this->form_validation->set_rules('nama_sub_menu', 'nama sub menu', 'trim|required');
		$this->form_validation->set_rules('url', 'url', 'trim|required');

		$this->form_validation->set_rules('sub_menu_id', 'sub_menu_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Sub_menu.php */
/* Location: ./application/controllers/Sub_menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-21 06:23:00 */
/* http://harviacode.com */
