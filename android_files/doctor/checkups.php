<?php
include '../../include/connections.php';

//header('Content-Type: application/json');

//$userId = $_POST['instructorId'];
// $packageId = $_POST['packageId'];

$select = mysqli_query($con, "SELECT ch.id,ch.schedule_id,ch.first_check,ch.second_check,ch.delivery_check,ch.surrogate_id,ch.parent_id,c.full_name,c.user
    FROM checkups ch  
    INNER JOIN clients c ON ch.surrogate_id = c.client_id 
    WHERE check_status = 'Pending' || check_status = 'Awaiting second checkup' || check_status = 'Awaiting delivery checkup' || check_status = 'Delivered' ORDER BY ch.schedule_id DESC");
if (mysqli_num_rows($select)> 0) {
    $response['status'] = 1;
    $response['responseData'] = array();
    while ($row = mysqli_fetch_array($select)) {
        $index['checkupID'] = $row['id'];
        $index['scheduleID'] = $row['schedule_id'];
        $index['surrogateID'] = $row['surrogate_id'];
        $index['parentID'] = $row['parent_id'];
        $index['surrogateName'] = $row['full_name'];
        $index['user'] = $row['user'];
        $index['first_check'] = $row['first_check'];
        $index['second_check'] = $row['second_check'];
        $index['delivery_check'] = $row['delivery_check'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = "No Checkup found";
}
print json_encode($response);