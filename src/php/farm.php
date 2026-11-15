<?php

    namespace hcFarm;

    use function hcFormHandling\xssPrevention as xssPrevention;
    use function hcDatabase\{dbConnect, dbSelect, dbInsert, dbUpdate, dbClose, sanitizeBeforeInsert};

    function getFarmData($userId) {

        $conn = dbConnect();
        $getUser = dbSelect($conn, 'users', array('farm_id'), 'id = "'.$userId.'"', 1, null);
        $user = $getUser->fetch_assoc();
        $getFarm = dbSelect($conn, 'farms', array('id, name, soil_ph, soil_type, current_crop, location_ref', 's2cellid'), 'id = "'.$user['farm_id'].'"', 1, null);
        $farm = $getFarm->fetch_assoc();
        dbClose($conn);

        return $farm;

    }

    function getCropData(){

        $conn = dbConnect();
        $getCrops = dbSelect($conn, 'crops', array('id, name, crop_family, max_soil_ph, min_soil_ph, ideal_avg_rainfall_min', 'ideal_avg_rainfall_max'), null, null , null);
        $crops = $getCrops->fetch_all(MYSQLI_ASSOC);
        dbClose($conn);

        return $crops;

    }

    function getCropFamilies(){

        $conn = dbConnect();
        $getCropFamilies = dbSelect($conn, 'crop_family', array('id, name'), null, null , null);
        $cropFamilies = $getCropFamilies->fetch_all(MYSQLI_ASSOC);
        dbClose($conn);

        $cropFamiliesArr = [];
        foreach($cropFamilies as $val){
            $cropFamiliesArr[$val['id']] = $val['name'];
        }

        return $cropFamiliesArr;

    }

    function updateFarmData($farmId, $post) {   

            $conn = dbConnect();

            //sanitize
            $values = [
                'name' => $post['name'], 
                'location_ref' => $post['location_ref'],
                'soil_ph' => $post['soil_ph'],
                'soil_type' => $post['soil_type'],
                'current_crop' => $post['current_crop']
                ];
            $sanitizedValues = sanitizeBeforeInsert($values);

            $updateFarm = dbUpdate ($conn, 'farms', 
                array(
                    'name' => $sanitizedValues['name'], 
                    'location_ref' =>$sanitizedValues['location_ref'],
                    'soil_ph' =>$sanitizedValues['soil_ph'],
                    'soil_type' =>$sanitizedValues['soil_type'],
                    'current_crop' =>$sanitizedValues['current_crop']
                    ),
                'id = "'.$farmId.'"');

            dbClose($conn);

        }

?>