<?php

include '../../include/connections.php';

$scheduleID = $_POST['scheduleID'];

$select = "SELECT check_status, remark FROM first_checkup WHERE schedule_id = '$scheduleID'";
$record = mysqli_query($con, $select);

$response = array(); 

if (mysqli_num_rows($record) > 0) {
    $response['status'] = 1;
    $response['message'] = "Status";
    $response['details'] = array();

    while ($row = mysqli_fetch_array($record)) {
        $index['check_status'] = $row['check_status'];
        $index['remark'] = $row['remark'];
        array_push($response['details'], $index);
    }
} else {
    // If no record is found, set check_status to "Pending"
    $response['status'] = 1; 
    $response['message'] = "Status";
    $response['details'] = array();

    $index['check_status'] = "Pending";
    $index['remark'] = "Pending";
    array_push($response['details'], $index);
}

echo json_encode($response);

?>
