<?php
/**
 * Created by PhpStorm.
 * User: Mwafrika
 * Date: 10/12/2019
 * Time: 11:49 AM
 */

// Insert schedule details

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../../include/connections.php';

    $parent_id = $_POST['clientID'];
    $surrogateID = $_POST['surrogateID'];
    $service_fee = $_POST['service_fee'];
    $surrogate_fee = $_POST['surrogate_fee'];
    $total_fee = $_POST['total_fee'];
    $partner_name = $_POST['partner_name'];
    $partner_contact = $_POST['partner_contact'];
    $partner_birth = $_POST['partner_birth'];
    //$payment_code = $_POST['payment_code'];
    $schedule_date = $_POST['schedule_date'];
    $role = $_POST['role'];

    $current_date = date("Y-m-d");

    if (empty($partner_name)) {
        $result['status'] = "0";
        $result['message'] = "Enter partner name";
    } else {
        // Insert values into schedule table
        $insert = "INSERT INTO schedule (parent_id, surrogate_id, service_fee, surrogate_fee, total_fee, partner_name, partner_contact, partner_birth, schedule_date, booking_date,schedule_type) 
                   VALUES ('$parent_id', '$surrogateID', '$service_fee', '$surrogate_fee', '$total_fee', '$partner_name', '$partner_contact', '$partner_birth', '$schedule_date', '$current_date', '$role')";

        if (mysqli_query($con, $insert)) {
            $result['status'] = "1";
            $result['message'] = "Submitted successfully, Proceed to Select Attorney";
        } else {
            $result['status'] = "0";
            $result['message'] = "Error: " . mysqli_error($con);
        }
    }

    echo json_encode($result);
}
?>
