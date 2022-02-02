<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Official_receipt extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Currency_model');
		$this->load->model('File_model');
		$this->load->model('Official_receipt_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$official_receipt = $this->Official_receipt_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'official_receipt_data' => $official_receipt,
		);
		$this->template->load('template', 'official_receipt/official_receipt_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),

				'or_id' => $row->or_id,
				'or_no' => $row->or_no,
				'file_id' => $row->file_id,
				'or_date' => $row->or_date,
				'insurer_id' => $row->insurer_id,
				'currency_id' => $row->currency_id,
				'total_fee' => $row->total_fee,
				'expense' => $row->expense,
				'description' => $row->description,
			);
			$this->template->load('template', 'official_receipt/official_receipt_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('official_receipt'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'kodeunik' => $this->Official_receipt_model->get_no(),
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'currency_data' => $this->Currency_model->get_all(),
			'file' => $this->File_model->get_all_final(),
			'action' => site_url('official_receipt/create_action'),
			'or_id' => set_value('or_id'),
			'or_no' => set_value('or_no'),
			'file_id' => set_value('file_id'),
			'or_date' => set_value('or_date'),
			'insurer_id' => set_value('insurer_id'),
			'currency_id' => set_value('currency_id'),
			'total_fee' => set_value('total_fee'),
			'expense' => set_value('expense'),
			'description' => set_value('description'),
		);
		$this->template->load('template', 'official_receipt/official_receipt_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'or_no' => $this->input->post('or_no', TRUE),
				'file_id' => $this->input->post('file_id', TRUE),
				'or_date' => $this->input->post('or_date', TRUE),
				'insurer_id' => $this->input->post('insurer_id', TRUE),
				'currency_id' => $this->input->post('currency_id', TRUE),
				'total_fee' => $this->input->post('total_fee', TRUE),
				'expense' => $this->input->post('expense', TRUE),
				'description' => $this->input->post('description', TRUE),
			);

			$this->Official_receipt_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('official_receipt'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('official_receipt/update_action'),
				'or_id' => set_value('or_id', $row->or_id),
				'or_no' => set_value('or_no', $row->or_no),
				'file_id' => set_value('file_id', $row->file_id),
				'or_date' => set_value('or_date', $row->or_date),
				'insurer_id' => set_value('insurer_id', $row->insurer_id),
				'currency_id' => set_value('currency_id', $row->currency_id),
				'total_fee' => set_value('total_fee', $row->total_fee),
				'expense' => set_value('expense', $row->expense),
				'description' => set_value('description', $row->description),
			);
			$this->template->load('template', 'official_receipt/official_receipt_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('official_receipt'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('or_id', TRUE)));
		} else {
			$data = array(
				'or_no' => $this->input->post('or_no', TRUE),
				'file_id' => $this->input->post('file_id', TRUE),
				'or_date' => $this->input->post('or_date', TRUE),
				'insurer_id' => $this->input->post('insurer_id', TRUE),
				'currency_id' => $this->input->post('currency_id', TRUE),
				'total_fee' => $this->input->post('total_fee', TRUE),
				'expense' => $this->input->post('expense', TRUE),
				'description' => $this->input->post('description', TRUE),
			);

			$this->Official_receipt_model->update($this->input->post('or_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('official_receipt'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));

		if ($row) {
			$this->Official_receipt_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('official_receipt'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('official_receipt'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('or_no', 'or no', 'trim|required');
		$this->form_validation->set_rules('file_id', 'file id', 'trim|required');
		$this->form_validation->set_rules('or_date', 'or date', 'trim|required');
		$this->form_validation->set_rules('insurer_id', 'insurer id', 'trim|required');
		$this->form_validation->set_rules('currency_id', 'currency id', 'trim|required');
		$this->form_validation->set_rules('total_fee', 'total fee', 'trim|required');
		$this->form_validation->set_rules('expense', 'expense', 'trim|required');
		$this->form_validation->set_rules('description', 'description', 'trim|required');

		$this->form_validation->set_rules('or_id', 'or_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function get_detail_or()
	{
		$data = 'ramdan';
		echo json_encode($data);
	}

	function get_detail_insurer()
	{
		$id = $this->input->post('file_id');
		$output = '';
		$data = $this->db->query("SELECT * from detail_insurer join insurer on insurer.insurer_id=detail_insurer.insurer_id
		join type_insurer on type_insurer.type_insurer_id=detail_insurer.type_insurer_id where file_id='$id'")->result();
		$query_cek = $this->db->query("SELECT * from detail_insurer where file_id='$id'");
		$jml = $query_cek->num_rows();

		if ($id == null || $id == '') {
			$output .= '<option value=""  style="color: black;">-- Pilih --</option>';
		} else {
			if ($jml > 0) {
				$output .= '
							<option value=""  style="color: black;">-- Pilih --</option>';
				foreach ($data as $row) {
					$output .= ' <option  style="color: black;" value="' . $row->insurer_id . '">' . $row->type_insurer_name . ' - ' . $row->insurer_name . ' - ' . $row->fee . '%' . '</option>
				  ';
				}
			} else {
				$output .= '<option value=""  style="color: black;">-- Pilih --</option>';
			}
		}
		echo $output;
	}

	public function get_rate()
	{
		$currency_id = $this->input->post('currency_id');
		if ($currency_id == null || $currency_id == '') {
			$output = '-';
		} else {
			$query = $this->db->query("SELECT * from currency where currency_id='$currency_id'");
			$row = $query->row();
			if (isset($row)) {
				$output =  $row->rate;
			}
		}
		echo $output;
	}

	public function get_percentage()
	{
		$insurer_id = $this->input->post('insurer_id');
		$file_id = 23;
		if ($insurer_id == null || $insurer_id == '') {
			$output = '-';
		} else {
			$query = $this->db->query("SELECT * from detail_insurer where insurer_id='$insurer_id' and file_id='$file_id'");
			$row = $query->row();
			if (isset($row)) {
				$output =  $row->fee;
			}
		}
		echo $output;
	}

	public function total_fee()
	{
		$file_id = $this->input->post('file_id');
		if ($file_id == null || $file_id == '') {
			$output = 0;
		} else {
			$query = $this->db->query("SELECT * from file where file_id='$file_id'");
			$row = $query->row();
			if (isset($row)) {
				$output =  $row->total_fee;
			}
		}
		echo $output;
	}
}
