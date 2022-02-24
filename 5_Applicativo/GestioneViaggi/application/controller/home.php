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
    public function riservaBiglietto()
    {
        require_once "application/views/header/headerLoginRegisterView.php";
        require_once "application/views/cercaViaggi/ricercaView.php";
        require_once "application/models/ricercaViaggi.php";
    }
    public function creaBus()
    {
        require_once "application/views/header/backHeaderView.php";
        if (isset($_GET['grandezza'])) {
            $grand = $_GET['grandezza'];
        }else {
            $grand = 1;
        }
        if ($grand == 0) {
            $numRig = 5;
        } else if ($grand == 1) {
            $numRig = 10;
        }else {
            $numRig = 15;
        }
        require_once "application/views/CreaBusView.php";
        require_once "application/views/footer/footerView.php";
    }

    public function creaNuovoBus() {
        require_once "application/views/header/backHeaderView.php";
        require_once "application/models/BusModel.php";   

        $bus = new Bus($_POST['grandezza'], $_POST['nomeLinea']);
        if ($bus->checkEmptyField()) {
            $bus->insertBus();
            echo 'Nuovo bus creato';
        }else {
            require_once "application/views/CreaBusView.php";            
        }

        require_once "application/views/footer/footerView.php";
    }
}