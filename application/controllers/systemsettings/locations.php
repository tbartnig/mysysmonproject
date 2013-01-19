<?php
class Locations extends CI_Controller {

	private $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('model_locations');
		if(!$this->session->userdata('username')) header('location: /auth');

		//velden initialiseren
		$this->data['values'] = array(
	 		'idlocation' => "",
	 		'groupid' => "",
	 		'location' => "",
	 		'streetaddress' =>"",
	 		'contacttel' => "",
	 		'description' => "",

 		);
	}

	/* locations laat alle locations
	 *
	 */
	public function index($msg = FALSE) {

		$data = ""; //array definieren


		//controleren of er berichten zijn meegegeven. zo ja worden deze hier voorbereid
		if($msg) {
			switch($msg){
				case "saved":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your location is saved";
				break;
				case "notsaved":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was a problem saving your location";
				break;
				case "updated":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your location has been updated";
				break;
				case "deleted":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "The selected location(s) has been deleted";
				break;
				case "notdeleted":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was an error deleting the selected locations. It is not possible to remove linking contacts";
				break;
			}
		}

		$data['arrLocations'] = $this->model_locations->getLocations();
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_managelocations',$data);
		$this->load->view('include/footer');
	}

	 /*addcontact is een method die je de mogelijkheid geeft om een contact aan te maken
	 *
	 */
	public function addlocation() {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden

		//open de vieuw
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_createlocation',$data); //view cu(create/update contact)
		$this->load->view('include/footer');

	}

	/* omschrijving:savelocation maakt een nieuw location aan.
	 * call: vanuit de view_createlocation
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function savelocation(){
		$this->form_validation->set_rules('location', 'Location', 'required');

		//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values of ze worden opgeslagen
		$data['values'] = array(
	 		'location' => $this->input->post('location'),
	 		'streetaddress' => $this->input->post('streetaddress'),
	 		'contacttel' => $this->input->post('contacttel'),
	 		'description' => $this->input->post('description')
 		);

		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_createlocation',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_locations->createLocation($data['values'])) { //location aanmaken.input zijn de POST velden
				header('location: /systemsettings/locations/index/saved'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/locations/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}
	}

 	/*editlocation is een method die je de mogelijkheid geeft om een location te bewerken
	 *de mehode laat alle data uit de database in de view_updatelocation
	 */
	public function editlocation($idlocation = FALSE) {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden

		//als contactid een waarde heeft laden we deze uit de database
		if($idlocation) {
			$data['values'] = $this->model_locations->getLocation($idlocation); //array values met de row van het bijbehorende ID

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatelocation',$data); //view update contact laden met de data
			$this->load->view('include/footer');

		}
	}


	/* omschrijving:updatelocation updated een bestaand location
	 * call: vanuit de view_createlocation
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function updatelocation(){
		$this->form_validation->set_rules('location', 'Location', 'required'); //naam is verplicht

		//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values
			$data['values'] = array(
				'idlocation' => $this->input->post('idlocation'),
		 		'location' => $this->input->post('location'),
		 		'streetaddress' => $this->input->post('streetaddress'),
		 		'contacttel' => $this->input->post('contacttel'),
		 		'description' => $this->input->post('description')
 			);

		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatelocation',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_locations->updateLocation($data['values'])) {
				header('location: /systemsettings/locations/index/updated'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/locations/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}

	}

	/*function verwijdert een aantal geselecteerde locations. Wordt aangeroepen vanuit de view_managelocations
	 * on success: redirect naar deleted page
	 * on faillure: redirect naar notdeleted page
	 */

	public function deleteselectedlocations() {
		if($this->model_locations->deleteSelectedlocations($this->input->post('selectedlocations'))) {
			header('location: /systemsettings/locations/index/deleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		} else {
			header('location: /systemsettings/locations/index/notdeleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		}

	}

}
