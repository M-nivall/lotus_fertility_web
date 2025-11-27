<?php

include '../../include/connections.php';

//insert

if ($_SERVER['REQUEST_METHOD'] =='POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $select = $_POST['select'];


    if ( empty($username) ||empty($password)) {
        $response["status"] = 0;
        $response["message"] = "Enter both username and password ";
        echo json_encode($response);
        mysqli_close($con);

    } else {

        // check if username already exists

        $select = "SELECT client_id, full_name, username, phone_no, email, status,
       gender, remarks,user FROM clients WHERE username='$username' AND password='$password' AND user='$select'";
        $query = mysqli_query($con, $select);
        if (mysqli_num_rows($query) > 0) {
            while ($row=mysqli_fetch_array($query)){
                if($row['status']=='Pending approval'){
                    $response["status"] = 2;
                    $response["message"] = "Please wait for your account to be approved";
                    echo json_encode($response);
                }elseif ($row['status']=='Rejected'){
                    $response["status"] = 2;
                    $response["message"] = "Account rejected. you can not access your account \n".$row['remarks'];
                    echo json_encode($response);
                }elseif($row['status']=='Approved') {
                    $response['status'] = "1";
                    $response['details'] = array();
                    $response["message"] = "Login successful";
                    $index['clientID']=$row['client_id'];
                    $index['firstname']=$row['full_name'];
                    $index['lastname']=$row['full_name'];
                    $index['username']=$row['username'];
                    $index['phoneNo']=$row['phone_no'];
                    $index['email']=$row['email'];
                    $index['gender']=$row['gender'];
                    $index['user']=$row['user'];
                    array_push($response['details'],$index);
                    echo json_encode($response);
                }
            }
        } else {
            $response["status"] = 0;
            $response["message"] = "Please confirm your username and password";
            echo json_encode($response);
                }
            }
}




