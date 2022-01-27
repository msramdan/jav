<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('Setting_app_model');
        is_login();
    }

	public function index()
	{
		$data = array(
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template','dashboard',$data);
	}



}
