<?php
class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database(); //load database library
		session_start();


	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'xss_clean|required|callback_user_check');

	    $this->_username = $this->input->post('username');
    	$this->_password = md5($this->input->post('password'));


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('view_auth');
		} else {
			$this->session->set_userdata('userid',$this->getUserid($this->_username));
			$this->session->set_userdata('username', $this->_username);
			$this->session->set_userdata('logged_in','TRUE');
			header('location: /');
			//doorsturen naar admin page
		}

	} //END FUNCTION INDEX

	//function logoff zorgt voor het afmelden
	public function logoff()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('logged_in');
		header('location: /');
	}

 	/* functionname: getUserid
	 * doelstelling: geeft het userid terug als het wachtwoord + username matched
	 */
	function getUserid($myusername = FALSE){
		$this->db->select('userid');
		$this->db->from('users');
		$this->db->where('alias', $myusername);
		$query= $this->db->get();
		$result = $query->row_array();
		return $result['userid'];
	}

	/* Deze functie check het password als je je aanmeld
	 * indien je gegevens kloppen wordt het userid in de session opgeslagen
	 * en wordt er gecontroleerd of je admin bent
	 */

	function user_check()
	{
	//database lookup: matchen de gegevens?
	    $query = $this->db->query("SELECT * FROM users WHERE alias='$this->_username' and passwd='$this->_password'");
    	if($query->num_rows() == 1 ) {
			return TRUE; //terug sturen dat we goed ingelogd zijn.
		} else {
			$this->form_validation->set_message('user_check','Username or password unkown'); //gebruiker heeft geen match.
			return FALSE;
		}

	}


} //END CLASS
