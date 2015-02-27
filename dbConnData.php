<?php

class DbConnData {

    private $server;
    private $user;
    private $password;
    private $database;

    function __construct($machine) {

        if ($machine == "localhost") {
            $this->server = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->database = "versand";
        } else if ($machine == "hostinger") {
            $this->server = "31.170.164.41";
            $this->user = "u102846768_user";
            $this->password = "tubebakito123";
            $this->database = "u102846768_wv";
        }
    }

    public function getServer() {
        return $this->server;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDatabase() {
        return $this->database;
    }

}

?>