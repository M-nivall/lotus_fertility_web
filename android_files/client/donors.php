<?php

include '../../include/connections.php';

$select="SELECT d.donor_id,d.height,d.blood_type,d.photo_image,d.weight,
        d.education,d.fee,c.full_name,c.town,c.county,c.date_birth,d.role
        FROM egg_donor d
        INNER JOIN clients c ON d.donor_id = c.client_id
        WHERE d.donor_status = 'Approved' AND c.user = 'Egg Donor' ";

$records=mysqli_query($con,$select);

       $results['status'] = "1";

       $results['products'] = array();

       while ($row=mysqli_fetch_array($records)){
        // Extract the year from date_birth
    $birthYear = date('Y', strtotime(str_replace('/', '-', $row['date_birth'])));
    $currentYear = date('Y'); // 2025
    $age = $currentYear - $birthYear; // Calculate age

    $temp['donorId'] = $row['donor_id'];
    $temp['role'] = $row['role'];
    $temp['height'] = $row['height'];
    $temp['bloodType'] = $row['blood_type'];
    $temp['photoImage'] = $row['photo_image'];
    $temp['weight'] = $row['weight'];
    $temp['education'] = $row['education'];
    $temp['fee'] = $row['fee'];
    $temp['fullName'] = $row['full_name'];
    $temp['town'] = $row['town'];
    $temp['county'] = $row['county'];
    //$temp['dateBirth'] =$row['date_birth'];
    $temp['age'] = $age; // Add age to the response


    array_push($results['products'], $temp);

}


//displaying the result in json format
echo json_encode($results);







?>