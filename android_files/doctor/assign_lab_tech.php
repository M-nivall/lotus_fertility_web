<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $surrogateId = $_POST['surrogateId'];
    $username = $_POST['username'];
    $medicalDate = $_POST['medicalDate'];
    $role = $_POST['role'];

    // Fetch employee ID based on username
    $select = "SELECT * FROM employees WHERE username='$username'";
    $query = mysqli_query($con, $select);
    $row = mysqli_fetch_array($query);
    $empID = $row['emp_id'];

    if ($role === 'egg_donor') {
        // Update donor status
        $update = "UPDATE egg_donor SET donor_status = 'Awaiting medical' WHERE donor_id='$surrogateId'";
        
        if (mysqli_query($con, $update)) {
            // Insert into medical_schedule with donor_id
            $insert = "INSERT INTO medical_schedule (surrogate_id, emp_id, medical_date, user) VALUES ('$surrogateId', '$empID', '$medicalDate', 'egg_donor')";
            mysqli_query($con, $insert);

            $response['status'] = 1;
            $response['message'] = 'Approved Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }
    } else {
        // Update surrogate mother status
        $update = "UPDATE surrogate_mother SET surrogate_status = 'Awaiting medical' WHERE surrogate_id='$surrogateId'";
        
        if (mysqli_query($con, $update)) {
            // Insert into medical_schedule with surrogate_id
            $insert = "INSERT INTO medical_schedule (surrogate_id, emp_id, medical_date, user) VALUES ('$surrogateId', '$empID', '$medicalDate', 'surrogate_mother')";
            mysqli_query($con, $insert);

            $response['status'] = 1;
            $response['message'] = 'Approved Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Please try again';
        }
    }

    echo json_encode($response);
}
?>
