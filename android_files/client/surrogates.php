<?php

include '../../include/connections.php';

$select="SELECT s.surrogate_id,s.height,s.blood_type,s.photo_image,s.weight,
        s.education,s.fee,c.full_name,c.town,c.county,c.date_birth,s.role
        FROM surrogate_mother s 
        INNER JOIN clients c ON s.surrogate_id = c.client_id
        WHERE s.surrogate_status = 'Approved' AND c.user = 'Surrogate Mother' ";

$records=mysqli_query($con,$select);

       $results['status'] = "1";

       $results['products'] = array();

       while ($row=mysqli_fetch_array($records)){
        // Extract the year from date_birth
    $birthYear = date('Y', strtotime(str_replace('/', '-', $row['date_birth'])));
    $currentYear = date('Y'); // 2025
    $age = $currentYear - $birthYear; // Calculate age

    $temp['surrogateId'] = $row['surrogate_id'];
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