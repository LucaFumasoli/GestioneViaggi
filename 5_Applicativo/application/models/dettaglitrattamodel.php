<?php
	/**
	 * 
	 */
	class tappaInfo
	{
		function __construct()
		{
			
		}
		public function getInfoTappa($id){
			require "application/libs/connection.php";
			$sql = "Select localita_partenza, localita_arrivo, orario_partenza, orario_arrivo, costo FROM tappa where id = '$id'";
			$tappa = $con->query($sql);
			$arrInfoTappa = array();
			if($tappa->num_rows > 0){
				while($row = $tappa->fetch_assoc()){
					$arrInfoTappa[] = $row;
				}
			}
			return $arrInfoTappa;
		}
		public function userInStop($id){
			require "application/libs/connection.php";
			$sql = "select id_biglietto from biglietto_tappa where id_tappa = '$id'";
			$tappa = $con->query($sql);
			$arrInfoTappa = array();
			if($tappa->num_rows > 0){
				while($row = $tappa->fetch_assoc()){
					$arrInfoTappa[] = $row;
				}
			}
			return $arrInfoTappa;
		}
		public function allStopInTicket($id){
			require "application/libs/connection.php";
			$sql = "select id_tappa from biglietto_tappa where id_biglietto = '$id'";
			$tappa = $con->query($sql);
			$arrInfoTappa = array();
			if($tappa->num_rows > 0){
				while($row = $tappa->fetch_assoc()){
					$arrInfoTappa[] = $row;
				}
			}
			return $arrInfoTappa;
		}
		public function userInfo($id){
			require "application/libs/connection.php";
			$sql = "select nome,cognome from utente where id = (select id_utente from biglietto where id = '$id')";
			$tappa = $con->query($sql);
			$arrInfoTappa = array();
			if($tappa->num_rows > 0){
				while($row = $tappa->fetch_assoc()){
					$arrInfoTappa[] = $row;
				}
			}
			return $arrInfoTappa;
		}
		public function userPlace($id){
			require "application/libs/connection.php";
			$sql = "select numero_posto from biglietto where id = '$id'";
			$tappa = $con->query($sql);
			$arrInfoTappa = array();
			if($tappa->num_rows > 0){
				while($row = $tappa->fetch_assoc()){
					$arrInfoTappa[] = $row;
				}
			}
			return $arrInfoTappa;
		}
	}
?>