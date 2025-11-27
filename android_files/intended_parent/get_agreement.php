<?php
include '../../include/connections.php';

//header('Content-Type: application/json');


$scheduleId = $_POST['scheduleId'];
$userId = $_POST['userId'];

$select = mysqli_query($con, "SELECT pdf_agreement FROM attorney_assignments 
WHERE schedule_id = '$scheduleId' AND parent_id = '$userId' ");
if (mysqli_num_rows($select)> 0) {
    $response['status'] = 1;
    $response['responseData'] = array();
    while ($row = mysqli_fetch_array($select)) {
        $index['pdfAgreement'] = $row['pdf_agreement'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = "No record found";
}
print json_encode($response);