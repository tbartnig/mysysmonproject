<?php
class Model_locations extends CI_Model {

	/*Omschrijving: GetLocation laat een overzicht van alle locaties  zien. Deze locatie wordt vervolgens weer aan een Asset toegekend.
	 */


	public function getLocations() {
		//sql query waarbij er gebruikt wordt gemaakt van multi tenancy
		//SELECT * FROM sysmonlocation where groupid='$_SESSION[usrgroupid]'"
		//sql query waarbij er gebruikt wordt gemaakt system wide locations
		$sql = 'SELECT idlocation,location, streetaddress, contacttel, description FROM sysmonlocation';
		$q = $this->db->query($sql);
		return $q->result_array();

	}

	/*function slaat een nieuw locatie op
	 *
	 */
	 public function createLocation($data = FALSE) {
	 	$tbl_location = "sysmonlocation";
		if($data) {
		 	return $this->db->insert($tbl_location, $data);
		} else {
			return false;
		}
     }

	 /*Function laat alle info van een record($idlocation) uit de database
	 * resultaat: array met record gegevens
	 */

	public function getLocation($idlocation) {
		$tbl_location = "sysmonlocation"; //tabel waar de locations instaan
		$this->db->from($tbl_location);
		$this->db->where('idlocation', $idlocation); //where clause is contact is
		$query = $this->db->get(); //laat alle info uit de tabel contacts
		return $query->row_array(); //resultaat is een array met 1 row van het gekozen record
	}

	/*methode update een location($idlocation)
	 *$data is een array en bevat alle velden die geupdated moeten worden. methode wordt aangroepen vanuit method updatelocation (controller locations)
	 */
	 public function updateLocation($data) {

	 	$tbl_location = "sysmonlocation";
		$this->db->where('idlocation', $data['idlocation']);
	 	return $this->db->update($tbl_location, $data);
     }

	  /* Function verwijdert een aantal geselecteerde locations. Wordt aangeroepen vanuit de controller locations
	  *
	  */
	public function deleteSelectedlocations($arrLocations) {
		$tbl_location = "sysmonlocation"; //tabel waar de locations instaan
		foreach ($arrLocations as $id) {
			$sql = ("DELETE FROM $tbl_location WHERE idlocation = $id");
			$result = mysql_query($sql);
			if(mysql_errno() == 1451) return FALSE; //bij een constraint. stoppen en melding geven.
		}
		return TRUE;
	}

}