<?php
class Model_usersettings extends CI_Model {
	
	private $tbl_media= 'media'; //tabel users in een property zetten

	/*construct wordt altijd ingelezen
	public function __construct()
	{
	
		
	}
	
	/*Omschrijving:De funtion getEmailaddress returned emailadres
	 *input:userid
	 *resultaat: emailadres
	 */
	public function getEmailaddress($userid = FALSE) {
		if($userid) {
			$this->db->select('*');
			$this->db->where('userid', $userid);
			$query = $this->db->get($this->tbl_media);
			$row = $query->row();
			return $row->sendto;
		}
	}
	
	/* Omschrijving: update het wachtwoord van de gebruiker
	 * input:userid en wachtwoord
	 * resultaat:true of false
	 */ 
	public function updatepassword($password,$userid)
	{
		$sql="UPDATE users SET passwd = '$password' where users.userid = '$userid'";
		if (mysql_query($sql)) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	
	public function updateEmailaddress($newEmailaddress=FALSE,$userid=FALSE) 
	{
		/*
		 * 
		 $sql="select * FROM media WHERE sendto='$newEmailaddress'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		if ($count==1) {
			return "Email address is already in use";
		}else {
		 * 
		 */
		$sql="UPDATE media INNER JOIN users ON users.userid = media.userid SET sendto = '$newEmailaddress' where users.userid = '$userid'";
		if (mysql_query($sql)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/*omschrijving: getNotifications laat de huidige notification settings
	 *input: userid
	 * resultaat: arrays met till,from,weekend,businessdays
	 */
	
	public function getNotifications($userid = FALSE)
	{
		$sql = ("SELECT period FROM media where userid = '$userid' LIMIT 1");
		$result = mysql_query($sql);
		if(mysql_num_rows($result) <> 1) {
			return FALSE;
		} else {
			while($row = mysql_fetch_array($result)) {
				$period = $row['period']; 
			}

			//datum fetchen en de bij behorende checkboxen markeren
			$datewindow = strstr($period , ',',TRUE);
			switch ($datewindow) {
				case '1-7':
					$businessdays = TRUE;
					$weekend = TRUE;
					break;
				case '1-5':
					$businessdays = TRUE;
					$weekend = FALSE;
					break;
				case '6-7':
					$businessdays = FALSE;
					$weekend = TRUE;	
					break;
				case '1-1':
					$businessdays = FALSE;
					$weekend = FALSE;	
					break;
				
			}
			//from tijd berekenen en deze in de invoer velden plaatsen
			$timewindow = strstr($period , ',');
			$timewindow = ltrim($timewindow,','); //verwijder de eerste ,
			
			$till = strstr($timewindow , '-'); //verwijder alles voor de ,
			$till = ltrim($till,'-');
			$till = str_replace(";", "", $till);
			$trill = trim($till);
			$from = strstr($timewindow , '-',TRUE);

			
			$arr['from'] = $from;
			$arr['till'] = $till;
			$arr['businessdays'] = $businessdays;
			$arr['weekend'] = $weekend;
			
			return $arr;
		}
	}
		
}