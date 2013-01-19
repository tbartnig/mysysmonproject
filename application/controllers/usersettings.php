<?php
class Usersettings extends CI_Controller {

	/*omschrijving: Construct
	 *
	 */
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('model_usersettings');
		$this->load->database(); //load database library
		session_start();
		if(!$this->session->userdata('username')) header('location: /auth');
	}

	/* Omschijving: Deze functie wordt geladen bij het aanroepen van de controller usersettings
	 * Resultaat: geeft alleen het emailadres scherm weer.
	 */
	public function index()
	{
		$data['emailaddress'] = $this->model_usersettings->getEmailaddress($this->session->userdata('userid')); //fetch emailadres
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('usersettings/view_changeemail',$data);
		$this->load->view('include/footer');
	}
	

	/* Omschijving: Deze functie wordt geladen als er op de knop change emailadres gelikt wordt
	 * Resultaat: geeft alleen het formulier om een mailadres te wijzigen weer en eventuele berichten worden doorgegeven(GET)
	 */
	public function changeemail($msg = FALSE)
	{
		//controleren of er berichten zijn meegegeven. zo ja worden deze hier voorbereid
		if($msg) {
			switch($msg){
				case "ok":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your new Emailaddress has saved";
				break;
				case "error":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was a problem saving your emailaddress";
				break;
			}
		}
		
		$data['emailaddress'] = $this->model_usersettings->getEmailaddress($this->session->userdata('userid')); //fetch emailadres
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('usersettings/view_changeemail',$data);
		$this->load->view('include/footer');
	}
	
	/* bij het opslaan van het emailadres wordt vanuit de view_changeemail methode saveemail aangeroepen.
	 * aan de hand van het resultaat roept deze weer de method changeemail aan met daarbij een argument
	 */
	public function saveemail() {
		$emailaddress = $this->input->post('emailaddress');
		if($this->model_usersettings->updateEmailaddress($emailaddress,$this->session->userdata('userid'))) {
			header('location: /usersettings/changeemail/ok');
		} else {
			header('location: /usersettings/changeemail/error');
		}		
	}
	/*omschrijving: Deze method wordt aangeroepen met POST data vanuit vieuw_changepassword. Ververolgens wordt er een aantal checks uitgevoerd
	 *als alles ok is wordt er een redirect gedaan naar changepassword, die vervolgens vieuw_changenotifications weer aanroept met een $msg.
	 *input: waarden worden uit de POST variable gehaald 
	 *resultaat: bij errors $validation_errors en anders een redirect
	 */
	public function savepassword() {
		$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('currpassword', 'Current password', 'md5|required|callback_password_check');
		
		$this->_currpassword = $this->input->post('currpassword');
    	$this->_password = md5($this->input->post('password'));
		$this->_passconf = md5($this->input->post('passconf'));
		$this->_userid = $this->session->userdata('userid');
		$this->_username = $this->session->userdata('username');
		
		if ($this->form_validation->run() == FALSE) //als we fouten hebben gevonden. Laden we de view inc. de validation errors
		{
			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('usersettings/view_changepassword');
			$this->load->view('include/footer');
		}
		else
		{
			if($this->model_usersettings->updatepassword($this->_password,$this->_userid)) { //wachtwoord updaten
				header('location: /usersettings/changepassword/ok'); //redirect als het gelukt is.(functie geeft TRUE of FALSE terug)
			} else {
				header('location: /usersettings/changepassword/error'); //redirect als er problemen zijn.
			}
		}
		
	}

	/*Omschrijving: Deze method wordt geladen als er op de knop change password wordt geklikt.
	 *Input: eventuele berichten(ok/error)
	 *Resultaat: pagina wordt geladen met een invoer veld.
	 */
	public function changepassword($msg = FALSE)
	{
		$data = FALSE;
		//controleren of er berichten zijn meegegeven. zo ja worden deze hier voorbereid
		if($msg) {
			switch($msg){
				case "ok":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your password has saved";
				break;
				case "error":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was a problem saving your password";
				break;
			}
		}
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('usersettings/view_changepassword',$data);
		$this->load->view('include/footer');
		
	}
	
	/*Omschrijving: Deze method wordt geladen als er op de knop change notifications wordt geklikt.
	 *Input: eventuele berichten(ok/error)
	 *Resultaat: pagina wordt geladen met een invoer veld.
	 */
	public function changenotifications($msg = FALSE)
	{
		$data = FALSE;
		$data = $this->model_usersettings->getNotifications($this->session->userdata('userid')); //get notification settings
		
		//controleren of er berichten zijn meegegeven. zo ja worden deze hier voorbereid
		if($msg) {
			switch($msg){
				case "ok":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your new notification settings are saved";
				break;
				case "error":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was a problem saving your notification settings";
				break;
			}
		}
		
		
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('usersettings/view_changenotifications',$data);
		$this->load->view('include/footer');
		
	}
	
	/*omschrijving: indien er in de view_changenotifications op save wordt gedrukt, wordt deze method aangeroepen
	 *input: POST waarden
	 *resultaat: wordt gecontroleerd of de velden goed zijn ingevuld. zoja, wordt dit in de databae opgeslagen en redirect de method
	 */
	public function savenotifications()
	{
		$userid = $this->session->userdata('userid');
		$this->form_validation->set_rules('fromtime', 'From time', 'trim|min_length[3]|max_length[5]|callback_validate_time');
		$this->form_validation->set_rules('tilltime', 'Till time', 'trim|min_length[3]|max_length[5]|callback_validate_time');
		
		if ($this->form_validation->run() == FALSE) //als we fouten hebben gevonden. Laden we de view inc. de validation errors
		{
			$data = $this->model_usersettings->getNotifications($userid); //get notification settings uit de database zodat de velden worden ingevuld
			
			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('usersettings/view_changenotifications',$data);
			$this->load->view('include/footer');
			
		} else {

			$fromtime = $this->input->post('fromtime');
			$tilltime = $this->input->post('tilltime');
			
			
			if(isset($_POST['businessdays'])) {
				$businessdays = TRUE;
			} else {
				$businessdays = FALSE;
			}
			
			if(isset($_POST['weekend'])) {
				$weekend = TRUE;
			} else {
				$weekend = FALSE;
			}
			
			if($weekend && $businessdays) {
				$date = "1-7";

			} elseif ($weekend) {
				$date = "6-7";
			} elseif ($businessdays) {
				$date = "1-5";
			} else {
				$date = "1-1";
			}
			
	    	$newperiod = $date . ',' . $fromtime . "-" . $tilltime . ";";
			
		 	$sql="UPDATE media INNER JOIN users ON users.userid = media.userid SET period = '$newperiod ' where users.userid = '$userid'";
		 	if (mysql_query($sql)) {
		 		header('location: /usersettings/changenotifications/ok'); //redirect als het gelukt is.(functie geeft TRUE of FALSE terug)
			 } else {
		 		header('location: /usersettings/changenotifications/error'); //redirect als het gelukt is.(functie geeft TRUE of FALSE terug)
		 	}
		}
		
	}

	/* Omschrijving: Functie controleerd of het mee gegeven wachtwoord klopt met wat er in de database staat.
	 * eze functie wordt gebruikt voor het veranderen van het wachtwoord. Eerst wordt het oude wachtwoord gecontroleerd.
	 * Resultaat: TRUE of FALSE
	 */
	public function password_check($password) 
	{
		$this->db->select('passwd');
		$this->db->from('users');
		$this->db->where('alias', $this->_username);
		$query= $this->db->get();
		$result = $query->row_array();
		$orgpassword =  $result['passwd'];
		if($orgpassword != $password) { //indien het wachtwoord niet matched met de database
			$this->form_validation->set_message('password_check', 'The current password is incorrect');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	/* Omschrijving: controleert of de ingegeven waarde een tijd is
	 * resultaat: TRUE of FALSE
	 */
	public function validate_time($str)
	{
		if(strtotime($str)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('validate_time', '%s is not correct (HH:MM)');
			return FALSE;
		}
	}
		
	
}
		