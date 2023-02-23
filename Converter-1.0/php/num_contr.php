<?php
include ("num_converter.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $input = $_POST['user_input'];

    $number = new num_converter();

    $number->number_checker($input);

}


