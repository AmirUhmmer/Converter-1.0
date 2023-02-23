<?php

class db_connect {
    public $ip;
    public $user;
    public $password;
    public $dbname;

    public function connect(){
        $this->ip = "127.0.0.1";
        $this->user = "root";
        $this->password = "";
        $this->dbname = "convertdb";

        if (!$con = mysqli_connect($this->ip, $this->user, $this->password, $this->dbname)){
            die("failed to connect");
        }
        return $con;
    }
}
