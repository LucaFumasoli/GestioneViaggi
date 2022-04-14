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
    public function loggedUser(){
        
            require_once "application/views/header/loggedUserHeader.php";
            require_once "application/views/cercaViaggi/ricercaView.php";
            require_once "application/views/footer/footerView.php";
    }
    public function tryToLogin(){
        require_once "application/models/login.php";
        $password = $_POST['floatingPassword'];
        $email = $_POST['floatingEmail'];
        $loginUser = new CheckUser($email, $password);
        if($loginUser->checkIfIsRegistered() != "false"){
            $userName = $loginUser->checkIfIsRegistered();
            $_SESSION['userName'] = $userName['nome'];
            $_SESSION['userSurname'] = $userName['cognome'];
            print_r($_SESSION['userName']);
            $this->loggedUser();
        }else{
            session_start();
            $_SESSION['emailLogin'] = $email;
            $_SESSION['passwordLogin'] = $password;
            $this->login();
        }
    }
    public function tryToRegister(){
        require_once "application/models/register.php";
        $password = str_replace(" ","",$_POST['floatingPassword']);
        $email = $_POST['floatingEmail'];
        $nome = $_POST['floatingNome'];
        $cognome = $_POST['floatingCognome'];
        $repeatedPassword = $_POST['floatingRepeatedPassword'];
        session_start();
        $registerUser = new CheckRegisterParameter($email, $password, $nome, $cognome, $repeatedPassword);
        $ema = false;
        $psw = false;
        $nom = false;
        $cog = false;
        if($registerUser->checkEmptyName()){
            $nom = true;
            $_SESSION['nomeRegister'] = $nome;
            $_SESSION['wrongNameRegister'] = false;
        }else{
            $_SESSION['nomeRegister'] = $nome;
            $_SESSION['wrongNameRegister'] = true;
        }
        if($registerUser->checkEmptySurname()){
            $cog = true;
            $_SESSION['cognomeRegister'] = $cognome; 
            $_SESSION['wrongSurnameRegister'] = false;
        }else{
            $_SESSION['cognomeRegister'] = $cognome;
            $_SESSION['wrongSurnameRegister'] = true;
        }
        if($registerUser->checkEmail()){
            $ema = true;
            $_SESSION['emailRegister'] = $email;
            $_SESSION['wrongEmailRegister'] = false;
        }else{
            $_SESSION['emailRegister'] = $email;
            $_SESSION['wrongEmailRegister'] = true;
        }
        if($registerUser->checkPassword()){
            $psw = true;
            $_SESSION['passwordRegister'] = $password;
            $_SESSION['wrongPasswordRegister'] = false;
        }else{
            $_SESSION['passwordRegister'] = $password;
            $_SESSION['wrongPasswordRegister'] = true;
        }
        if ($ema == true && $psw == true && $cog == true && $nom == true) {
            $registerUser->insertUser();
            $_SESSION['userName'] = $nome;
            $_SESSION['userSurname'] = $cognome;
            $this->loggedUser();
        }else{
            $this->register();
        }
    }
    public function viaggi()
    {
        require_once "application/views/header/headerLoginRegisterView.php";
        require_once "application/views/cercaViaggi/ricercaView.php";
        require_once "application/models/ricercaViaggi.php";
        session_start();
        if (!isset($_SESSION['partenza']) || !isset($_SESSION['arrivo']) || !isset($_SESSION['data']) || !isset($_SESSION['orario']) ||isset($_POST['luogoPartenza']) && $_SESSION['partenza'] != $_POST['luogoPartenza'] || isset($_POST['luogoArrivo']) && $_SESSION['arrivo'] != $_POST['luogoArrivo'] || isset($_POST['dataViaggio']) && $_SESSION['data'] != $_POST['dataViaggio'] ||  isset($_POST['orarioViaggio']) && $_SESSION['orario'] != $_POST['orarioViaggio'] ) {
            $_SESSION['partenza'] = $_POST['luogoPartenza'];
            $_SESSION['arrivo'] = $_POST['luogoArrivo'];
            $_SESSION['data'] = $_POST['dataViaggio'];
            $_SESSION['orario'] = $_POST['orarioViaggio'];
        }
        


        $partenza = $_SESSION['partenza'];
        $arrivo = $_SESSION['arrivo'];
        $data = $_SESSION['data'];
        $orario = $_SESSION['orario'];
        if($data == "" && $orario == ""){
            $data = date("Y-m-d");
            $orario = date("H:i:s");
        }else if($orario == ""){
            $orario = date("00:00:00");
        }else if($data == ""){
            $data = date("Y-m-d");
        }
        echo "<script>console.log('PHP ".$data.$orario."' )</script>";
        $ricercaViaggi = new RicercaViaggi($partenza, $arrivo, $data, $orario);
        $result = $ricercaViaggi->ricerca();
        require_once "application/views/utenteNonLoggato/viaggiView.php";
        require_once "application/views/footer/footerView.php";
    }

     public function createBus()
    {
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/amministratore/CreaBusView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function tryToCreateBus() {
        require_once "application/models/bus.php";
        $nome = $_POST['nomeLinea'];
        $grand = $_POST['grand'];
        $bus = new Bus($nome, $grand);

        if ($bus->checkEmptyField()) {
            $bus->insertBus();
            echo 'Nuovo bus creato';
        }else {
            $_SESSION['colorRed'] = false;
            $this->createBus();
        }
    }
    public function creaViaggi()
    {
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/amministratore/CreaViaggioView.php";
        require_once "application/views/footer/footerView.php";
    }

    public function tratta($idViaggio){
        require_once "application/views/header/backRicercaHeader.php";
        require_once "application/models/visualizzaTratta.php";
        $visualizzaTratta = new VisualizzaTratta($idViaggio);
        $result = $visualizzaTratta->visualizzaDettgliTratta();
        $numBus = $visualizzaTratta->getNumBus();

        //prendere posti totali
        $postiTot = $visualizzaTratta->postiTotali();
        //prendere posti occupati
        $postiOccupati = $visualizzaTratta->postiOccupati();
        //sottrarre
        $postiDisponibili = $postiTot[0]['posti_totali'] - $postiOccupati[0]['posti_occupati'];
        require_once "application/views/utenteNonLoggato/Tratta.php";
        require_once "application/views/footer/footerView.php";
    }

}
