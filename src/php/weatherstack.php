<?php
namespace hcWeatherstack;

function getCurrentWeather($accessKey){

    //$weatherLocation = 'PL146SA';
    //$weatherLocation = 'London';
    $weatherLocation = '50.48672,-4.47061';

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.weatherstack.com/current?query=".$weatherLocation."&access_key=".$accessKey,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "cache-control: no-cache"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $data = json_decode($response, true);
    //print_r($data);

    return $data;

}

?>