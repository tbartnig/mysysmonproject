<?php
class Model_models extends CI_Model {

	/* Omschrijving: GetModels laat een overzicht zien van alle soorten hardware
	 *
	 */
	public function GetModels() {
		//sql query waarbij er gebruikt wordt gemaakt van multi tenancy
		//$sqlmodeltype=("SELECT * FROM sysmonmodeltype LEFT JOIN sysmoncpuclass on sysmonmodeltype.cpuclassid = sysmoncpuclass.idsysmoncpuclass LEFT JOIN sysmonmodelclass on sysmonmodeltype.modelclassid = sysmonmodelclass.idsysmonmodelclass where groupid='$_SESSION[usrgroupid]'");
		//sql query waarbij er gebruikt wordt gemaakt system wide models
		$sql = 'SELECT idmodeltype,modelclassid,cpuclassid,modeltype,manufacturer,modelclassdescription,cpuclassdescription FROM sysmonmodeltype LEFT JOIN sysmoncpuclass on sysmonmodeltype.cpuclassid = sysmoncpuclass.idsysmoncpuclass LEFT JOIN sysmonmodelclass on sysmonmodeltype.modelclassid = sysmonmodelclass.idsysmonmodelclass';
		$q = $this->db->query($sql);
		return $q->result_array();

	}

	/*function geeft een overzicht van alle cpuclass categorieeen
	 *
	 */
	public function GetCpuclass() {
		$sql=("SELECT idsysmoncpuclass,cpuclassdescription FROM sysmoncpuclass");
		$q = $this->db->query($sql);
		return $q->result_array();
	}

		/*function geeft een overzicht van alle cpuclass categorieeen
	 *
	 */
	public function GetModelclass() {
		$sql=("SELECT idsysmonmodelclass,modelclassdescription FROM sysmonmodelclass");
		$q = $this->db->query($sql);
		return $q->result_array();
	}

		/*function slaat een nieuw model op
	 *
	 */
	 public function createModel($data = FALSE) {
	 	$tbl_models = "sysmonmodeltype";
		if($data) {
		 	return $this->db->insert($tbl_models, $data);
		} else {
			return false;
		}
     }

	   /* Function verwijdert een aantal geselecteerde models. Wordt aangeroepen vanuit de controller models
	  *
	  */
	public function deleteSelectedmodels($arrModels) {
		$tbl_models = "sysmonmodeltype"; //tabel waar de locations instaan
		foreach ($arrModels as $id) {
			$sql = ("DELETE FROM $tbl_models WHERE idmodeltype = $id");
			$result = mysql_query($sql);
			if(mysql_errno() == 1451) return FALSE; //bij een constraint. stoppen en melding geven.
		}
		return TRUE;
	}

	/*methode update een model($idmodel)
	 *$data is een array en bevat alle velden die geupdated moeten worden. methode wordt aangroepen vanuit method updatemodels (controller models)
	 */
	 public function updateModel($data) {

	 	$tbl_models = "sysmonmodeltype";
		$this->db->where('idmodeltype', $data['idmodeltype']);
	 	return $this->db->update($tbl_models, $data);
     }

 	/*Function laat alle info van een record($idmodel) uit de database
	 * resultaat: array met record gegevens
	 */

	public function getModel($idmodel) {
		$tbl_models = "sysmonmodeltype"; //tabel waar de models instaan
		$this->db->from($tbl_models);
		$this->db->where('idmodeltype', $idmodel); //where clause is contact is
		$query = $this->db->get(); //laat alle info uit de tabel contacts
		return $query->row_array(); //resultaat is een array met 1 row van het gekozen record
	}

}

