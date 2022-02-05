<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secretary extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
		$this->load->model('Setting_app_model');
        $this->load->model('Secretary_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $secretary = $this->Secretary_model->get_all();
        $data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'secretary_data' => $secretary,
        );
        $this->template->load('template','secretary/secretary_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Secretary_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				
		'secretary_id' => $row->secretary_id,
		'secretary_code' => $row->secretary_code,
		'secretary_name' => $row->secretary_name,
		'secretary_address' => $row->secretary_address,
	    );
            $this->template->load('template','secretary/secretary_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('secretary'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'action' => site_url('secretary/create_action'),
	    'secretary_id' => set_value('secretary_id'),
	    'secretary_code' => set_value('secretary_code'),
	    'secretary_name' => set_value('secretary_name'),
	    'secretary_address' => set_value('secretary_address'),
	);
        $this->template->load('template','secretary/secretary_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'secretary_code' => $this->input->post('secretary_code',TRUE),
		'secretary_name' => $this->input->post('secretary_name',TRUE),
		'secretary_address' => $this->input->post('secretary_address',TRUE),
	    );

            $this->Secretary_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('secretary'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Secretary_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
                'action' => site_url('secretary/update_action'),
		'secretary_id' => set_value('secretary_id', $row->secretary_id),
		'secretary_code' => set_value('secretary_code', $row->secretary_code),
		'secretary_name' => set_value('secretary_name', $row->secretary_name),
		'secretary_address' => set_value('secretary_address', $row->secretary_address),
	    );
            $this->template->load('template','secretary/secretary_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('secretary'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('secretary_id', TRUE)));
        } else {
            $data = array(
		'secretary_code' => $this->input->post('secretary_code',TRUE),
		'secretary_name' => $this->input->post('secretary_name',TRUE),
		'secretary_address' => $this->input->post('secretary_address',TRUE),
	    );

            $this->Secretary_model->update($this->input->post('secretary_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('secretary'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Secretary_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Secretary_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('secretary'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('secretary'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('secretary_code', 'secretary code', 'trim|required');
	$this->form_validation->set_rules('secretary_name', 'secretary name', 'trim|required');
	$this->form_validation->set_rules('secretary_address', 'secretary address', 'trim|required');

	$this->form_validation->set_rules('secretary_id', 'secretary_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Secretary.php */
/* Location: ./application/controllers/Secretary.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-05 11:20:55 */
/* http://harviacode.com */