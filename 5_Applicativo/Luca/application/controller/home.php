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
        $partenza = $_POST['luogoPartenza']; 
        $arrivo = $_POST['luogoArrivo'];
        $data = $_POST['dataViaggio'];
        $orario = $_POST['orarioViaggio'];
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
            $_SESSION['colorRed'] = true;
            $this->createBus();
        }
    }
    public function creaViaggi()
    {
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/amministratore/CreaViaggioView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function tryToCreateViaggi()
    {
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/amministratore/CreaViaggioView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function mostraTratta()
    {
        require_once "application/views/header/backHeaderView.php";
        require_once "application/models/visualizzaTratta.php";
        //$visualizzaTratta = new VisualizzaTratta($idViaggio);
        $visualizzaTratta = new VisualizzaTratta(1);
        //print_r($visualizzaTratta->idViaggio);
        $result = $visualizzaTratta->visualizzaDettgliTratta();
        require_once "application/views/utenteNonLoggato/Tratta.php";
        require_once "application/views/footer/footerView.php";
    }
    public function allUsers(){
        require_once "application/models/gestioneUtentiModel.php";
        $user = new Users();
        $arrUsers = $user->getUsers();
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/amministratore/gestioneUtentiView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function users(){
        require_once "application/models/gestioneUtentiModel.php";
        $filterName = $_POST['floatingName'];
        $filterSurname = $_POST['floatingSurname'];
        $user = new Users();
        $allUser = $user->getUsers();
        $arrUsers = $user->filtra($filterName,$filterSurname,$allUser);
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/amministratore/gestioneUtentiView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function buyTicket(){
        require_once "application/models/Bus.php";
        $bus = new Bus(1, 1);
        $numPosti = 20;
        $busses = $bus->getBusses();
        require_once "application/views/header/backHeaderView.php";
        require_once "application/views/RiservaBiglietto.php";
        require_once "application/views/footer/footerView.php";
    }
    public function tryToBuyTicket(){
        session_start();
        $ticket = new Ticket($viaggio, $utente, $costo);
        if($ticket->checkEmptySeat()){
            $_SESSION['numPosti'] = $numPosti;
            $this->buyTicket();
        }else {

        }
    }
}