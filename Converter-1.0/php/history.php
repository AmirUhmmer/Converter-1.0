<?php

include ("conn.php");

class show_history extends db_connect {

    public function display_history(){
        $con = $this->connect();
        $sql_u = "SELECT * FROM history_tb ORDER BY id DESC LIMIT 5";
        $res_u = mysqli_query($con, $sql_u);

        if (mysqli_num_rows($res_u) > 0) {
            while($row_data = mysqli_fetch_array($res_u)){
                echo "<tr><td>".$row_data["user_input"]."</td><td>".$row_data["user_output"]."</tr>";
            }
        }
    }
}

$history = new show_history();
$history->display_history();