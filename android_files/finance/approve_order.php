<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $scheduleId = $_POST['scheduleId'];
    $parentId = $_POST['parentId'];
    $surrogateId = $_POST['surrogateId'];
    $bookingDate = $_POST['bookingDate'];
    $serviceFee = $_POST['serviceFee'];
    $surrogateFee = $_POST['surrogateFee'];
    $totalFee = $_POST['totalFee'];
    $paymentCode = $_POST['paymentCode'];
    $scheduleType = $_POST['scheduleType'];

    // Update schedule status
    $update = "UPDATE schedule SET schedule_status = '5' WHERE schedule_id='$scheduleId'";

    if (mysqli_query($con, $update)) {
        // Insert into payment table
        $insert = "INSERT INTO payment (schedule_id, parent_id, payment_date, service_fee, surrogate_fee, total_fee, payment_code, schedule_type)
                   VALUES ('$scheduleId', '$parentId', '$bookingDate', '$serviceFee', '$surrogateFee', '$totalFee', '$paymentCode', '$scheduleType')";

        if (mysqli_query($con, $insert)) {
            $response['status'] = 1;
            $response['message'] = 'Payment Recorded Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Something went wrong: ' . mysqli_error($con);
        }
    } else {
        $response['status'] = 0;
        $response['message'] = 'Please try again: ' . mysqli_error($con);
    }

    echo json_encode($response);
}

?>
