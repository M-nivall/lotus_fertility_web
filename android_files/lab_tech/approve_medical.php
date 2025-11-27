<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $surrogateId = $_POST['surrogateId'];
    $testDescription = $_POST['testDescription'];
    $role = $_POST['role'];

    if ($role === 'egg_donor') {
        // Update egg_donor table
        $update = "UPDATE egg_donor SET donor_status = 'Approved' WHERE donor_id = '$surrogateId'";

        if (mysqli_query($con, $update)) {
            // Update medical_schedule table
            $update = "UPDATE medical_schedule SET schedule_status = 'Approved', medical_summery = '$testDescription' WHERE surrogate_id = '$surrogateId'";
            mysqli_query($con, $update);

            $response['status'] = 1;
            $response['message'] = 'Approved Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }
    } else {
        // Update surrogate_mother table
        $update = "UPDATE surrogate_mother SET surrogate_status = 'Approved' WHERE surrogate_id='$surrogateId'";

        if (mysqli_query($con, $update)) {
            // Update medical_schedule table
            $update = "UPDATE medical_schedule SET schedule_status = 'Approved', medical_summery = '$testDescription' WHERE surrogate_id='$surrogateId'";
            mysqli_query($con, $update);

            $response['status'] = 1;
            $response['message'] = 'Approved Successfully for Surrogate Mother';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }
    }

    echo json_encode($response);
}
?>
