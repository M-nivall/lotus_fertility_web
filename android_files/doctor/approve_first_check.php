<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $scheduleID=$_POST['scheduleID'];
     $first_remark=$_POST['first_remark'];
     $first_check=$_POST['first_check'];

     $update="UPDATE checkups SET check_status = 'Awaiting second checkup' WHERE schedule_id='$scheduleID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO first_checkup ( schedule_id, remark, check_date)VALUES ('$scheduleID','$first_remark', '$first_check')";
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