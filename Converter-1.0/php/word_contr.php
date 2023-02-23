<?php
include ("word_converter.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $input = $_POST['user_input'];

    $number = new words_converter();

    $number->word_checker($input);

}