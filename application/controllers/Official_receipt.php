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
		$file_id = $this->input->post('file_id');
		if (isset($_POST['process_simpan'])) {
			$query = $this->db->query("SELECT * FROM official_receipt where file_id='$file_id'");
			$cek = $query->num_rows();
			if ($cek < 1) {
				$file_data = array(
					'fee_all' => $this->input->post('fee_all'),
				);
				$this->File_model->update($this->input->post('file_id', TRUE), $file_data);
			}

			$data = array(
				'or_no' => $this->input->post('or_no'),
				'file_id' => $this->input->post('file_id'),
				'or_date' => $this->input->post('or_date'),
				'invoice_no' => $this->input->post('invoice_no'),
				'invoice_date' => $this->input->post('invoice_date'),
				'insurer_id' => $this->input->post('insurer_id'),
				'currency_id' => $this->input->post('currency_id'),
				'percentage' => $this->input->post('percentage'),
				'total_fee' => $this->input->post('total_fee'),
				'discount' => $this->input->post('discount'),
				'vat' => $this->input->post('vat'),
				'expense' => $this->input->post('expense'),
				'description' => $this->input->post('description'),
				'status' => 'Unpaid',
			);
			$this->Official_receipt_model->insert($data);
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));
		// var_dump($row->fee_all);
		// die();
		if ($row) {
			$detail_or = $this->db->query("SELECT * from official_receipt where file_id='$row->file_id'")->result();
			$insurer_data = $this->db->query("SELECT * from detail_insurer join insurer on insurer.insurer_id=detail_insurer.insurer_id
			join type_insurer on type_insurer.type_insurer_id=detail_insurer.type_insurer_id where file_id='$row->file_id'")->result();

			if ($row->vat == 'Before Expense') {
				$hasil = ((($row->total_fee + $row->expense) + ($row->total_fee) * 10 / 100) - $row->discount);
			} else if ($row->vat == 'After Expense') {
				$hasil = ((($row->total_fee + $row->expense) + ($row->total_fee + $row->expense) * 10 / 100) - $row->discount);
			}

			$data = array(
				'button' => 'Update',
				'currency_data' => $this->Currency_model->get_all(),
				'detail_or' => $detail_or,
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('official_receipt/update_action'),
				'or_id' => set_value('or_id', $row->or_id),
				'insurer_data' => $insurer_data,
				'invoice_no' => set_value('invoice_no', $row->invoice_no),
				'invoice_date' => set_value('invoice_date', $row->invoice_date),
				'or_id' => set_value('or_id', $row->or_id),
				'or_no' => set_value('or_no', $row->or_no),
				'file_id' => set_value('file_id', $row->file_id),
				'or_date' => set_value('or_date', $row->or_date),
				'ref_no' => set_value('ref_no', $row->ref_no),
				'insurer_id' => set_value('insurer_id', $row->insurer_id),
				'currency_id' => set_value('currency_id', $row->currency_id),
				'total_fee' => set_value('total_fee', $row->total_fee),
				'fee_all' => set_value('fee_all', $row->fee_all),
				'expense' => set_value('expense', $row->expense),
				'discount' => set_value('discount', $row->discount),
				'status' => set_value('status', $row->status),
				'description' => set_value('description', $row->description),
				'currency_code' => set_value('currency_code', $row->currency_code),
				'rate' => set_value('rate', $row->rate),
				'vat' => set_value('vat', $row->vat),
				'percentage' => set_value('percentage', $row->percentage),
				'grand_total' => set_value('grand_total', $hasil),

			);
			$this->template->load('template', 'official_receipt/official_receipt_update', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('official_receipt'));
		}
	}

	public function update_action()
	{
		if (isset($_POST['process_update'])) {
			$data = array(
				'or_no' => $this->input->post('or_no'),
				'file_id' => $this->input->post('file_id'),
				'or_date' => $this->input->post('or_date'),
				'invoice_no' => $this->input->post('invoice_no'),
				'invoice_date' => $this->input->post('invoice_date'),
				'insurer_id' => $this->input->post('insurer_id'),
				'currency_id' => $this->input->post('currency_id'),
				'percentage' => $this->input->post('percentage'),
				'total_fee' => $this->input->post('total_fee'),
				'discount' => $this->input->post('discount'),
				'vat' => $this->input->post('vat'),
				'expense' => $this->input->post('expense'),
				'description' => $this->input->post('description'),
				'status' => $this->input->post('status'),
			);
			$this->Official_receipt_model->update($this->input->post('or_id'), $data);
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));
		if ($row) {
			$this->Official_receipt_model->delete(decrypt_url($id));

			$query = $this->db->query("SELECT * FROM official_receipt where file_id='$row->file_id'");
			$cek = $query->num_rows();
			if ($cek < 1) {
				$file_data = array(
					'fee_all' => 0,
				);
				$this->File_model->update($row->file_id, $file_data);
			}
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
		$id = $this->input->post('file_id');
		$output = '';
		$data = $this->db->query("SELECT * from official_receipt where file_id='$id'")->result();
		$query_cek = $this->db->query("SELECT * from detail_insurer where file_id='$id'");
		$jml = $query_cek->num_rows();
		$i = 1;
		if ($id == null || $id == '') {
			$output .= '<tr><td colspan="2">No data</td></tr>';
		} else {
			if ($jml > 0) {
				foreach ($data as $row) {
					$output .= '<tr><td>' . $i++ . '</td><td>' . $row->or_no . '</td></tr>';
				}
			} else {
				$output .= '<tr><td colspan="2">No data</td></tr>';
			}
		}

		echo $output;
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

	public function get_currency_code()
	{
		$currency_id = $this->input->post('currency_id');
		if ($currency_id == null || $currency_id == '') {
			$output = '';
		} else {
			$query = $this->db->query("SELECT * from currency where currency_id='$currency_id'");
			$row = $query->row();
			if (isset($row)) {
				$output =  $row->currency_code;
			}
		}
		echo $output;
	}

	public function get_percentage()
	{
		$insurer_id = $this->input->post('insurer_id');
		$file_id = $this->input->post('file_id');
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
				$output =  $row->fee_all;
			}
		}
		echo $output;
	}
	public function print_or($id)
	{
		$this->load->library('dompdf_gen');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));
		if ($row->vat == 'Before Expense') {
			$hasil = ((($row->total_fee + $row->expense) + ($row->total_fee) * 10 / 100) - $row->discount);
		} else if ($row->vat == 'After Expense') {
			$hasil = ((($row->total_fee + $row->expense) + ($row->total_fee + $row->expense) * 10 / 100) - $row->discount);
		}

		$data = array(
			'or_id' => $row->or_id,
			'ref_no' => $row->ref_no,
			'hasil' => $hasil,
			'or_no' => $row->or_no,
			'file_id' => $row->file_id,
			'or_date' => $row->or_date,
			'percentage' => $row->percentage,
			'insurer_name' => $row->insurer_name,
			'address' => $row->address,
			'insurer_ref_no' => $row->insurer_ref_no,
			'insured' => $row->insured,
			'date_of_loss' => $row->date_of_loss,
			'policy_number' => $row->policy_number,
			'fee_all' => $row->fee_all,
			'currency_code' => $row->currency_code,
			'says' => $row->says,
			'total_fee' => $row->total_fee,
			'vat' => $row->vat,
			'expense' => $row->expense,
			'description' => $row->description,
			'situation_of_loss' => $row->situation_of_loss,
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
		);
		$this->load->view('official_receipt/print_or', $data);
		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("OR.pdf", array('Attachment' => 0));
	}

	public function print_breakdown($id)
	{
		$this->load->library('dompdf_gen');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));
		$data = array(
			'or_id' => $row->or_id,
			'ref_no' => $row->ref_no,
			'or_no' => $row->or_no,
			'file_id' => $row->file_id,
			'or_date' => $row->or_date,
			'percentage' => $row->percentage,
			'insurer_name' => $row->insurer_name,
			'address' => $row->address,
			'insurer_ref_no' => $row->insurer_ref_no,
			'insured' => $row->insured,
			'date_of_loss' => $row->date_of_loss,
			'policy_number' => $row->policy_number,
			'fee_all' => $row->fee_all,
			'currency_code' => $row->currency_code,
			'says' => $row->says,
			'total_fee' => $row->total_fee,
			'vat' => $row->vat,
			'expense' => $row->expense,
			'discount' => $row->discount,
			'description' => $row->description,
			'situation_of_loss' => $row->situation_of_loss,
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
		);
		$this->load->view('official_receipt/print_breakdown', $data);
		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Breakdown.pdf", array('Attachment' => 0));
	}

	public function print_invoice($id)
	{
		$this->load->library('dompdf_gen');
		$row = $this->Official_receipt_model->get_by_id(decrypt_url($id));
		$data = array(
			'or_id' => $row->or_id,
			'ref_no' => $row->ref_no,
			'or_no' => $row->or_no,
			'file_id' => $row->file_id,
			'or_date' => $row->or_date,
			'percentage' => $row->percentage,
			'insurer_name' => $row->insurer_name,
			'address' => $row->address,
			'insurer_ref_no' => $row->insurer_ref_no,
			'insured' => $row->insured,
			'date_of_loss' => $row->date_of_loss,
			'policy_number' => $row->policy_number,
			'fee_all' => $row->fee_all,
			'currency_code' => $row->currency_code,
			'invoice_no' => $row->invoice_no,
			'says' => $row->says,
			'total_fee' => $row->total_fee,
			'discount' => $row->discount,
			'vat' => $row->vat,
			'expense' => $row->expense,
			'description' => $row->description,
			'situation_of_loss' => $row->situation_of_loss,
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
		);
		$this->load->view('official_receipt/print_invoice', $data);
		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Invoice.pdf", array('Attachment' => 0));
	}
}
