<?php
class Software extends CI_Controller {
	private $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('model_software');
		if(!$this->session->userdata('username')) header('location: /auth');

		//velden initialiseren
		$this->data['values'] = array(
	 		'idsysmonsoftware' => "",
	 		'vendor' => "",
	 		'version' => "",
	 		'application' =>"",
	 		'amount' => "",
	 		'licensekey' => "",
	 		'licinuse' => "",

 		);
	}

	/* Software method laat alle software
	 *
	 */
	public function index($msg = FALSE) {

		$data = ""; //array definieren


		//controleren of er berichten zijn meegegeven. zo ja worden deze hier voorbereid
		if($msg) {
			switch($msg){
				case "saved":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your application is saved";
				break;
				case "notsaved":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was a problem saving your application";
				break;
				case "updated":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your application has been updated";
				break;
				case "deleted":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "The selected application(s) has been deleted";
				break;
				case "notdeleted":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was an error deleting the selected application. It is not possible to remove linking applications";
				break;
			}
		}
		$data['arrSoftware'] = $this->model_software->getSoftwares();
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_managesoftware',$data);
		$this->load->view('include/footer');
	}


 	/*addsoftware is een method die je de mogelijkheid geeft om een applicatie aan te maken
	 *
	 */
	public function addsoftware() {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden

		//open de vieuw
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_createsoftware',$data); //view cu(create/update contact)
		$this->load->view('include/footer');

	}

	/* omschrijving:savesoftware maakt een nieuwe applicatie aan.
	 * call: vanuit de view_createsoftware
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function savesoftware(){
		$this->form_validation->set_rules('application', 'Application', 'required');

		//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values of ze worden opgeslagen
		$data['values'] = array(
	 		'vendor' => $this->input->post('vendor'),
	 		'version' => $this->input->post('version'),
	 		'application' => $this->input->post('application'),
	 		'licensekey' => $this->input->post('licensekey'),
	 		'amount' => $this->input->post('totallicenses')
 		);

		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_createsoftware',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_software->createSoftware($data['values'])) { //location aanmaken.input zijn de POST velden
				header('location: /systemsettings/software/index/saved'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/software/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}
	}


	/*editsoftware is een method die je de mogelijkheid geeft om software te bewerken
	 *de mehode laat alle data uit de database in de view_updatelocation
	 */
	public function editsoftware($idsysmonsoftware = FALSE) {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden

		//als contactid een waarde heeft laden we deze uit de database
		if($idsysmonsoftware) {
			$data['values'] = $this->model_software->getSoftware($idsysmonsoftware); //array values met de row van het bijbehorende ID

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatesoftware',$data); //view update contact laden met de data
			$this->load->view('include/footer');

		}
	}



	/* omschrijving:updatesoftware updated een bestaand application
	 * call: vanuit de view_updatesoftware
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function updatesoftware(){
		$this->form_validation->set_rules('application', 'Application', 'required'); //naam is verplicht

		//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values of ze worden opgeslagen
		$data['values'] = array(
			'idsysmonsoftware' => $this->input->post('idsysmonsoftware'),
	 		'vendor' => $this->input->post('vendor'),
	 		'version' => $this->input->post('version'),
	 		'application' => $this->input->post('application'),
	 		'licensekey' => $this->input->post('licensekey'),
	 		'amount' => $this->input->post('totallicenses')
 		);
		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatesoftware',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_software->updateSoftware($data['values'])) {
				header('location: /systemsettings/software/index/updated'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/software/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}

	}

	/*function verwijdert een aantal geselecteerde software. Wordt aangeroepen vanuit de view_managesoftware
	 * on success: redirect naar deleted page
	 * on faillure: redirect naar notdeleted page
	 */

	public function deleteselectedsoftware() {
		if($this->model_software->deleteSelectedsoftware($this->input->post('selectedsoftware'))) {
			header('location: /systemsettings/software/index/deleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		} else {
			header('location: /systemsettings/software/index/notdeleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		}

	}
}