<?php
/**
 *
 */
class Ticket
{
	private $idViaggio;
	private $idUtente;
	private $costo;

	function __construct($idUtente, $costo_totale, $data, $numero_posto)
	{
		$this->idUtente = $idUtente;
		$this->costo_totale = $costo_totale;
		$this->data = $data;
		$this->numero_posto = $numero_posto;
	}
	public function checkEmptySeat(){
		if (!empty($this->numero_posto)) {
			return true;
		}
		return false;
	}
	public function insertTicket(){
		require "application/libs/connection.php";
		$sql = "INSERT INTO biglietto (idUtente, costo_totale, data, numero_posto)
				 VALUES ('$this->idUtente, '$this->costo_totale','$this->data,'$this->numero_posto')";
		$con->query($sql);
	}
}

?>