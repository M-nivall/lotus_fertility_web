<?php

include '../../include/connections.php';

$scheduleID = $_POST['scheduleID'];

$select = "SELECT prescription FROM pharmacist_assignments WHERE schedule_id = '$scheduleID'";
$record = mysqli_query($con, $select);

$response = array(); 

if (mysqli_num_rows($record) > 0) {
    $response['status'] = 1;
    $response['message'] = "Status";
    $response['details'] = array();

    while ($row = mysqli_fetch_array($record)) {
        $index['prescription'] = $row['prescription'];
        array_push($response['details'], $index);
    }
} else {
    // If no record is found, set check_status to "Pending"
    $response['status'] = 1; 
    $response['message'] = "Status";
    $response['details'] = array();

    $index['prescription'] = "Nothing prescription found";
    array_push($response['details'], $index);
}

echo json_encode($response);

?>
