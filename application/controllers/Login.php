<?php 

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');

	}

	function index(){
		$this->load->view('login/v_login');
	}

	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// var_dump($username);
		// var_dump($password);
		// die();
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_login->cek_login("admin",$where)->num_rows();
		// var_dump($cek);
		// die();
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);
				
			redirect(base_url("admin"));
			var_dump($data_session);
			die();
		}else{
			//<a href="">test</a>
			echo "Username dan password salah";
			echo "<a href=".base_url()."login>Coba Login Kembali</a>";
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}