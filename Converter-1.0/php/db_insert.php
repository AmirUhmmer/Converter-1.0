<?php
include ("conn.php");

class db_insert extends db_connect {

    private $user_input;
    private $final_output;

    function insert_data($user_input, $final_output){
        
        $con = $this->connect();
        $this->user_input = $user_input;
        $this->final_output = $final_output;

        $sql = $con->prepare("INSERT INTO history_tb (user_input, user_output) VALUES (?, ?)");
        $sql->bind_param("ss", $this->user_input, $this->final_output);
        $sql->execute();
        $sql->close();
    }
}