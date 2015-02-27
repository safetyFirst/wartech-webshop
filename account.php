<?php

require_once 'db.php';
require_once 'helper.php';

class Account
{

    function __construct()
    {
        self::changeBillingAddress();
        self::changeEmail();
        self::changePassword();
    }

    public function showAccountSettings()
    {
        echo "<div id='accountSettings'><h2 class='pageTitle'>Account Settings</h2>";

        echo "<div id='billingSettings' class='settingsDiv'><h3>Billing Address</h3>";
        self::showBillingAddress();
        self::showChangeBillingAddress();
        echo "</div>";

        echo "<div id='loginSettings' class='settingsDiv'><h3>Email Address</h3>";
        self::showChangeEmail();
        self::showChangePassword();
        echo "</div>";

        echo "</div>";
    }

    public function showBillingAddress()
    {
        $db = new DatabaseHandler();
        $result = $db->queryDB("SELECT Name, Vorname, Strasse, StrasseNr, PLZ, Ort, EMail FROM Nutzer WHERE ID={$_SESSION['userid']};", null);
        echo "<div id='showBilling' class='leftSettings'>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . $row["Vorname"] . " " . $row["Name"] . "</p>";
            echo "<p>" . $row["Strasse"] . " " . $row["StrasseNr"] . "</p>";
            echo "<p>" . $row["PLZ"] . " " . $row["Ort"] . "</p>";
        }
        echo "</div>";
    }

    public function showChangeBillingAddress()
    {
        echo "<form id='changeBilling' class='rightSettings' action='?page=account' method='post'><fieldset><legend>Change Address</legend>";
        echo "<p><label>forename</label><br/><input type='text' name='forename' /></p>";
        echo "<p><label>family name</label><br/><input type='text' name='lastname' /></p>";
        echo "<p><label>Street + Nr</label><br/><input type='text' name='street' /></p>";
        echo "<p><label>Location + Zipcode</label><br/><input type='text' name='location' /></p>";
        echo "<p><input type='submit' name='submitChangeBilling' value='change Billing Address'></p>";
        echo "</fieldset></form>";
    }

    public function changeBillingAddress()
    {
        if (isset($_POST["submitChangeBilling"])) {
            $db = new DatabaseHandler();
            $noticeBuiler = "Change Address:<br/>";
            if ($_POST["forename"] != "") {
                $result = $db->queryDB("UPDATE Nutzer SET Vorname='" . trim($_POST["forename"]) . "' WHERE ID={$_SESSION['userid']};", null);
                $noticeBuiler = "Your forename was changed successfully.<br/>";
            }
            if ($_POST["lastname"] != "") {
                $result = $db->queryDB("UPDATE Nutzer SET Name='" . trim($_POST["lastname"]) . "' WHERE ID={$_SESSION['userid']};", null);
                $noticeBuiler = "Your family name was changed successfully.<br/>";
            }
            if ($_POST["street"] != "") {
                $street = Helper::getLocationFields($_POST["street"], 1);
                if ($street != false) {
                    $result = $db->queryDB("UPDATE Nutzer SET Strasse='" . $street[0] . "' WHERE ID={$_SESSION['userid']};", null);
                    $result = $db->queryDB("UPDATE Nutzer SET StrasseNr=" . $street[1] . " WHERE ID={$_SESSION['userid']};", null);
                    $noticeBuiler = "Your street and number was changed successfully.<br/>";
                }
            }
            if ($_POST["location"] != "") {
                $location = Helper::getLocationFields($_POST["location"], 0);
                if ($location != false) {
                    $result = $db->queryDB("UPDATE Nutzer SET PLZ=" . $location[0] . " WHERE ID={$_SESSION['userid']};", null);
                    $result = $db->queryDB("UPDATE Nutzer SET Ort='" . $location[1] . "' WHERE ID={$_SESSION['userid']};", null);
                    $noticeBuiler = "Your zipcode and location was changed successfully.<br/>";
                }
            }
            Template::setNotice($noticeBuiler);
        }
    }

    public function showChangeEmail()
    {
        $db = new DatabaseHandler();
        $result = $db->queryDB("SELECT EMail FROM Nutzer WHERE ID={$_SESSION['userid']};", "EMail");

        echo "<form id='changeEmail' class='leftSettings' action='?page=account' method='post'><fieldset><legend>Change Email</legend>";
        echo "<p>current address: " . $result[0] . "</p>";
        echo "<p><label>new email</label><br/><input type='text' name='email' /></p>";
        echo "<p><label>current password</label><br/><input type='password' name='password' /></p>";
        echo "<p><input type='submit' name='submitChangeEmail' value='change email'></p>";
        echo "</fieldset></form>";
    }

    public function changeEmail()
    {
        if (isset($_POST["submitChangeEmail"])) {
            $db = new DatabaseHandler();
            $result = $db->queryDB("SELECT Passwort FROM Nutzer WHERE ID={$_SESSION['userid']};", "Passwort");
            if (password_verify($_POST["password"], $result[0])) {
                $result = $db->queryDB("UPDATE Nutzer SET EMail='" . trim($_POST['email']) . "' WHERE ID={$_SESSION['userid']};", null);
                if ($result == 1) {
                    Template::setNotice("Change Email: Your Email was changed successfully.");
                } else {
                    Template::setNotice("Change Email: unknown error!");
                }
            } else {
                Template::setNotice("Change Email: The entered password is wrong.");
            }
        }
    }

    public function showChangePassword()
    {
        $db = new DatabaseHandler();
        echo "<form id='changePassword' class='rightSettings' action='?page=account' method='post'><fieldset><legend>Change Password</legend>";
        echo "<p><label>current password</label><br/><input type='password' name='currPassword' /></p>";
        echo "<p><label>new password</label><br/><input type='password' name='newPassword' /></p>";
        echo "<p><label>new password again</label><br/><input type='password' name='newPassword2' /></p>";
        echo "<p><input type='submit' name='submitChangePassword' value='change password'></p>";
        echo "</fieldset></form>";
    }

    public function changePassword()
    {
        if (isset($_POST["submitChangePassword"])) {
            if ($_POST["newPassword"] == $_POST["newPassword2"]) {
                $db = new DatabaseHandler();
                $result = $db->queryDB("SELECT Passwort FROM Nutzer WHERE ID={$_SESSION['userid']};", "Passwort");
                if (password_verify($_POST["currPassword"], $result[0])) {
                    $newPassword = password_hash(trim($_POST['newPassword']), PASSWORD_BCRYPT);
                    $result = $db->queryDB("UPDATE Nutzer SET Passwort='" . $newPassword . "' WHERE ID={$_SESSION['userid']};", null);
                    if ($result == 1) {
                        Template::setNotice("Change Password: Your password was changed successfully.");
                    } else {
                        Template::setNotice("Change Password: unknown error!");
                    }
                } else {
                    Template::setNotice("Change Password: The entered password is wrong.");
                }
            } else {
                Template::setNotice("Change Password: The passwords does not match.");
            }
        }
    }
}

?>