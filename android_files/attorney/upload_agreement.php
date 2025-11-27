<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../../include/connections.php';

    $Id = $_POST['Id'];
    $scheduleId = $_POST['scheduleId'];
    $originalImgName = $_FILES['filename']['name'];
    $tempName = $_FILES['filename']['tmp_name'];
    $folder = "../upload_agreements/";

    $response = array(); // Initialize response array

    // Check if file was uploaded successfully
    if (move_uploaded_file($tempName, $folder . $originalImgName)) {
        // Start transaction
        mysqli_autocommit($con, false);

        // Update attorney_assignments table
        $query1 = "UPDATE attorney_assignments 
                  SET assign_status = 'Completed', pdf_agreement = '$originalImgName' 
                  WHERE id = '$Id'";

        // Update schedule table
        $query2 = "UPDATE schedule SET schedule_status = 3 WHERE schedule_id = '$scheduleId'";

        // Execute both queries
        $result1 = mysqli_query($con, $query1);
        $result2 = mysqli_query($con, $query2);

        if ($result1 && $result2) {
            mysqli_commit($con); // Commit transaction if both queries succeed
            $response['status'] = '1';
            $response['message'] = 'Agreement submitted successfully, Awaiting Parent Payment';
        } else {
            mysqli_rollback($con); // Rollback transaction if any query fails
            $response['status'] = '0';
            $response['message'] = 'Failed to update records';
        }
    } else {
        $response['status'] = '0';
        $response['message'] = 'Failed to save PDF file';
    }

    // Close connection
    mysqli_close($con);

    // Return JSON response
    echo json_encode($response);
}
?>
