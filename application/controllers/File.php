<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class File extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Remark_model');
		$this->load->model('Secretary_model');
		$this->load->model('Adjuster_model');
		$this->load->model('Trade_model');
		$this->load->model('Insurer_model');
		$this->load->model('File_model');
		$this->load->model('Type_of_loss_model');
		$this->load->model('Broker_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$file = $this->File_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'file_data' => $file,
			'insurer' => $this->Insurer_model->get_all(),
		);
		$this->template->load('template', 'file/file_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->File_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'file_id' => $row->file_id,
				'ref_no' => $row->ref_no,
				'date_of_receive' => $row->date_of_receive,
				'adjuster_id' => $row->adjuster_id,
				'trade_id' => $row->trade_id,
				'type_of_loss_id' => $row->type_of_loss_id,
				'detail_dol' => $row->detail_dol,
				'date_of_loss' => $row->date_of_loss,
				'date_of_survey' => $row->date_of_survey,
				'policy_number' => $row->policy_number,
				'situation_of_loss' => $row->situation_of_loss,
				'insurer_ref_no' => $row->insurer_ref_no,
				'insured' => $row->insured,
				'broker_id' => $row->broker_id,
				'user_id' => $row->user_id,
			);
			$this->template->load('template', 'file/file_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('file'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'kodeunik' => $this->File_model->get_ref_no(),
			'type_insurer' => $this->Insurer_model->get_all_type_insurer(),
			'adjuster' => $this->Adjuster_model->get_all(),
			'secretary' => $this->Secretary_model->get_all(),
			'remark' => $this->Remark_model->get_all(),
			'insurer' => $this->Insurer_model->get_all(),
			'trade' => $this->Trade_model->get_all(),
			'broker' => $this->Broker_model->get_all(),
			'type_of_loss' => $this->Type_of_loss_model->get_all(),
			'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('file/create_action'),
			'file_id' => set_value('file_id'),
			'ref_no' => set_value('ref_no'),
			'date_of_receive' => set_value('date_of_receive'),
			'adjuster_id' => set_value('adjuster_id'),
			'trade_id' => set_value('trade_id'),
			'type_of_loss_id' => set_value('type_of_loss_id'),
			'detail_dol' => set_value('detail_dol'),
			'date_of_loss' => set_value('date_of_loss'),
			'date_of_survey' => set_value('date_of_survey'),
			'policy_number' => set_value('policy_number'),
			'situation_of_loss' => set_value('situation_of_loss'),
			'insurer_ref_no' => set_value('insurer_ref_no'),
			'insured' => set_value('insured'),
			'broker_id' => set_value('broker_id'),
			'user_id' => set_value('user_id'),
		);
		$this->template->load('template', 'file/file_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'ref_no' => $this->input->post('ref_no', TRUE),
				'date_of_receive' => $this->input->post('date_of_receive', TRUE),
				'adjuster_id' => $this->input->post('adjuster_id', TRUE),
				'trade_id' => $this->input->post('trade_id', TRUE),
				'type_of_loss_id' => $this->input->post('type_of_loss_id', TRUE),
				'detail_dol' => $this->input->post('detail_dol', TRUE),
				'date_of_loss' => $this->input->post('date_of_loss', TRUE),
				'date_of_survey' => $this->input->post('date_of_survey', TRUE),
				'policy_number' => $this->input->post('policy_number', TRUE),
				'situation_of_loss' => $this->input->post('situation_of_loss', TRUE),
				'insurer_ref_no' => $this->input->post('insurer_ref_no', TRUE),
				'insured' => $this->input->post('insured', TRUE),
				'broker_id' => $this->input->post('broker_id', TRUE),
				'user_id' => $this->input->post('user_id', TRUE),
			);
			$this->File_model->insert($data);
			$file_id =  $this->db->insert_id();
			//insert yang detail insurer baru
			$insurer_id       = $_POST['insurer_id'];
			$type_insurer_id       	  = $_POST['type_insurer_id'];
			$jumlah_data = count($insurer_id);
			for ($i = 0; $i < $jumlah_data; $i++) {
				$detail_insurer['file_id'] = $file_id;
				$detail_insurer['insurer_id'] = $insurer_id[$i];
				$detail_insurer['type_insurer_id'] = $type_insurer_id[$i];
				$this->db->insert('detail_insurer', $detail_insurer);
			}

			//insert yang detail remark baru
			$remark_id       = $_POST['remark_id'];
			$secretary_id    = $_POST['secretary_id'];
			$date       	  = $_POST['date'];
			$fee       	  = $_POST['fee'];
			$jumlah_data2 = count($remark_id);
			for ($i = 0; $i < $jumlah_data2; $i++) {
				$remark['file_id'] = $file_id;
				$remark['remark_id'] = $remark_id[$i];
				$remark['secretary_id'] = $secretary_id[$i];
				$remark['fee'] = $fee[$i];
				$remark['date'] = $date[$i];
				$this->db->insert('detail_remark', $remark);
			}


			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('file'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->File_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'button' => 'Update',
				'adjuster' => $this->Adjuster_model->get_all(),
				'type_insurer' => $this->Insurer_model->get_all_type_insurer(),
				'secretary' => $this->Secretary_model->get_all(),
				'remark' => $this->Remark_model->get_all(),
				'insurer' => $this->Insurer_model->get_all(),
				'trade' => $this->Trade_model->get_all(),
				'broker' => $this->Broker_model->get_all(),
				'type_of_loss' => $this->Type_of_loss_model->get_all(),
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('file/update_action'),
				'file_id' => set_value('file_id', $row->file_id),
				'ref_no' => set_value('ref_no', $row->ref_no),
				'date_of_receive' => set_value('date_of_receive', $row->date_of_receive),
				'adjuster_id' => set_value('adjuster_id', $row->adjuster_id),
				'trade_id' => set_value('trade_id', $row->trade_id),
				'type_of_loss_id' => set_value('type_of_loss_id', $row->type_of_loss_id),
				'detail_dol' => set_value('detail_dol', $row->detail_dol),
				'date_of_loss' => set_value('date_of_loss', $row->date_of_loss),
				'date_of_survey' => set_value('date_of_survey', $row->date_of_survey),
				'policy_number' => set_value('policy_number', $row->policy_number),
				'situation_of_loss' => set_value('situation_of_loss', $row->situation_of_loss),
				'insurer_ref_no' => set_value('insurer_ref_no', $row->insurer_ref_no),
				'insured' => set_value('insured', $row->insured),
				'broker_id' => set_value('broker_id', $row->broker_id),
				'user_id' => set_value('user_id', $row->user_id),
			);
			$this->template->load('template', 'file/file_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('file'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('file_id', TRUE)));
		} else {

			//delete detail insurer
			$this->db->where('file_id', $this->input->post('file_id', TRUE));
			$this->db->delete('detail_insurer');
			//insert yang detail insurer baru
			$insurer_id       = $_POST['insurer_id'];
			$type_insurer_id       	  = $_POST['type_insurer_id'];
			$jumlah_data = count($insurer_id);
			for ($i = 0; $i < $jumlah_data; $i++) {
				$data['file_id'] = $this->input->post('file_id', TRUE);
				$data['insurer_id'] = $insurer_id[$i];
				$data['type_insurer_id'] = $type_insurer_id[$i];
				$this->db->insert('detail_insurer', $data);
			}

			// delete detail remark
			$this->db->where('file_id', $this->input->post('file_id', TRUE));
			$this->db->delete('detail_remark');
			//insert yang detail remark baru
			$remark_id       = $_POST['remark_id'];
			$secretary_id    = $_POST['secretary_id'];
			$date       	  = $_POST['date'];
			$fee       	  = $_POST['fee'];
			$jumlah_data2 = count($remark_id);
			for ($i = 0; $i < $jumlah_data2; $i++) {
				$remark['file_id'] = $this->input->post('file_id', TRUE);
				$remark['remark_id'] = $remark_id[$i];
				$remark['secretary_id'] = $secretary_id[$i];
				$remark['fee'] = $fee[$i];
				$remark['date'] = $date[$i];
				$this->db->insert('detail_remark', $remark);
			}


			$file_data = array(
				'ref_no' => $this->input->post('ref_no', TRUE),
				'date_of_receive' => $this->input->post('date_of_receive', TRUE),
				'adjuster_id' => $this->input->post('adjuster_id', TRUE),
				'trade_id' => $this->input->post('trade_id', TRUE),
				'type_of_loss_id' => $this->input->post('type_of_loss_id', TRUE),
				'detail_dol' => $this->input->post('detail_dol', TRUE),
				'date_of_loss' => $this->input->post('date_of_loss', TRUE),
				'date_of_survey' => $this->input->post('date_of_survey', TRUE),
				'policy_number' => $this->input->post('policy_number', TRUE),
				'situation_of_loss' => $this->input->post('situation_of_loss', TRUE),
				'insurer_ref_no' => $this->input->post('insurer_ref_no', TRUE),
				'insured' => $this->input->post('insured', TRUE),
				'broker_id' => $this->input->post('broker_id', TRUE),
				'user_id' => $this->input->post('user_id', TRUE),
			);

			$this->File_model->update($this->input->post('file_id', TRUE), $file_data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('file'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->File_model->get_by_id(decrypt_url($id));

		if ($row) {
			$this->File_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('file'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('file'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('ref_no', 'ref no', 'trim|required');
		$this->form_validation->set_rules('date_of_receive', 'date of receive', 'trim|required');
		$this->form_validation->set_rules('adjuster_id', 'adjuster id', 'trim|required');
		$this->form_validation->set_rules('trade_id', 'trade id', 'trim|required');
		$this->form_validation->set_rules('type_of_loss_id', 'type of loss id', 'trim|required');
		$this->form_validation->set_rules('detail_dol', 'detail dol', 'trim|required');
		$this->form_validation->set_rules('date_of_loss', 'date of loss', 'trim|required');
		$this->form_validation->set_rules('date_of_survey', 'date of survey', 'trim|required');
		$this->form_validation->set_rules('policy_number', 'policy number', 'trim|required');
		$this->form_validation->set_rules('situation_of_loss', 'situation of loss', 'trim|required');
		$this->form_validation->set_rules('insurer_ref_no', 'insurer ref no', 'trim|required');
		$this->form_validation->set_rules('insured', 'insured', 'trim|required');
		$this->form_validation->set_rules('broker_id', 'broker id', 'trim|required');
		$this->form_validation->set_rules('user_id', 'user id', 'trim|required');

		$this->form_validation->set_rules('file_id', 'file_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file File.php */
/* Location: ./application/controllers/File.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-26 15:49:10 */
/* http://harviacode.com */
