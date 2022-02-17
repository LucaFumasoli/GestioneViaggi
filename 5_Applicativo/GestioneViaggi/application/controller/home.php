<?php


class Home
{

    public function index()
    {
        require_once "application/views/header/headerLoginRegisterView.php";
        require_once "application/views/cercaViaggi/ricercaView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function login()
    {
		require_once "application/views/header/backHeaderView.php";
        require_once "application/views/utenteNonLoggato/login.php";
        require_once "application/views/footer/footerView.php";
    }
    public function register()
    {
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/utenteNonLoggato/register.php";
        require_once "application/views/footer/footerView.php";
    }
    public function viaggi()
    {
        require_once "application/views/header/headerLoginRegisterView.php";
        require_once "application/views/cercaViaggi/ricercaView.php";
        require_once "application/models/ricercaViaggi.php";
        $partenza = $_POST['luogoPartenza']; 
        $arrivo = $_POST['luogoArrivo']; 
        $data = $_POST['dataViaggio']; 
        $orario = $_POST['orarioViaggio'];
        $ricercaViaggi = new RicercaViaggi($partenza, $arrivo, $data, $orario);
        $ricercaViaggi->ricerca();

        require_once "application/views/utenteNonLoggato/viaggiView.php";
        require_once "application/views/footer/footerView.php";
    }
    


}
