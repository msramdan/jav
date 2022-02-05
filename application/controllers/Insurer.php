<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insurer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
		$this->load->model('Setting_app_model');
        $this->load->model('Insurer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $insurer = $this->Insurer_model->get_all();
        $data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'insurer_data' => $insurer,
        );
        $this->template->load('template','insurer/insurer_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Insurer_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				
		'insurer_id' => $row->insurer_id,
		'insurer_code' => $row->insurer_code,
		'insurer_name' => $row->insurer_name,
		'address' => $row->address,
		'name_on_tax' => $row->name_on_tax,
		'address_on_tax' => $row->address_on_tax,
		'npwp' => $row->npwp,
	    );
            $this->template->load('template','insurer/insurer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('insurer'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'action' => site_url('insurer/create_action'),
	    'insurer_id' => set_value('insurer_id'),
	    'insurer_code' => set_value('insurer_code'),
	    'insurer_name' => set_value('insurer_name'),
	    'address' => set_value('address'),
	    'name_on_tax' => set_value('name_on_tax'),
	    'address_on_tax' => set_value('address_on_tax'),
	    'npwp' => set_value('npwp'),
	);
        $this->template->load('template','insurer/insurer_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'insurer_code' => $this->input->post('insurer_code',TRUE),
		'insurer_name' => $this->input->post('insurer_name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'name_on_tax' => $this->input->post('name_on_tax',TRUE),
		'address_on_tax' => $this->input->post('address_on_tax',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
	    );

            $this->Insurer_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('insurer'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Insurer_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
                'action' => site_url('insurer/update_action'),
		'insurer_id' => set_value('insurer_id', $row->insurer_id),
		'insurer_code' => set_value('insurer_code', $row->insurer_code),
		'insurer_name' => set_value('insurer_name', $row->insurer_name),
		'address' => set_value('address', $row->address),
		'name_on_tax' => set_value('name_on_tax', $row->name_on_tax),
		'address_on_tax' => set_value('address_on_tax', $row->address_on_tax),
		'npwp' => set_value('npwp', $row->npwp),
	    );
            $this->template->load('template','insurer/insurer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('insurer'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('insurer_id', TRUE)));
        } else {
            $data = array(
		'insurer_code' => $this->input->post('insurer_code',TRUE),
		'insurer_name' => $this->input->post('insurer_name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'name_on_tax' => $this->input->post('name_on_tax',TRUE),
		'address_on_tax' => $this->input->post('address_on_tax',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
	    );

            $this->Insurer_model->update($this->input->post('insurer_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('insurer'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Insurer_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Insurer_model->delete(decrypt_url($id));
			$error = $this->db->error();
			if ($error['code'] != 0) {
				$this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
			} else {
				$this->session->set_flashdata('message', 'Delete Record Success');
			}
            redirect(site_url('insurer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('insurer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('insurer_code', 'insurer code', 'trim|required');
	$this->form_validation->set_rules('insurer_name', 'insurer name', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('name_on_tax', 'name on tax', 'trim|required');
	$this->form_validation->set_rules('address_on_tax', 'address on tax', 'trim|required');
	$this->form_validation->set_rules('npwp', 'npwp', 'trim|required');

	$this->form_validation->set_rules('insurer_id', 'insurer_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Insurer.php */
/* Location: ./application/controllers/Insurer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-26 14:50:03 */
/* http://harviacode.com */
