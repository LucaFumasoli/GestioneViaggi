<?php


class Home
{

    public function index()
    {
        session_start();
        $_SESSION['isRegistered'] = false;
        require_once "application/views/header/headerLoginRegisterView.php";
        require_once "application/views/cercaViaggi/ricercaView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function ricercaViaggiAdmin()
    {
        session_start();
        require_once "application/views/header/backAdminHeader.php";
        require_once "application/views/cercaViaggi/ricercaView.php";
        require_once "application/views/footer/footerView.php";

    }
    public function login()
    {
        session_start();
        unset($_SESSION['isAdmin']);
        if(isset($_SESSION['username']) && isset($_SESSION['usersurname'])){
           unset($_SESSION['username']);
            unset($_SESSION['usersurname']); 
        }

		require_once "application/views/header/backHeaderView.php";
        require_once "application/views/utenteNonLoggato/login.php";
        require_once "application/views/footer/footerView.php";
        $_SESSION['isAdmin'] = 0;
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
        session_start();
        require_once "application/models/login.php";
        $password = $_POST['floatingPassword'];
        $email = $_POST['floatingEmail'];
        $loginUser = new CheckUser($email, $password);
        if($loginUser->checkIfIsRegistered() != "false"){
            $userName = $loginUser->checkIfIsRegistered();
            $_SESSION['userName'] = $userName['nome'];
            $_SESSION['userSurname'] = $userName['cognome'];
            //print_r($_SESSION['userName']);
            if($_SESSION['isAdmin']){
                $_SESSION['isRegistered'] = true;
                $this->mainAdminView();
                
            }else{
                $_SESSION['isRegistered'] = true;
                $this->loggedUser();
                
            }
            
        }else{
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
            $_SESSION['isRegistered'] = true;
            $this->loggedUser();
            
        }else{
            $this->register();
        }
    }
    public function viaggi()
    {
        session_start();
        if ($_SESSION['isRegistered'] == false) {
           require_once "application/views/header/headerLoginRegisterView.php";
        }else{
            require_once "application/views/header/loggedUserHeader.php";
        }
        
        require_once "application/views/cercaViaggi/ricercaView.php";
        require_once "application/models/ricercaViaggi.php";
        
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
        session_start();
        require_once "application/views/header/backAdminHeader.php";
        require_once "application/views/amministratore/CreaBusView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function tryToCreateBus() {
        session_start();
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
        require_once "application/views/header/backAdminHeader.php";
        require_once "application/views/amministratore/CreaViaggioView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function allUsers(){
        require_once "application/models/gestioneUtentiModel.php";
        $user = new Users();
        $arrUsers = $user->getUsers();
        require_once "application/views/header/backAdminHeader.php";
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
        require_once "application/views/header/backAdminHeader.php";
        require_once "application/views/amministratore/gestioneUtentiView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function mainAdminView(){
            require_once "application/views/header/adminHeaderView.php";
            //require_once "application/views/RiservaBiglietto.php";
            require_once "application/views/amministratore/MainView.php";
            require_once "application/views/footer/footerView.php";
    }
    public function userInfo($id,$nome,$cognome,$email){
        require_once "application/models/UserInfoModel.php";
        $u = new UserInfo();
        $fatture = $u->getFactures($email);
        require_once "application/views/header/backToAllUsersView.php";
        require_once "application/views/amministratore/UserInfoView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function userInfoChanged($nome,$cognome,$email){
        require_once "application/models/UserInfoModel.php";
        $u = new UserInfo();
        $nomeNuovo = $_POST['floatingNome'];
        $cognomeNuovo = $_POST['floatingCognome'];
        $emailNuovo = $_POST['floatingEmail'];
        if(!empty($nomeNuovo)){
            $nome = $nomeNuovo;
        }
        if(!empty($cognomeNuovo)){
            $cognome = $cognomeNuovo;
        }
        $newEmail = $email;
        if(!empty($emailNuovo) && $u->checkEmail($emailNuovo)){
            $newEmail = $emailNuovo;
        }
        
        $user = $u->changeUserInfo($nome,$cognome,$newEmail,$email);
        $email = $newEmail;
        $fatture = $u->getFactures($email);
        require_once "application/views/header/backToAllUsersView.php";
        
        require_once "application/views/amministratore/UserInfoView.php";
        require_once "application/views/footer/footerView.php";
    }
    public function fattura($id){
        require_once "application/models/FatturaModel.php";
        $f = new Fattura();
        $fattura = $f->ticketInfo($id);
        $idUser = $fattura[0]['id_utente'];
        $utente = $f->userInfo($idUser);
        $tappa = $f->stopInfo($id);
        $idViaggio = $tappa[0]['id_viaggio'];
        $bus = $f->bus($idViaggio);
        require_once "application/views/header/adminHeaderView.php";

        require_once "application/views/amministratore/FatturaView.php";
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

    public function trattaLoggato($idViaggio)
    {
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
        require_once "application/views/utenteLoggato/trattaLoggato.php";
        require_once "application/views/footer/footerView.php";
    }

     public function buyTicket($numBus, $postiTot){
        require_once "application/views/header/backHeaderView.php";
        
        require_once "application/views/utenteLoggato/riservaBiglietto.php";
        require_once "application/views/footer/footerView.php";
    }
}
