<?php
class Dashboard extends CI_Controller {
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->library(array('session','form_validation'));
		if(!$this->session->userdata('username')) header('location: /auth');
	}
	
	
	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('view_dashboard');
		$this->load->view('include/footer');
		
	} //END FUNCTION INDEX
}

