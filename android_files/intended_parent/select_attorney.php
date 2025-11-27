<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $scheduleID = $_POST['scheduleID'];
    $surrogateID = $_POST['surrogateID'];
    $username = $_POST['username'];
    $parentID = $_POST['parentID'];

    $response = array();

    // Fetch employee ID based on username
    $select = "SELECT * FROM employees WHERE username = '$username'";
    $query = mysqli_query($con, $select);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        $empID = $row['emp_id'];

        // Insert into attorney_assignments table
        $insert = "INSERT INTO attorney_assignments (schedule_id, emp_id, parent_id, surrogate_id) 
                   VALUES ('$scheduleID', '$empID', '$parentID', '$surrogateID')";
        
        if (mysqli_query($con, $insert)) {
            // Update the schedule table after successful insertion
            $update = "UPDATE schedule SET schedule_status = 2 WHERE schedule_id = '$scheduleID'";
            
            if (mysqli_query($con, $update)) {
                $response['status'] = 1;
                $response['message'] = 'Submitted Successfully';
            } else {
                $response['status'] = 0;
                $response['message'] = 'Submission Successful, but Schedule Update Failed';
            }
        } else {
            $response['status'] = 0;
            $response['message'] = 'Insertion Failed, Please Try Again';
        }
    } else {
        $response['status'] = 0;
        $response['message'] = 'User not found';
    }

    echo json_encode($response);
}
?>
