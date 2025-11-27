<?php


require_once '../../include/connections.php';



if ($_SERVER['REQUEST_METHOD'] =='POST'){


    $clientID = $_POST['clientID'];
    $scheduleID = $_POST['scheduleID'];
    $paymentCode = $_POST['paymentCode'];
    $paymentMethod = $_POST['paymentMethod'];

    $payment_date = date("Y-m-d");

    $update=" UPDATE schedule SET schedule_status = 4, payment_code = '$paymentCode' WHERE schedule_id = '$scheduleID'";
    if(mysqli_query($con,$update)){

        $response["status"] = 1;
        $response["message"] ='Payment Sent Successful, Await Finance Approval';

        echo json_encode($response);
        mysqli_close($con);

    }else{

        $response["status"] = 0;
        $response["message"] ='Failed';

        echo json_encode($response);
        mysqli_close($con);

    }
}
?>



