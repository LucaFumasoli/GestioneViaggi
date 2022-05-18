<?php


class Home
{

    public function index()
    {
        session_start();
        $_SESSION['isRegistered'] = false;
        require_once "application/views/header/normaluser/loginregister.php";
        require_once "application/views/cercaviaggi/ricercaview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function ricercaViaggiAdmin()
    {
        session_start();
        require_once "application/views/header/admin/backtomain.php";
        require_once "application/views/cercaviaggi/ricercaview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function login()
    {
        session_start();
        unset($_SESSION['isAdmin']);
        if(isset($_SESSION['userName']) && isset($_SESSION['userSurname'])){
           unset($_SESSION['userName']);
            unset($_SESSION['userSurname']); 
        }

		require_once "application/views/header/normaluser/backtoindex.php";
        require_once "application/views/utentenonloggato/login.php";
        require_once "application/views/footer/footerview.php";
        $_SESSION['isAdmin'] = 0;
    }
    public function register()
    {
        
        require_once "application/views/header/normaluser/backtoindex.php";
        require_once "application/views/utentenonloggato/register.php";
        require_once "application/views/footer/footerview.php";
         $_SESSION['isAdmin'] = 0;
    }
    public function loggedUser(){
		require_once "application/views/header/loggeduser/backtoindex.php";
		require_once "application/views/cercaviaggi/ricercaview.php";
		require_once "application/views/footer/footerview.php";
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
            $_SESSION['userEmail'] = $email;
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
            $_SESSION['createAdmin'] = false;
            $registerUser->insertUser();
            $_SESSION['userName'] = $nome;
            $_SESSION['userSurname'] = $cognome;
            $_SESSION['userEmail'] = $email;
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
           require_once "application/views/header/normaluser/loginregister.php";
        }else if ($_SESSION['isAdmin'] == true){
            require_once "application/views/header/admin/backtomain.php";
        }else{
            require_once "application/views/header/loggeduser/backtoindex.php";
        }
        
        require_once "application/views/cercaviaggi/ricercaview.php";
        require_once "application/models/ricercaviaggi.php";
        
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
        require_once "application/views/utentenonloggato/viaggiview.php";
        require_once "application/views/footer/footerview.php";
    }



     public function createBus()
    {
        session_start();
        require_once "application/views/header/admin/backtomain.php";
        require_once "application/views/amministratore/creabusview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function tryToCreateBus() {
        session_start();
        require_once "application/models/bus.php";
        $nome = $_POST['nomeLinea'];
        $grand = $_POST['grand'];
        $bus = new Bus($nome, $grand);

        if ($bus->checkEmptyField()) {
            $out = $bus->insertBus();
            if($out == 1){
                ?><script>alert("creazione bus riuscita")</script><?php
                $this->mainAdminView();
            }else{
                ?><script>alert("creazione bus fallita")</script><?php
                $this->createBus();
            }
        }else {
            $_SESSION['colorRed'] = true;
            $this->createBus();
        }
    }


    public function creaViaggi($unset)
    {
        if (!isset($_SESSION)) { session_start(); }
        if($unset == 0){
            unset($_SESSION['tratte']);
        }
        require_once "application/models/creaviaggi.php";
        $creaViaggi = new CreaViaggi();
        $bus = $creaViaggi->getBuses();
        require_once "application/views/header/admin/backtomain.php";
        require_once "application/views/amministratore/creaviaggioview.php";
        //print_r($_SESSION['tratte']);


        require_once "application/views/footer/footerview.php";
    }

    public function addTratta(){
        session_start();
        require_once "application/models/creaviaggi.php";
        $creaViaggi = new CreaViaggi();
        $nomePartenzaTratta = $_POST['nomePartenzaTratta'];
        $nomePartenzaTratta = strtoupper(substr($nomePartenzaTratta, 0, 1)) . substr($nomePartenzaTratta, 1); 
        $nomeArrivoTratta = $_POST['nomeArrivoTratta'];
        $nomeArrivoTratta = strtoupper(substr($nomeArrivoTratta, 0, 1)) . substr($nomeArrivoTratta, 1);  
        $orarioPartenzaTratta = $_POST['orarioPartenzaTratta'];
        $orarioArrivoTratta = $_POST['orarioArrivoTratta'];
        $prezzo = $_POST['prezzoTratta'];
        $tratta = array();
        if ($creaViaggi->noEmptyValue($nomePartenzaTratta, $nomeArrivoTratta, $orarioPartenzaTratta, $orarioArrivoTratta, 
                $prezzo) && $creaViaggi->checkName($nomePartenzaTratta, $nomeArrivoTratta)&& $creaViaggi->checkOrari($orarioPartenzaTratta, $orarioArrivoTratta) && $creaViaggi->checkPrezzo($prezzo) && $creaViaggi->checkPartenzaSameArrivo($nomePartenzaTratta) && $creaViaggi->checkOrarioPartenzaMaggioreArrivo($orarioPartenzaTratta)){
            $tratta[] = $nomePartenzaTratta;
            $tratta[] = $nomeArrivoTratta;
            $tratta[] = $orarioPartenzaTratta;
            $tratta[] = $orarioArrivoTratta;
            $tratta[] = $prezzo;
            //riuscire rendere matrice
            $_SESSION['tratte'][] = $tratta;
        }

        $this->creaViaggi(1);
    }

    public function addViaggio(){
        session_start();
        require_once "application/models/creaviaggi.php";
        $idBus = $_POST['numeroBus'];
        $creaViaggi = new CreaViaggi();
        $idNuovoViaggio = $creaViaggi->addViaggi($idBus);
        $out = $creaViaggi->addTappe($_SESSION['tratte'], $idNuovoViaggio);
        if($out == 1){
            ?><script>alert("creazione viaggio riuscita")</script><?php
            $this->mainAdminView();
        }else{
            ?><script>alert("creazione viaggio fallita")</script><?php
            $this->creaViaggi(0);
        }

    } 
        

    public function allUsers(){
        require_once "application/models/gestioneutentimodel.php";
        $user = new Users();
        $arrUsers = $user->getUsers();
        require_once "application/views/header/admin/backtomain.php";
        require_once "application/views/amministratore/gestioneutentiview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function users(){
        session_start();
        require_once "application/models/gestioneutentimodel.php";
        if( !isset($_POST['floatingName']) || !isset($_POST['floatingSurname']) ){
            $_SESSION['filterName'] = "";
            $_SESSION['filterSurname'] = "";
        }else{
            $_SESSION['filterName'] = $_POST['floatingName'];
            $_SESSION['filterSurname'] =  $_POST['floatingSurname'];
        }
        $user = new Users();
        $allUser = $user->getUsers();
        $arrUsers = $user->filtra($_SESSION['filterName'],$_SESSION['filterSurname'],$allUser);
        require_once "application/views/header/admin/backtomain.php";
        require_once "application/views/amministratore/gestioneutentiview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function mainAdminView(){
            require_once "application/views/header/admin/logout.php";
            require_once "application/views/amministratore/mainview.php";
            require_once "application/views/footer/footerview.php";
    }
    public function userInfo($id,$nome,$cognome,$email){
        require_once "application/models/userinfomodel.php";
        $u = new UserInfo();
        $fatture = $u->getFactures($email);
        require_once "application/views/header/admin/backtoallusers.php";
        require_once "application/views/amministratore/userinfoview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function userInfoChanged($nome,$cognome,$email){
        require_once "application/models/userinfomodel.php";
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
        require_once "application/views/header/admin/backtoallusers.php";
        
        require_once "application/views/amministratore/userinfoview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function fattura($id){
        require_once "application/models/fatturamodel.php";
        $f = new Fattura();
        $fattura = $f->ticketInfo($id);
        $idUser = $fattura[0]['id_utente'];
        $utente = $f->userInfo($idUser);
        $tappa = $f->stopInfo($id);
        $idViaggio = $tappa[0]['id_viaggio'];
        $bus = $f->bus($idViaggio);
        require_once "application/views/header/admin/backtouserfactures.php";

        require_once "application/views/amministratore/fatturaview.php";
        require_once "application/views/footer/footerview.php";
    }
    public function tratta($idViaggio){
        require_once "application/views/header/backresearch.php";
        require_once "application/models/visualizzatratta.php";
        $visualizzaTratta = new VisualizzaTratta($idViaggio);
        $result = $visualizzaTratta->visualizzaDettgliTratta();
        $numBus = $visualizzaTratta->getNumBus();
        //prendere posti totali
        $postiTot = $visualizzaTratta->postiTotali();
        //prendere posti occupati
        $postiOccupati = $visualizzaTratta->postiOccupati();
        //sottrarre
        
        require_once "application/views/utentenonloggato/tratta.php";
        require_once "application/views/footer/footerview.php";
    }

    public function trattaLoggato($idViaggio)
    {
        require_once "application/views/header/backresearch.php";
        require_once "application/models/visualizzatratta.php";
        $visualizzaTratta = new VisualizzaTratta($idViaggio);
        $result = $visualizzaTratta->visualizzaDettgliTratta();
        $numBus = $visualizzaTratta->getNumBus();

        //prendere posti totali
        $postiTot = $visualizzaTratta->postiTotali();
        //prendere posti occupati
        $postiOccupati = $visualizzaTratta->postiOccupati();
        //sottrarre
        
        require_once "application/views/utenteloggato/trattaloggato.php";
        
        require_once "application/views/footer/footerview.php";
    }

    public function buyTicket($numBus, $postiTot){
        if (!isset($_SESSION)) { session_start(); }
        //prendere nbus posti disponibili luogo partenza e arrivo query
        $arrUserInfo = array();
        require_once "application/models/dettaglitrattamodel.php";
        $info = new tappaInfo();
        $posti = array();
        for ($i=0; $i < count($_SESSION['idTratte']); $i++) { 
            $arrUserInfo[] = $info->userInStop($_SESSION['idTratte'][$i]);
        }
        for ($i=0; $i < count($arrUserInfo); $i++) { 
            for ($j=0; $j < count($arrUserInfo[$i]); $j++) { 
                $posti[] = $info->userPlace($arrUserInfo[$i][$j]['id_biglietto']);
            }
        }
        $arrPosti = array();
        for ($i=0; $i < count($posti); $i++) { 
            $arrPosti[] = $posti[$i][0]['numero_posto'];
        }
        require_once "application/views/header/backresearch.php";
 
        require_once "application/views/utenteloggato/riservabiglietto.php";

        require_once "application/views/footer/footerview.php";
    }
    public function boughtTicket($numBus, $postiTot) {
        if (!isset($_SESSION)) { session_start(); }
        require_once "application/models/riservabiglietto.php";

        $r = new Riserva();
        $np = $_POST["postiRiservati2"];
        $arrPosti = explode(",",$np);
        $out = 0;
        $id = $r->getID($_SESSION['userEmail']);
        $costo = 0;
        for($i = 0; $i < count($_SESSION['idTratte']); $i++){
            $costo += $r->getPrice($_SESSION['idTratte'][$i]);
        }
        for ($i=0; $i < count($arrPosti)-1; $i++) { 
            $idBiglietto = $r->acquisto($id[0]['id'], $costo, $arrPosti[$i]);
            for ($j=0; $j < count($_SESSION['idTratte']); $j++) { 
                $out = $r->bigliettoTratta($_SESSION['idTratte'][$j], $idBiglietto);
            }
        }

        if($out == 1){
            ?><script>alert("acquisto riuscito")</script><?php
            $this->loggedUser();
        }else{
            ?><script>alert("acquisto fallito")</script><?php
            $this->buyTicket($numBus, $postiTot);
        }
    }


    public function trattaAdmin($idViaggio){
        require_once "application/views/header/backresearch.php";
        require_once "application/models/visualizzatratta.php";
        $visualizzaTratta = new VisualizzaTratta($idViaggio);
        $result = $visualizzaTratta->visualizzaDettgliTratta();
        $numBus = $visualizzaTratta->getNumBus();

        //prendere posti totali
        $postiTot = $visualizzaTratta->postiTotali();
        //prendere posti occupati
        $postiOccupati = $visualizzaTratta->postiOccupati();
        //sottrarre
        $postiDisponibili = $postiTot[0]['posti_totali'] - $postiOccupati[0]['max_posti_occupati'];
        require_once "application/views/amministratore/tratta.php";
        require_once "application/views/footer/footerview.php";
    }
    public function infoTappa($idTappa,$idViaggio,$last){
        require_once "application/models/dettaglitrattamodel.php";

        require_once "application/models/visualizzatratta.php";
        $visualizzaTratta = new VisualizzaTratta($idViaggio);
        $postiBus = $visualizzaTratta->postiTotali();

        $info = new tappaInfo();
        $arrInfo = $info->getInfoTappa($idTappa);
        $arrUserInfo = $info->userInStop($idTappa);
        $oldArrUserInfo = array();
        if($idTappa > 1){
            $oldArrUserInfo = $info->userInStop($idTappa-1);
        }
        
        $sale = array();
        $postoSale = array();
        $scende = array();
        $postoScende = array();
        $resta = array();
        $postoResta = array();
        if(count($arrUserInfo)>0){
            for ($i=0; $i < count($arrUserInfo); $i++) {
                $arrStop = $info->allStopInTicket($arrUserInfo[$i]['id_biglietto']);               
                if($last=="true"){
                    $scende[] = $info->userInfo($arrUserInfo[$i]['id_biglietto']);
                    $postoScende[] = $info->userPlace($arrUserInfo[$i]['id_biglietto']);
                    
                }
                else if($arrStop[0]['id_tappa'] == $idTappa){
                    $sale[] = $info->userInfo($arrUserInfo[$i]['id_biglietto']);
                    $postoSale[] = $info->userPlace($arrUserInfo[$i]['id_biglietto']);
                    
                }
                else{
                    $resta[] = $info->userInfo($arrUserInfo[$i]['id_biglietto']);
                    $postoResta[] = $info->userPlace($arrUserInfo[$i]['id_biglietto']);
                }
            }
            if($last!="true"){
                for ($j=0; $j < count($oldArrUserInfo); $j++) { 
                    if(!in_array($oldArrUserInfo[$j], $arrUserInfo)){
                        $scende[] = $info->userInfo($oldArrUserInfo[$j]['id_biglietto']);
                        $postoScende[] = $info->userPlace($oldArrUserInfo[$j]['id_biglietto']);
                    }
                }
            }
        }

        $postiTot = $postiBus[0]['posti_totali'] - count($sale) - count($resta);

        require_once "application/views/header/admin/backtotratta.php";
        require_once "application/views/amministratore/dettaglitratta.php";
        
        require_once "application/views/footer/footerview.php";
    }
    public function createAdmin(){
        require_once "application/views/header/admin/backtomain.php";
        require_once "application/views/amministratore/registernewadmin.php";
        require_once "application/views/footer/footerview.php";
    }
    public function tryToCreateAdmin(){
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
            $_SESSION['createAdmin'] = true;
            $out = $registerUser->insertUser();
            if($out == 1){
                ?><script>alert("creazione riuscita")</script><?php
                $this->mainAdminView();
            }else{
                ?><script>alert("creazione fallita")</script><?php
                $this->createAdmin();
            }
        }else{
            $this->createAdmin();
        }
    }
    public function mandaMail() {
        $email = $_POST['mail'];
        $data = $_POST['data'];
        $fattura = strip_tags($_POST['fattura'],'<br>');
        mail($email, "fattura del " . $data, "infoFattura");
    }

    
}
