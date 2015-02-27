<?php

require_once 'db.php';
require_once 'helper.php';
require_once 'template.php';

class Auth
{

    public static $registered = false;
    
    function __construct(){
        self::loginLogout();
        self::register();
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION["email"]) && $_SESSION["email"] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function loginLogout()
    {
        if (isset($_POST["submitLogin"]) && $_POST["login-email"] != "" && $_POST["login-passwort"] != "") {
            $userExists = false;
            $db = new DatabaseHandler();
            $result = $db->queryDB("SELECT ID, EMail, Passwort, Name, Vorname, Admin FROM Nutzer WHERE EMail='{$_POST['login-email']}';", null);
            while ($row = $result->fetch_assoc()) {
                if (password_verify($_POST["login-passwort"], $row["Passwort"])) {
                    $_SESSION["userid"] = $row["ID"];
                    $_SESSION["email"] = $_POST['login-email'];
                    $_SESSION["name"] = $row["Name"];
                    $_SESSION["vorname"] = $row["Vorname"];
                    $_SESSION["admin"] = $row["Admin"];
                } else {
                    Template::setNotice("The entered password is wrong!");
                }
                $userExists = true;
            }
            if (!$userExists) {
                Template::setNotice("This user does not exist!");
            }
        } else if (isset($_POST["submitLogout"])) {
            $_SESSION["userid"] = null;
            $_SESSION["email"] = null;
            $_SESSION["name"] = null;
            $_SESSION["vorname"] = null;
            $_SESSION["admin"] = null;
        }
    }

    public function register()
    {
        //password_hash("tubebakito", PASSWORD_BCRYPT);

        if (isset($_POST["submitRegister"])) {

            if ($_POST["email"] != "" && $_POST["reg-passwort"] != "" && $_POST["reg-passwort2"] != "") {
                if ($_POST["reg-passwort"] == $_POST["reg-passwort2"]) {
                    $db = new DatabaseHandler();
                    $query = "SELECT EMail FROM Nutzer WHERE EMail='" . trim($_POST["email"]) . "';";
                    $result = $db->queryDB($query, "EMail");

                    if (count($result) == 0) {
                        $streetAndNumber = Helper::getLocationFields($_POST["reg-street"], 1);
                        $zipAndLocation = Helper::getLocationFields($_POST["reg-location"], 0);

                        $password = password_hash($_POST["reg-passwort"], PASSWORD_BCRYPT);

                        $query = "INSERT INTO Nutzer (`Name`, `Vorname`, `Strasse`, `StrasseNr`, `PLZ`, `Ort`, `EMail`, `Passwort`, `Admin`) "
                            . "VALUES ('{$_POST["reg-nachname"]}', '{$_POST["reg-vorname"]}', '{$streetAndNumber[0]}', '{$streetAndNumber[1]}', '{$zipAndLocation[0]}', '{$zipAndLocation[1]}', '{$_POST["email"]}', '{$password}', '0')";
                        $result = $db->queryDB($query, null);

                        if ($result == 1) {
                            Template::setNotice("Your account was created!");
                        }
                    } else {
                        Template::setNotice("A customer with this email already exists!");
                    }
                } else {
                    Template::setNotice("The passwords does not match!");
                }
            } else {
                Template::setNotice("You need to fill out at least the fields marked with * !");
            }
        }
    }
}

?>