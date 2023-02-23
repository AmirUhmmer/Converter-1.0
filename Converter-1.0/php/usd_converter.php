<?php

class usd_converter {

    public $to_convert;

    public function api_convert($to_convert){
        $this->to_convert = $to_convert;

        $api_key = "9Uf5xDvaKovgf2iZSPojqP3barX321W7";
        $url = "https://api.apilayer.com/exchangerates_data/convert?to=usd&from=php&amount=".$to_convert;
        
        //initiate session
        $curl = curl_init();

        //set multiple options
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: 9Uf5xDvaKovgf2iZSPojqP3barX321W7"
        ),
        //return value
        CURLOPT_RETURNTRANSFER => true,
        //all encoding type
        CURLOPT_ENCODING => "",
        //number of redirect
        CURLOPT_MAXREDIRS => 10,
        //how fast to execute
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));
        
        //execute
        $response = curl_exec($curl);
        $data = json_decode($response, true);
        
        curl_close($curl);
        return json_encode((float)$data['result']);
    }
}