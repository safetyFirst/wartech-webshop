<?php

/**
 * Created by IntelliJ IDEA.
 * User: MarcoWagner
 * Date: 11.02.2015
 * Time: 18:34
 */
require_once 'auth.php';
require_once 'cart.php';
header('Content-Type: text/html; charset=utf-8');

class Template
{

    private static $notice;

    public function showHead()
    {
        echo "<title>Wartech Ltd.</title>
            <script src='jquery-2.1.3.min.js'></script>
            <script src='jquery-ui.min.js'></script>
            <script src='script.js'></script>
            <link rel='stylesheet' href='index.css' type='text/css'>
            <link rel='stylesheet' href='jquery-ui.min.css' type='text/css'>
            <meta http-equiv='content-type' content='text/html; charset=utf-8'>";
    }

    public function showWarenkorbHead()
    {
        echo "<link rel='stylesheet' href='warenkorb.css' type='text/css'>";
    }

    public function showAccountHead()
    {
        echo "<link rel='stylesheet' href='account.css' type='text/css'>";
    }

    public function showHeader()
    {
        echo "<div id='titel'><a href='.'><p id='company'>WarTech Ltd.</p><p id='desc'>intergalactical tech-equipment</p></a></div>
        <nav></nav>";
    }

    public function showAccountOptions()
    {
        echo "<p><a href='?page=account'>your account</a></p>";
    }

    public function showAdminOptions()
    {
        echo "<p><a href='?page=customers'>view customers</a></p>";
        echo "<p><a href='?page=orders'>view orders</a></p>";
    }

    public function showOptions()
    {
        echo "<p><a href='?page=cart'>shopping cart</a></p>";
        echo "<p><a href='?page=orders'>your orders</a></p>";
    }

    public function showMenu()
    {

        $auth = new Auth();
        $cart = new Cart();
        if ($auth->isLoggedIn()) {
            //Welcome
            if ($_SESSION["vorname"] != "" && $_SESSION["name"] != "") {
                echo "<p id='welcome'>Welcome <br/>" . $_SESSION["vorname"] . " " . $_SESSION["name"] . "!</p>";
            } else if ($_SESSION["name"] == "Admin") {
                echo "<p id='welcome'>Welcome Admin!</p>";
            } else if ($_SESSION["name"] != "") {
                echo "<p id='welcome'>Welcome <br/>Herr/Frau " . $_SESSION["name"] . "!</p>";
            } else {
                echo "<p id='welcome'>Welcome!</p>";
            }
            //Account
            echo "<div id='options'>";
            $this->showAccountOptions();
            echo "</div>";
            //Logout
            echo "<form action='.' method='post'><p id='logout'><input type='submit' name='submitLogout' value='logout' /></p></form>";

            //Menu Options, Links
            echo "<div id='options'>";
            if ($_SESSION["admin"] == 1) {
                $this->showAdminOptions();
            } else {
                $cart->showMiniCart();
                $this->showOptions();
            }
            echo "</div>";

        } else {
            $this->showLoginForm();
            echo "<hr/>";
            $this->showRegisterForm();
        }
    }

    public function showLoginForm()
    {
        echo "<form class='log' id='login' action='index.php' method='post'>
		<h2>Login</h2>
		<p>E-Mail: <input type='text' name='login-email'/></p>
		<p>PW: <input type='password' name='login-passwort'></p>
		<p><input type='submit' name='submitLogin' value='login'></p></form>";
    }

    public function showRegisterForm()
    {
        $email = "";
        $forename = "";
        $lastname = "";
        $street = "";
        $location = "";
        if (isset($_POST["email"])) {
            $email = $_POST["email"];
        }
        if (isset($_POST["reg-vorname"])) {
            $forename = $_POST["reg-vorname"];
        }
        if (isset($_POST["reg-nachname"])) {
            $lastname = $_POST["reg-nachname"];
        }
        if(isset($_POST["reg-street"])){
            $street = $_POST["reg-street"];
        }
        if(isset($_POST["reg-location"])){
            $location = $_POST["reg-location"];
        }

        echo "<form class='log' id='register' action='index.php' method='post'>
                <h2>Register</h2>
                <p><input type='text' name='email' placeholder='* e-mail' value='" . $email . "' /></p>
		<p><input type='password' name='reg-passwort' placeholder='* password' /></p>
                <p><input type='password' name='reg-passwort2' placeholder='* password' /></p>
                <p><input type='text' name='reg-vorname' placeholder='forename' value='" . $forename . "' /></p>
                <p><input type='text' name='reg-nachname' placeholder='family name' value='" . $lastname . "' /></p>
                <p><input type='text' name='reg-street' placeholder='street + number' value='" . $street . "' /></p>
                <p><input type='text' name='reg-location' placeholder='zip-code + location' value='" . $location . "' /></p>
                <p><input type='submit' name='submitRegister' value='register' /></p></form>";
    }

    public function showFooter()
    {
        echo "<div id='address' class='starjedi'><p>Wartech Ltd.</p>
            <p>Curbaq Plaza 42</p>
            <p>Imperial City</p>
            <p>Planet Coruscant</p>
            <p>Tel.: 05531 12345</p></div>";
        echo "<div id='info'><p>Sch&uuml;lerprojekt Webshop</p>
        <p>Fachinformatiker - Anwendungsentwicklung</p>
        <p>OSZ IMT - Klasse FA 35</p>
        <p>Haarlemer Stra&szlig;e 23-27</p>
        <p>12359 Berlin</p></div>";
    }

    public static function setNotice($string)
    {
        self::$notice = $string;
    }

    public static function getNotice()
    {
        return self::$notice;
    }
}

?>