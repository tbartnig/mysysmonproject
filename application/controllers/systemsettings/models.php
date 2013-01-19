<?php
class Models extends CI_Controller {

	private $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('model_models');
		if(!$this->session->userdata('username')) header('location: /auth');

		//velden initialiseren
		$this->data['values'] = array(
	 		'idmodeltype' => "",
	 		'modelclassid' => "",
	 		'cpuclassid' => "",
	 		'manufacturer' =>"",
	 		'modeltype' => "",
	 		'modelclassdescription' => "",
			'cpuclassdescription' => ""
 		);

	}


	/* models laat alle models
	 *
	 */
	public function index($msg = FALSE) {
		$data = "";

			//controleren of er berichten zijn meegegeven. zo ja worden deze hier voorbereid
		if($msg) {
			switch($msg){
				case "saved":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your model is saved";
				break;
				case "notsaved":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was a problem saving your model";
				break;
				case "updated":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "Your model has been updated";
				break;
				case "deleted":
					$data['boxtype'] = "alert alert-success";
					$data['msg'] = "The selected model(s) has been deleted";
				break;
				case "notdeleted":
					$data['boxtype'] = "alert alert-error";
					$data['msg'] = "There was an error deleting the selected models. It is not possible to remove linking contacts";
				break;
			}
		}

		$data['arrModels'] = $this->model_models->GetModels();
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_managemodels',$data);
		$this->load->view('include/footer');
	}

	 /*addmodel is een method die je de mogelijkheid geeft om een model aan te maken
	 *
	 */
	public function addmodel() {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden
		$data['modelclass'] = $this->model_models->GetModelclass();
		$data['cpuclass'] = $this->model_models->GetCpuclass();
		//als contactid een waarde heeft laden we deze uit de database

		//open de view
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('systemsettings/view_createmodel',$data); //view cu(create/update contact)
		$this->load->view('include/footer');

	}

	/* omschrijving:savelocation maakt een nieuw location aan.
	 * call: vanuit de view_createlocation
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function savemodel(){
		$this->form_validation->set_rules('modeltype', 'Modeltype', 'required');

		//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values of ze worden opgeslagen
		$data['values'] = array(
	 		'modeltype' => $this->input->post('modeltype'),
	 		'manufacturer' => $this->input->post('manufacturer'),
	 		'modelclassid' => $this->input->post('modelclassid'),
	 		'cpuclassid' => $this->input->post('cpuclassid')
 		);

		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{
			$data['modelclass'] = $this->model_models->GetModelclass();
			$data['cpuclass'] = $this->model_models->GetCpuclass();
			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_createmodel',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_models->createModel($data['values'])) { //location aanmaken.input zijn de POST velden
				header('location: /systemsettings/models/index/saved'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/models/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}
	}

	/*function verwijdert een aantal geselecteerde models. Wordt aangeroepen vanuit de view_managemodels
	 * on success: redirect naar deleted page
	 * on faillure: redirect naar notdeleted page
	 */

	public function deleteselectedmodels() {
		if($this->model_models->deleteSelectedmodels($this->input->post('selectedmodels'))) {
			header('location: /systemsettings/models/index/deleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		} else {
			header('location: /systemsettings/models/index/notdeleted'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
		}

	}

	/*editmodel is een method die je de mogelijkheid geeft om een location te bewerken
	 *de mehode laat alle data uit de database in de view_updatelocation
	 */
	public function editmodel($idmodel = FALSE) {
		$data = $this->data; //$this->data bevat alle variablen voor de input velden

		//als contactid een waarde heeft laden we deze uit de database
		if($idmodel) {
			$data['modelclass'] = $this->model_models->GetModelclass();
			$data['cpuclass'] = $this->model_models->GetCpuclass();
			$data['values'] = $this->model_models->GetModel($idmodel); //array values met de row van het bijbehorende ID

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatemodel',$data); //view update contact laden met de data
			$this->load->view('include/footer');

		}
	}

	/* omschrijving:updatemodel updated een bestaand model
	 * call: vanuit de view_updatemodel
	 * resultaat: laat validation errors zien, maakt een record aan of geeft een foutmelding
	 */
	public function updatemodel($idmodel = FALSE){
		$this->form_validation->set_rules('modeltype', 'Modeltype', 'required');

		//array data laden met daarbij de ingevulde velden. in de view wordt deze geladen als values of ze worden opgeslagen
		$data['values'] = array(
			'idmodeltype' => $this->input->post('idmodeltype'),
	 		'modeltype' => $this->input->post('modeltype'),
	 		'manufacturer' => $this->input->post('manufacturer'),
	 		'modelclassid' => $this->input->post('modelclassid'),
	 		'cpuclassid' => $this->input->post('cpuclassid')
 		);

		if ($this->form_validation->run() === FALSE) //validatie is niet accoord
		{

			$this->load->view('include/header');
			$this->load->view('include/sidebar');
			$this->load->view('systemsettings/view_updatemodel',$data); //laat de view
			$this->load->view('include/footer');

		} else {

			//validation is akkoord
			if($this->model_models->updateModel($data['values'])) {
				header('location: /systemsettings/models/index/updated'); //redirect naar contacts en melding laten zien dat het contact opgeslagen is
			} else {
				header('location: /systemsettings/models/index/notsaved'); //redirect naar contacts en een melding laten zien dat het contact NIET opgeslagen is
			}
		}

	}


}