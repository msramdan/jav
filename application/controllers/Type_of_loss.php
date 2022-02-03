<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type_of_loss extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
		$this->load->model('Setting_app_model');
        $this->load->model('Type_of_loss_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $type_of_loss = $this->Type_of_loss_model->get_all();
        $data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'type_of_loss_data' => $type_of_loss,
        );
        $this->template->load('template','type_of_loss/type_of_loss_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Type_of_loss_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				
		'type_of_loss_id' => $row->type_of_loss_id,
		'tol_code' => $row->tol_code,
		'tol_name' => $row->tol_name,
	    );
            $this->template->load('template','type_of_loss/type_of_loss_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type_of_loss'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'action' => site_url('type_of_loss/create_action'),
	    'type_of_loss_id' => set_value('type_of_loss_id'),
	    'tol_code' => set_value('tol_code'),
	    'tol_name' => set_value('tol_name'),
	);
        $this->template->load('template','type_of_loss/type_of_loss_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tol_code' => $this->input->post('tol_code',TRUE),
		'tol_name' => $this->input->post('tol_name',TRUE),
	    );

            $this->Type_of_loss_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('type_of_loss'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Type_of_loss_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
                'action' => site_url('type_of_loss/update_action'),
		'type_of_loss_id' => set_value('type_of_loss_id', $row->type_of_loss_id),
		'tol_code' => set_value('tol_code', $row->tol_code),
		'tol_name' => set_value('tol_name', $row->tol_name),
	    );
            $this->template->load('template','type_of_loss/type_of_loss_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type_of_loss'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('type_of_loss_id', TRUE)));
        } else {
            $data = array(
		'tol_code' => $this->input->post('tol_code',TRUE),
		'tol_name' => $this->input->post('tol_name',TRUE),
	    );

            $this->Type_of_loss_model->update($this->input->post('type_of_loss_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('type_of_loss'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Type_of_loss_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Type_of_loss_model->delete(decrypt_url($id));
            $error = $this->db->error();
			if ($error['code'] != 0) {
				$this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
			} else {
				$this->session->set_flashdata('message', 'Delete Record Success');
			}
            redirect(site_url('type_of_loss'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type_of_loss'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tol_code', 'tol code', 'trim|required');
	$this->form_validation->set_rules('tol_name', 'tol name', 'trim|required');

	$this->form_validation->set_rules('type_of_loss_id', 'type_of_loss_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Type_of_loss.php */
/* Location: ./application/controllers/Type_of_loss.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-26 14:52:54 */
/* http://harviacode.com */
