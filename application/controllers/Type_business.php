<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type_business extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
		$this->load->model('Setting_app_model');
        $this->load->model('Type_business_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $type_business = $this->Type_business_model->get_all();
        $data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'type_business_data' => $type_business,
        );
        $this->template->load('template','type_business/type_business_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Type_business_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				
		'type_business_id' => $row->type_business_id,
		'type_business_code' => $row->type_business_code,
		'type_business_name' => $row->type_business_name,
	    );
            $this->template->load('template','type_business/type_business_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type_business'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'action' => site_url('type_business/create_action'),
	    'type_business_id' => set_value('type_business_id'),
	    'type_business_code' => set_value('type_business_code'),
	    'type_business_name' => set_value('type_business_name'),
	);
        $this->template->load('template','type_business/type_business_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'type_business_code' => $this->input->post('type_business_code',TRUE),
		'type_business_name' => $this->input->post('type_business_name',TRUE),
	    );

            $this->Type_business_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('type_business'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Type_business_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
                'action' => site_url('type_business/update_action'),
		'type_business_id' => set_value('type_business_id', $row->type_business_id),
		'type_business_code' => set_value('type_business_code', $row->type_business_code),
		'type_business_name' => set_value('type_business_name', $row->type_business_name),
	    );
            $this->template->load('template','type_business/type_business_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type_business'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('type_business_id', TRUE)));
        } else {
            $data = array(
		'type_business_code' => $this->input->post('type_business_code',TRUE),
		'type_business_name' => $this->input->post('type_business_name',TRUE),
	    );

            $this->Type_business_model->update($this->input->post('type_business_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('type_business'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Type_business_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Type_business_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('type_business'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type_business'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('type_business_code', 'type business code', 'trim|required');
	$this->form_validation->set_rules('type_business_name', 'type business name', 'trim|required');

	$this->form_validation->set_rules('type_business_id', 'type_business_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Type_business.php */
/* Location: ./application/controllers/Type_business.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-26 14:52:51 */
/* http://harviacode.com */