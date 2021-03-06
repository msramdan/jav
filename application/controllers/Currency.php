<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Currency extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
		$this->load->model('Setting_app_model');
        $this->load->model('Currency_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $currency = $this->Currency_model->get_all();
        $data = array(
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'currency_data' => $currency,
        );
        $this->template->load('template','currency/currency_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Currency_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
				
		'currency_id' => $row->currency_id,
		'currency_code' => $row->currency_code,
		'currency_name' => $row->currency_name,
		'says' => $row->says,
		'rate' => $row->rate,
	    );
            $this->template->load('template','currency/currency_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('currency'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
			'sett_apps' => $this->Setting_app_model->get_by_id(1),
            'action' => site_url('currency/create_action'),
	    'currency_id' => set_value('currency_id'),
	    'currency_code' => set_value('currency_code'),
	    'currency_name' => set_value('currency_name'),
	    'says' => set_value('says'),
	    'rate' => set_value('rate'),
	);
        $this->template->load('template','currency/currency_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'currency_code' => $this->input->post('currency_code',TRUE),
		'currency_name' => $this->input->post('currency_name',TRUE),
		'says' => $this->input->post('says',TRUE),
		'rate' => $this->input->post('rate',TRUE),
	    );

            $this->Currency_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('currency'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Currency_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
				'sett_apps' => $this->Setting_app_model->get_by_id(1),
                'action' => site_url('currency/update_action'),
		'currency_id' => set_value('currency_id', $row->currency_id),
		'currency_code' => set_value('currency_code', $row->currency_code),
		'currency_name' => set_value('currency_name', $row->currency_name),
		'says' => set_value('says', $row->says),
		'rate' => set_value('rate', $row->rate),
	    );
            $this->template->load('template','currency/currency_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('currency'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->update(encrypt_url($this->input->post('currency_id', TRUE)));
        } else {
            $data = array(
		'currency_code' => $this->input->post('currency_code',TRUE),
		'currency_name' => $this->input->post('currency_name',TRUE),
		'says' => $this->input->post('says',TRUE),
		'rate' => $this->input->post('rate',TRUE),
	    );

            $this->Currency_model->update($this->input->post('currency_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('currency'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Currency_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Currency_model->delete(decrypt_url($id));
            $error = $this->db->error();
			if ($error['code'] != 0) {
				$this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
			} else {
				$this->session->set_flashdata('message', 'Delete Record Success');
			}
            redirect(site_url('currency'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('currency'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('currency_code', 'currency code', 'trim|required');
	$this->form_validation->set_rules('currency_name', 'currency name', 'trim|required');
	$this->form_validation->set_rules('says', 'says', 'trim|required');
	$this->form_validation->set_rules('rate', 'rate', 'trim|required');

	$this->form_validation->set_rules('currency_id', 'currency_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Currency.php */
/* Location: ./application/controllers/Currency.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-02 13:36:22 */
/* http://harviacode.com */
