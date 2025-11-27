<?php

include '../../include/connections.php';

//insert

if ($_SERVER['REQUEST_METHOD'] =='POST') {

    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $gender = $_POST['selectedGender'];
    $role = $_POST['role'];
    $phoneNumber = $_POST['phoneNumber'];
    $date_birth = $_POST['dob'];
    $county = $_POST['county'];
    $town = $_POST['town'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (empty($fullName) || empty($email) || empty($gender) || empty($phoneNumber) || empty($date_birth) || empty($county) 
    || empty($town) || empty($address) || empty($username) || empty($password) || empty($role)) {
        $response["status"] = 0;
        $response["message"] = "Some details are missing ";
        echo json_encode($response);
        mysqli_close($con);

    } else {

        // check if username already exists

        $select = "SELECT username FROM clients WHERE username='$username'";
        $query = mysqli_query($con, $select);
        if (mysqli_num_rows($query) > 0) {

            $response["status"] = 0;
            $response["message"] = "Username is registered with another account";
            echo json_encode($response);

        } else {

            $select = "SELECT phone_no FROM clients WHERE phone_no='$phoneNumber'";
            $query = mysqli_query($con, $select);
            if (mysqli_num_rows($query) > 0) {

                $response["status"] = 0;
                $response["message"] = "Phone number is registered with another account";
                echo json_encode($response);

            } else {
                $select = "SELECT email FROM clients WHERE email='$email'";
                $query = mysqli_query($con, $select);
                if (mysqli_num_rows($query) > 0) {

                    $response["status"] = 0;
                    $response["message"] = "Email is registered with another account";
                    echo json_encode($response);

                } else {

                    $insert = "INSERT INTO clients(full_name, username, phone_no, email,password,gender,user,date_birth,county,town,address)
                VALUES ('$fullName','$username','$phoneNumber','$email','$password','$gender','$role','$date_birth','$county','$town','$address')";
                    if (mysqli_query($con, $insert)) {

                        $response["status"] = 1;
                        $response["message"] = "You have successfully registered";

                        echo json_encode($response);
//                    mysqli_close($con);

                    } else {

                        $response["status"] = 0;
                        $response["message"] = " Something went wong please try again";

                        echo json_encode($response);
//                    mysqli_close($con);
                    }

                }
            }
        }
    }
}




