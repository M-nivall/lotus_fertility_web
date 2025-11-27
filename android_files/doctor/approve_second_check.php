<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $scheduleID=$_POST['scheduleID'];
     $second_remark=$_POST['second_remark'];
     $second_check=$_POST['second_check'];

     $update="UPDATE checkups SET check_status = 'Awaiting delivery checkup' WHERE schedule_id='$scheduleID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO second_checkup ( schedule_id, remark, check_date)VALUES ('$scheduleID','$second_remark', '$second_check')";
         mysqli_query($con,$insert);

         $response['status']=1;
         $response['message']='Submitted Succefully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>