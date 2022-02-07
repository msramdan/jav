<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Team extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Setting_app_model');
		$this->load->model('Team_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_allowed($this->uri->segment(1), null);
		$team = $this->Team_model->get_all();
		$data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'team_data' => $team,
		);
		$this->template->load('template', 'team/team_list', $data);
	}

	public function read($id)
	{
		is_allowed($this->uri->segment(1), 'read');
		$row = $this->Team_model->get_by_id(decrypt_url($id));
		if ($row) {
			$data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),

				'team_id' => $row->team_id,
				'name' => $row->name,
				'biografi' => $row->biografi,
				'position' => $row->position,
				'photo' => $row->photo,
			);
			$this->template->load('template', 'team/team_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('team'));
		}
	}

	public function create()
	{
		is_allowed($this->uri->segment(1), 'create');
		$data = array(
			'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
			'action' => site_url('team/create_action'),
			'team_id' => set_value('team_id'),
			'name' => set_value('name'),
			'biografi' => set_value('biografi'),
			'position' => set_value('position'),
			'photo' => set_value('photo'),
		);
		$this->template->load('template', 'team/team_form', $data);
	}

	public function create_action()
	{
		is_allowed($this->uri->segment(1), 'create');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {

			$config['upload_path']      = './assets/web/img/team';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload("photo");
			$data = $this->upload->data();
			$photo = $data['file_name'];


			$data = array(
				'name' => $this->input->post('name', TRUE),
				'biografi' => $this->input->post('biografi', TRUE),
				'position' => $this->input->post('position', TRUE),
				'photo' => $photo,
			);

			$this->Team_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('team'));
		}
	}

	public function update($id)
	{
		is_allowed($this->uri->segment(1), 'update');
		$row = $this->Team_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				'action' => site_url('team/update_action'),
				'team_id' => set_value('team_id', $row->team_id),
				'name' => set_value('name', $row->name),
				'biografi' => set_value('biografi', $row->biografi),
				'position' => set_value('position', $row->position),
				'photo' => set_value('photo', $row->photo),
			);
			$this->template->load('template', 'team/team_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('team'));
		}
	}

	public function update_action()
	{
		is_allowed($this->uri->segment(1), 'update');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('team_id', TRUE)));
		} else {

			$config['upload_path']      = './assets/web/img/team';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload("photo")) {
				$id = $this->input->post('team_id');
				$row = $this->Team_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {

					$target_file = './assets/web/img/team/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}


			$data = array(
				'name' => $this->input->post('name', TRUE),
				'biografi' => $this->input->post('biografi', TRUE),
				'position' => $this->input->post('position', TRUE),
				'photo' => $photo,
			);

			$this->Team_model->update($this->input->post('team_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('team'));
		}
	}

	public function delete($id)
	{
		is_allowed($this->uri->segment(1), 'delete');
		$row = $this->Team_model->get_by_id(decrypt_url($id));

		if ($row) {
			if ($row->photo == null || $row->photo == '') {
			} else {
				$target_file = './assets/web/img/team/' . $row->photo;
				unlink($target_file);
			}
			$this->Team_model->delete(decrypt_url($id));
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('team'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('team'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('biografi', 'biografi', 'trim|required');
		$this->form_validation->set_rules('position', 'position', 'trim|required');
		$this->form_validation->set_rules('photo', 'photo', 'trim');

		$this->form_validation->set_rules('team_id', 'team_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function download($gambar)
	{
		force_download('assets/web/img/team/' . $gambar, NULL);
	}
}

/* End of file Team.php */
/* Location: ./application/controllers/Team.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-06 16:55:20 */
/* http://harviacode.com */
