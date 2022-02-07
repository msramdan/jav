<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
		$this->load->model('Setting_app_model');
        $this->load->model('Contact_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $contact = $this->Contact_model->get_all();
        $data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'contact_data' => $contact,
        );
        $this->template->load('template','contact/contact_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Contact_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				
		'contact_id' => $row->contact_id,
		'office_name' => $row->office_name,
		'address' => $row->address,
		'phone' => $row->phone,
		'fax' => $row->fax,
		'general_enquiry' => $row->general_enquiry,
		'contact_persons' => $row->contact_persons,
		'contact_persons2' => $row->contact_persons2,
	    );
            $this->template->load('template','contact/contact_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contact'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'action' => site_url('contact/create_action'),
	    'contact_id' => set_value('contact_id'),
	    'office_name' => set_value('office_name'),
	    'address' => set_value('address'),
	    'phone' => set_value('phone'),
	    'fax' => set_value('fax'),
	    'general_enquiry' => set_value('general_enquiry'),
	    'contact_persons' => set_value('contact_persons'),
	    'contact_persons2' => set_value('contact_persons2'),
	);
        $this->template->load('template','contact/contact_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'office_name' => $this->input->post('office_name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'fax' => $this->input->post('fax',TRUE),
		'general_enquiry' => $this->input->post('general_enquiry',TRUE),
		'contact_persons' => $this->input->post('contact_persons',TRUE),
		'contact_persons2' => $this->input->post('contact_persons2',TRUE),
	    );

            $this->Contact_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('contact'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Contact_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
                'action' => site_url('contact/update_action'),
		'contact_id' => set_value('contact_id', $row->contact_id),
		'office_name' => set_value('office_name', $row->office_name),
		'address' => set_value('address', $row->address),
		'phone' => set_value('phone', $row->phone),
		'fax' => set_value('fax', $row->fax),
		'general_enquiry' => set_value('general_enquiry', $row->general_enquiry),
		'contact_persons' => set_value('contact_persons', $row->contact_persons),
		'contact_persons2' => set_value('contact_persons2', $row->contact_persons2),
	    );
            $this->template->load('template','contact/contact_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contact'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('contact_id', TRUE)));
        } else {
            $data = array(
		'office_name' => $this->input->post('office_name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'fax' => $this->input->post('fax',TRUE),
		'general_enquiry' => $this->input->post('general_enquiry',TRUE),
		'contact_persons' => $this->input->post('contact_persons',TRUE),
		'contact_persons2' => $this->input->post('contact_persons2',TRUE),
	    );

            $this->Contact_model->update($this->input->post('contact_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('contact'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Contact_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Contact_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('contact'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contact'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('office_name', 'office name', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('fax', 'fax', 'trim|required');
	$this->form_validation->set_rules('general_enquiry', 'general enquiry', 'trim|required');
	$this->form_validation->set_rules('contact_persons', 'contact persons', 'trim|required');
	$this->form_validation->set_rules('contact_persons2', 'contact persons2', 'trim|required');

	$this->form_validation->set_rules('contact_id', 'contact_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Contact.php */
/* Location: ./application/controllers/Contact.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-05 15:51:34 */
/* http://harviacode.com */