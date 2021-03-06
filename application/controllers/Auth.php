<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller {

  public function __construct()
    {
      parent::__construct();
      $this->load->model('user_m');
			$this->load->model('Setting_app_model');
    }

  public function index()
  {
    check_already_login();
		$data = array(
			'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		);
		
    $this->load->view('login',$data);
  }


  public function profile()
  {
    $this->template->load('template','profile');
  }

  public function process()
  {
          $post =$this->input->post(null, TRUE);
          if (isset($post['login'])){
            $this->load->model('user_m');
            $query =$this->user_m->login($post);
            if($query->num_rows() >0){
              $row =$query->row();
              $params = array(
                'userid'=>$row->user_id,
                'level_id' =>$row->level_id
              );
              $this->session->set_userdata($params);
              $this->user_m->addHistory($this->fungsi->user_login()->user_id, $this->fungsi->user_login()->nama_user.' Telah melakukan login', $_SERVER['HTTP_USER_AGENT']);
            echo "<script>window.location='".site_url('dashboard')."'</script>";
            } else{
               $this->session->set_flashdata('gagal', 'Login gagal, username atau password salah');
               redirect(site_url('auth'));
            }
          }
        }

  public function logout()
  {
    $params = array('userid','level_id');
    $this->session->unset_userdata($params);
    redirect('auth');

  }

  public function edit_profil($id){
        $data = array(
            'name'            =>$this->input->post('name',true),
            'address'         =>$this->input->post('address',true),
            'email'         =>$this->input->post('email',true),
        );
        $this->user_m->ubah_data($data,$id);
         echo "<script> alert('Data Berhasil diupdate')</script>";
         echo"<script>window.location='".site_url('auth/profile')."'</script>";
         
    }

    public function edit_password($id){
        if (sha1($this->input->post('lama'))==$this->fungsi->user_login()->password) {
            $data = array(
                'password'          => sha1($this->input->post('password',true)),
            );
            $this->user_m->ubah_data($data,$id);
            echo "<script> alert('Data Password Berhasil diupdate')</script>";
            echo"<script>window.location='".site_url('auth/logout')."'</script>";
        }else{
            echo "<script> alert('Password Lama Salah')</script>";
            echo"<script>window.location='".site_url('auth/profile')."'</script>";
        } 
    }


}
