<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $scheduleID=$_POST['scheduleID'];
     $third_remark=$_POST['third_remark'];
     $delivery_check=$_POST['delivery_check'];

     $update="UPDATE checkups SET check_status = 'Delivered' WHERE schedule_id='$scheduleID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO third_checkup ( schedule_id, remark, check_date)VALUES ('$scheduleID','$third_remark', '$delivery_check')";
         mysqli_query($con,$insert);

         $update1="UPDATE schedule SET schedule_status = '8' WHERE schedule_id='$scheduleID'";
         mysqli_query($con,$update1);

         $response['status']=1;
         $response['message']='Submitted Succefully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>