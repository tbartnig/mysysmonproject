<?php
class Model_contacts extends CI_Model {

	/*omschrijving: getContacts laat een overzicht van alle contacten in de tabel sysmoncontacts
	 * indien je alleen een bepaalde groep wilt kan je de andere sql query aanzetten
	 * resultaat: array
	 */
	public function getContacts() {
		//sql query waarbij er gebruikt wordt gemaakt van multi tenancy
		//$sqlcontacts=("SELECT * FROM sysmoncontacts LEFT JOIN sysmoncontactcatagory ON sysmoncontactcatagory.idcatagory = sysmoncontacts.catagoryid WHERE groupid = '$_SESSION[usrgroupid]' or groupid='0'");
		//sql query waarbij er gebruikt wordt gemaakt system wide contacts
		$sql = 'SELECT idcontact,name,emailaddress,contacttel,streetaddress,country,description,catdescription,company FROM sysmoncontacts LEFT JOIN sysmoncontactcatagory ON sysmoncontactcatagory.idcatagory = sysmoncontacts.catagoryid';
		$q = $this->db->query($sql);
		return $q->result_array();
	}

	/*function geeft een overzicht van alle contact categorieeen
	 *
	 */
	public function GetContactcategory() {
		$sql=("SELECT idcatagory,catdescription FROM sysmoncontactcatagory");
		$q = $this->db->query($sql);
		return $q->result_array();
	}

	/*function slaat een nieuw contact op
	 *
	 */
	 public function createContact() {
	 	$tbl_contact = sysmoncontacts;
	 	$data = array(
	 		'name' => $this->input->post('name'),
	 		'emailaddress' => $this->input->post('emailaddress'),
	 		'contacttel' => $this->input->post('contacttel'),
	 		'streetaddress' => $this->input->post('streetaddress'),
	 		'country' => $this->input->post('country'),
	 		'description' => $this->input->post('description'),
	 		'company' => $this->input->post('company'),
	 		'catagoryid' => $this->input->post('contactcategoryid')
	 	);
	 	return $this->db->insert($tbl_contact, $data);
     }

	/*Function laat alle info van een record($contactid) uit de database
	 * resultaat: array met record gegevens
	 */

	public function getContact($contactid) {
		$tbl_contact = "sysmoncontacts"; //tabel waar de contacten instaan
		$this->db->from($tbl_contact);
		$this->db->where('idcontact', $contactid); //where clause is contact is
		$query = $this->db->get(); //laat alle info uit de tabel contacts
		return $query->row_array(); //resultaat is een array met 1 row van het gekozen record
	}

	/*function update een contact($idcontact)
	 *$data is een array met het record
	 */
	 public function updateContact($data) {
	 	print_r($data);
	 	$tbl_contact = "sysmoncontacts";
		$this->db->where('idcontact', $data['idcontact']);
	 	return $this->db->update($tbl_contact, $data);
     }

	 /* Function verwijdert een aantal geselecteerde contacten. Wordt aangeroepen vanuit de controller contacts
	  *
	  */
	public function deleteSelectedcontacts($arrContacts) {
		$tbl_contact = "sysmoncontacts";
		foreach ($arrContacts as $id) {
			$sql = ("DELETE FROM $tbl_contact WHERE idcontact = $id");
			$result = mysql_query($sql);
			if(mysql_errno() == 1451) return FALSE; //bij een constraint. stoppen en melding geven.
		}
		return TRUE; //reslutaat is altijd TRUe.. kan beter.. TODO! fixen dat het resultaat per query wordt opgelsagen en afgebeeld indien er problemen zijn
	}

}