<?php
class Model_software extends CI_Model {



	/*Omschrijving: GetSoftwares laat een overzicht van alle applicaties zien. Deze applicaties worden vervolgens weer toegewezen
	 * aan assets.
	 */

	public function getSoftwares() {
		//sql query waarbij er gebruikt wordt gemaakt van multi tenancy
		//$sqlsoftware=("SELECT * FROM sysmonsoftware where groupid='$_SESSION[usrgroupid]'");
		//sql query waarbij er gebruikt wordt gemaakt system wide contacts
		$sql = 'SELECT idsysmonsoftware,vendor,application,version,amount,licensekey FROM sysmonsoftware';
		$q = $this->db->query($sql);
		$counter = 0;
		foreach ($q->result() as $row)
		{
		    $arrResult[$counter]['idsysmonsoftware'] = $row->idsysmonsoftware;
			$arrResult[$counter]['vendor'] = $row->vendor;
			$arrResult[$counter]['version'] = $row->version;
			$arrResult[$counter]['application'] = $row->application;
			$arrResult[$counter]['amount'] = $row->amount;
			$arrResult[$counter]['licensekey'] = $row->licensekey;
			$arrResult[$counter]['licinuse'] = $this->getTotallicensesinuse($row->idsysmonsoftware);
			++$counter;
		}
		return $arrResult;
	}

	/*function slaat een nieuwe applicatie op
	 *
	 */
	 public function createSoftware($data = FALSE) {
	 	$tbl_software = "sysmonsoftware";
		if($data) {
		 	return $this->db->insert($tbl_software, $data);
		} else {
			return false;
		}
     }

	//getSoftware geeft het record van een bepaald id terug
	 public function getSoftware($idsysmonsoftware) {
		$tbl_software = "sysmonsoftware"; //tabel waar de software instaant
		$this->db->from($tbl_software);
		$this->db->where('idsysmonsoftware', $idsysmonsoftware); //where clause is contact is
		$query = $this->db->get(); //laat alle info uit de tabel contacts
		return $query->row_array(); //resultaat is een array met 1 row van het gekozen record
	}

	/*methode update een application($idsysmonsoftware)
	 *$data is een array en bevat alle velden die geupdated moeten worden. methode wordt aangroepen vanuit method updatelocation (controller locations)
	 */
	 public function updateSoftware($data) {
	 	$tbl_software = "sysmonsoftware"; //tabel waar de software instaat
		$this->db->where('idsysmonsoftware', $data['idsysmonsoftware']);
	 	return $this->db->update($tbl_software, $data);
     }

 	/* Function verwijdert een aantal geselecteerde software. Wordt aangeroepen vanuit de controller software
	  *
	  */
	public function deleteSelectedsoftware($arrSoftware) {
		$tbl_software = "sysmonsoftware"; //tabel waar de software instaat
		foreach ($arrSoftware as $id) {
			$sql = ("DELETE FROM $tbl_software WHERE idsysmonsoftware = $id");
			$result = mysql_query($sql);
			if(mysql_errno() == 1451) return FALSE; //bij een constraint. stoppen en melding geven.
		}
		return TRUE; //reslutaat is altijd TRUe.. kan beter.. TODO! fixen dat het resultaat per query wordt opgelsagen en afgebeeld indien er problemen zijn
	}



	//functie kan alleen vanuit classe aangeroepen worden en geeft het aantal licenties ingebruik terug
	private function getTotallicensesinuse($idsysmonsoftware) {
		$sql = ("SELECT idsysmonsoftware FROM sysmonlinksoftware WHERE idsysmonsoftware='$idsysmonsoftware'");
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0) {
			$totalcount = mysql_num_rows($result);
		} else {
			$totalcount = "-";
		}
		return $totalcount;
	}




}
