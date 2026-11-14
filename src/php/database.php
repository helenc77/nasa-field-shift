<?php

namespace hcDatabase;

function dbConnect(){

    $servername = "db";
    $database = "db";
    $username = "db";
    $password = "db";
    
    // Create connection
    return $conn = new \mysqli($servername, $username, $password, $database);

}

function dbClose($conn){

    return $conn->close();

}

function dbSelect($conn, $table, $fields, $where, $limit, $order){

    $fieldsString = '';

    foreach($fields as $field){
        $fieldsString.= $field.',';
    };
    $fieldsString = rtrim($fieldsString,',');

    $sql = "SELECT ".$fieldsString." FROM ".$table;

    if($where){
        $sql.= " WHERE ".$where;
    }

    if($limit){
        $sql.= " LIMIT ".$limit;
    }

    if($order){
        $sql.= " ORDER BY ".$order;
    }

    return $conn->query($sql);

}

function sanitizeBeforeInsert($values){

    $sanitizedValues = array();

    foreach($values as $key => $value){
        $sanitizedValues[$key] = addslashes($value);
    };

    return $sanitizedValues;

}

function dbInsert ($conn, $table, $fields, $values){

    $fieldsString = '';
    $valuesString = '';

    foreach($fields as $field){
        $fieldsString.= $field.',';
    };
    $fieldsString = rtrim($fieldsString,',');

    foreach($values as $value){
        $valuesString.= "'".$value."',";
    };
    $valuesString = rtrim($valuesString,',');

    $sql = "INSERT INTO ".$table." (".$fieldsString.") VALUES (".$valuesString.")";

    $conn->query($sql);

    return $conn->insert_id;

}

function dbUpdate ($conn, $table, $updates, $where){

    $updatesString = '';

    foreach($updates as $updateKey => $updateVal){
        $updatesString.= $updateKey." = '".$updateVal."',";
    };

    $updatesString = rtrim($updatesString,',');

    $sql = "UPDATE ".$table." SET ".$updatesString." WHERE ".$where;

    return $conn->query($sql);
}

function dbDelete ($conn, $table, $where){ 

    $sql = "DELETE FROM ".$table." WHERE ".$where;

    return $conn->query($sql);
}

?>