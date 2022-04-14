<?php 
/**
 * 
 */
class Viaggio
{
	private $bus;
	private $partenza;
	private $dataPartenza;
	private $orarioPartenza;
	private $arrivo;
	private $dataArrivo;
	private $orarioArrivo;
	private $prezzo;

	function __construct($bus, $partenza, $dataPartenza, $orarioPartenza, $arrivo, $dataArrivo, $orarioArrivo, $prezzo)
	{
		$this->bus = $bus;
		$this->partenza = $partenza;
		$this->orarioPartenza = $orarioPartenza;
		$this->dataPartenza = $dataPartenza;
		$this->arrivo = $arrivo;
		$this->orarioArrivo = $orarioArrivo;
		$this->dataArrivo = $dataArrivo;
		$this->prezzo =  $prezzo;
	}
	public function checkEmptyDeparture(){
		if (!empty($this->partenza)) {
			return true;
		}
		return false;
	}
	public function checkEmptyDepartureHour(){
		if (!empty($this->orarioPartenza)) {
			return true;
		}
		return false;
	}
	public function checkEmptyDepartureDate(){
		if (!empty($this->dataPartenza)) {
			return true;
		}
		return false;
	}
	public function checkEmptyArrival(){
		if (!empty($this->arrivo)) {
			return true;
		}
		return false;
	}
	public function checkEmptyArrivalDate(){
		if (!empty($this->dataArrivo)) {
			return true;
		}
		return false;
	}
	public function checkEmptyArrivalHour(){
		if (!empty($this->orarioArrivo)) {
			return true;
		}
		return false;
	}
	public function checkEmptyPrice(){
		if (!empty($this->prezzo)) {
			return true;
		}
		return false;
	}
	public function insertTrip(){
		require "application/libs/connection.php";
		$sql = "INSERT INTO utente (nome, cognome, password,email) VALUES ('$this->nome', '$this->cognome', '$this->password', '$this->email')";
		$con->query($sql);
	}
}
	
?>