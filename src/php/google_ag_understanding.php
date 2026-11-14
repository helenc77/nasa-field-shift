<?php
namespace hcAgUnderstanding;

function getGoogleAgUnderstanding($s2CellId,$accessKey){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://agriculturalunderstanding.googleapis.com/v1:lookupLandscape?key=".$accessKey,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "cache-control: no-cache"
    ),
    CURLOPT_POSTFIELDS => array(
        "locationSpecifier: ".$s2CellId,
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $data = json_decode($response, true);

    //print_r($data);

    return $data;
}

?>