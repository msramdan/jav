<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Not_access extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('Setting_app_model');
    }

	public function index()
	{

		$this->load->view('403');
	}

}
