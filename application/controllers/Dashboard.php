<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('Setting_app_model');
		$this->load->model('Official_receipt_model');
		$this->load->model('File_model');
        is_login();
    }

	public function index()
	{

		if (isset($_GET['start_date'])) {
			$start_date = $_GET['start_date'];
		} else {
			$start_date = '';
		}

		if (isset($_GET['end_date'])) {
			$end_date = $_GET['end_date'];
		} else {
			$end_date = '';
		}


		$data = array(
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
			'paid' =>$this->Official_receipt_model->paid($start_date,$end_date),
			'unpaid' =>$this->Official_receipt_model->unpaid($start_date,$end_date),
			'outstanding' =>$this->File_model->outstanding($start_date,$end_date),
			'receiving' =>$this->File_model->receiving($start_date,$end_date),
		);
		$this->template->load('template','dashboard',$data);
	}



}
