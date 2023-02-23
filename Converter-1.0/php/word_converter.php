<?php
include ("db_insert.php");
include ("usd_converter.php");

class words_converter {

    public $user_input;
  
    public function word_checker($input) {
      $this->user_input = $input;
  
      $user_input = $pending_word = $this->user_input;
  
      $ones_word_arr = array(0 => "zero", 1 => "one", 2 => "two", 3 => "three", 4 => "four", 5 => "five", 6 => "six", 7 => "seven", 8 => "eight",
                      9 => "nine", 10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen", 14 => "fourteen", 15 => "fifteen", 16 => "sixteen",
                      17 => "seventeen", 18 => "eighteen", 19 => "nineteen", 20  => "twenty", 30 => "thirty", 40 => "fourty", 50 => "fifty", 60 => "sixty", 
                      70 => "seventy", 80 => "eighty", 90 => "ninety");
  
      $levels = array("1" => "and", "100" => "hundred", "1000" => "thousand", "1000000" => "million", "1000000000" => "billion");
  
      //make the words into an array every space is a value
      $split_words = explode(" ", strtolower($pending_word));
  
      $i=0;
  
      $SINGLE = 0;
  
      $thousand_up = 0;
  
      $final_output = '';
  
      //loop in every word
      foreach($split_words as $word){
          //ZERO
          if($word == 'zero'){
            $final_output = '0';
          }
          //if the word is in array 
          elseif(array_search($word, $ones_word_arr) && $word != "zero"){
            $SINGLE += (int)array_search($word, $ones_word_arr);
          
          }
          //if the word contains hundred just multiply by 100
          elseif($word=="hundred"){
            $SINGLE *= (int)array_search($word, $levels);
          }
          //if the word is in levels array and it is not hundred
          elseif(array_search($word, $levels) && $word!="hundred"){
            //checker
            $i++;
            $thousand_up = $thousand_up + (int)($SINGLE) * (int)array_search($word, $levels);
            $SINGLE=0;
          }
          //if the word is not in array
          else{
            $final_output = "INVALID INPUT";
          }
      }
  
      //if the output is invalid
      if($final_output=='INVALID INPUT'){
          echo json_encode($final_output);
      }
      //add
      else {
        $final_output = $thousand_up + $SINGLE;
  
        // echo json_encode(number_format($final_output));
        
        $usd = new usd_converter();
        $usd_value = $usd->api_convert($final_output);
        
        $data = ["final_output" => number_format($final_output),"usd" => number_format($usd_value,2) ];
        echo json_encode($data);
      }
  
      $insert = new db_insert();
      $insert->insert_data($user_input, $final_output);
    }
  
  }