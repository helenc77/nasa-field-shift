<?php
namespace hcNasaPower;

function getClimatology($latitude,$longitude,$parameters){

    $start = 2021;
    $end = 2025;
    $community = 'ag';

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://power.larc.nasa.gov/api/temporal/climatology/point?start=".$start."&end=".$end."&latitude=".$latitude."&longitude=".$longitude."&community=".$community."&parameters=".$parameters."&format=json&units=metric&header=true",
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

    return $data;
}

?>