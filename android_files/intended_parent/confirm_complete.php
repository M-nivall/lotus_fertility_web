<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if required POST parameters exist
    if (isset($_POST['scheduleID']) && isset($_POST['remarks'])) {

        $scheduleID = mysqli_real_escape_string($con, $_POST['scheduleID']);
        $remarks = mysqli_real_escape_string($con, $_POST['remarks']);

        // Update query
        $update = "UPDATE schedule SET schedule_status = '9' WHERE schedule_id = '$scheduleID'";

        if (mysqli_query($con, $update)) {

            $response['status'] = 1;
            $response['message'] = 'Approved Successfully, Thank you for choosing Lotus Fertilty';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Database update failed: ' . mysqli_error($con);
        }
    } else {
        $response['status'] = 0;
        $response['message'] = 'Missing required parameters';
    }
} else {
    $response['status'] = 0;
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>
