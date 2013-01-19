<?php
/* controller contacts zorgt voor het afhandelen van alle zaken met betrekking tot contacts
 *
 */

class Contacts extends CI_Controller {

	private $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('model_contacts');
		if(!$this->session->userdata('username')) header('location: /auth');

		$this->data['values'] = array(
	 		'name' => "",
	 		'emailaddress' => "",
	 		'contacttel' => "",
	 		'streetaddress' =>"",
	 		'country' => "",
	 		'description'=> "",
	 		'company' => "",
	 		'catagoryid' => "",
	 		'contactcategoryid' => "",
 		);
	}



	/* contacts method laat een overzicht met alle contacten
	 */
	public function index($msg = FALSE) {

		//controleren of er berichten zijn meegegeven. zo ja worden deze hier voorbereid
		if($msg) {
			switch($msg){
				case "saved":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your contact is saved";
				break;
				case "notsaved":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was a problem saving your contact";
				break;
				case "updated":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your contact has been updated";
				break;
				case "deleted":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "The selected contact(s) has been deleted";
				break;
				case "notdeleted":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was an error deleting the selected contacts. It is not possible to remove linking contacts";
				break;
			}
		}

		$data['arrContacts'] = $this->model_contacts->getContacts();
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_managecontacts',$data);
		$this->load->view('include/footer');
	}



	 /*addcontact is een method die je de mogelijkheid geeft om een contact aan te maken
	 *
	 */
	public function addcontact() {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden
		$data['contactcategory'] = $this->model_contacts->GetContactcategory();
		//als contactid een waarde heeft laden we deze uit de database

		//open de vieuw
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_createcontact',$data); //view cu(create/update contact)
		$this->load->view('include/footer');

	}

	 /*contact is een method die je de mogelijkheid geeft om een contact te bewerken
	 *
	 */
	public function editcontact($contactid = FALSE) {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden
		$data['contactcategory'] = $this->model_contacts->GetContactcategory();
		//als contactid een waarde heeft laden we deze uit de database
		if($contactid) {
			$data['values'] = $this->model_contacts->getcontact($contactid); //array values met de row van het bijbehorende ID

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatecontact',$data); //view update contact laden met de data
			$this->load->view('include/footer');

		}
	}

	/* omschrijving:savecontact maakt een nieuw contact aan.
	 * call: vanuit de view_createcontact
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function savecontact(){
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('emailaddress', 'Email address', 'valid_email');


		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{
			//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values
			$data['values'] = array(
		 		'name' => $this->input->post('name'),
		 		'emailaddress' => $this->input->post('emailaddress'),
		 		'contacttel' => $this->input->post('contacttel'),
		 		'streetaddress' => $this->input->post('streetaddress'),
		 		'country' => $this->input->post('country'),
		 		'description' => $this->input->post('description'),
		 		'company' => $this->input->post('company'),
		 		'catagoryid' => $this->input->post('catagoryid')
	 		);
			$data['contactcategory'] = $this->model_contacts->GetContactcategory(); //contacts opnieuw laden
			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_createcontact',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_contacts->createContact()) {
				header('location: /systemsettings/contacts/index/saved'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/contacts/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}
	}

	/* omschrijving:updatecontact updated een bestaand contact
	 * call: vanuit de view_createcontact
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function updatecontact(){
		$this->form_validation->set_rules('name', 'Name', 'required'); //naam is verplicht
		$this->form_validation->set_rules('emailaddress', 'Email address', 'valid_email'); //emailadres is verplicht

		//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values
		$data['values'] = array(
	 		'name' => $this->input->post('name'),
	 		'emailaddress' => $this->input->post('emailaddress'),
	 		'contacttel' => $this->input->post('contacttel'),
	 		'streetaddress' => $this->input->post('streetaddress'),
	 		'country' => $this->input->post('country'),
	 		'description' => $this->input->post('description'),
	 		'company' => $this->input->post('company'),
	 		'catagoryid' => $this->input->post('catagoryid'),
			'idcontact' => $this->input->post('idcontact')
 		);

		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{

			$data['contactcategory'] = $this->model_contacts->GetContactcategory(); //contacts categorie opnieuw laden
			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatecontact',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_contacts->updateContact($data['values'])) {
				header('location: /systemsettings/contacts/index/updated'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/contacts/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}

	}
	/*function verwijdert een aantal geselecteerde contacts. Wordt aangeroepen vanuit de view_managecontacts
	 * on success: redirect naar deleted page
	 * on faillure: redirect naar notdeleted page
	 */

	public function deleteselectedcontacts() {
		if($this->model_contacts->deleteSelectedcontacts($this->input->post('selectedcontacts'))) {
			header('location: /systemsettings/contacts/index/deleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		} else {
			header('location: /systemsettings/contacts/index/notdeleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		}

	}

}
