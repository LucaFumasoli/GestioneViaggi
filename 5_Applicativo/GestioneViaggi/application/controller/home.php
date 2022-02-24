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
    public function tryToLogin(){
        require_once "application/models/login.php";
        $password = $_POST['floatingPassword'];
        $email = $_POST['floatingEmail'];
        $loginUser = new CheckUser($email, $password);
        if($loginUser->checkIfIsRegistered() != "false"){
            
            $userName = $loginUser->checkIfIsRegistered();
            require "application/views/header/loggedUserHeader.php";
            require_once "application/views/cercaViaggi/ricercaView.php";
            require_once "application/views/footer/footerView.php";
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
        if($registerUser->checkEmail()){
            $ema = true;
        }else{
            $_SESSION['emailRegister'] = $email;
            $_SESSION['passwordRegister'] = $password;
            $_SESSION['nomeRegister'] = $nome;
            $_SESSION['cognomeRegister'] = $cognome;
            $_SESSION['repeatedPasswordRegister'] = $repeatedPassword;
            $_SESSION['wrongEmailRegister'] = true;
        }
        if($registerUser->checkPassword()){
            $psw = true;
        }else{
            $_SESSION['emailRegister'] = $email;
            $_SESSION['passwordRegister'] = str_replace(" ","",$password);
            $_SESSION['nomeRegister'] = $nome;
            $_SESSION['cognomeRegister'] = $cognome;
            $_SESSION['repeatedPasswordRegister'] = $repeatedPassword;
            $_SESSION['wrongPasswordRegister'] = true;
        }
        echo $ema;
        echo $psw;
        $this->register();

    }

}
