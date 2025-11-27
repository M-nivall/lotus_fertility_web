<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $schedule_id=$_POST['schedule_id'];
     $parent_id=$_POST['parent_id'];
     $surrogate_id=$_POST['surrogate_id'];
     $prescription=$_POST['prescription'];
     $schedule_type=$_POST['schedule_type'];
     $first_check=$_POST['first_check'];
     $second_check=$_POST['second_check'];
     $delivery_check=$_POST['delivery_check'];

     $update="UPDATE schedule SET schedule_status = '7' WHERE schedule_id='$schedule_id'";
     if(mysqli_query($con,$update)){

        $date = date('Y-m-d');

         $insert="INSERT INTO pharmacist_assignments ( schedule_id, prescription, pre_date, parent_id, surrogate_id, schedule_type)VALUES ('$schedule_id','$prescription', '$date', '$parent_id', '$surrogate_id', '$schedule_type')";
         mysqli_query($con,$insert);

         
         $insert1="INSERT INTO checkups ( schedule_id, surrogate_id, parent_id, first_check, second_check, delivery_check)VALUES ('$schedule_id','$surrogate_id', '$parent_id', '$first_check', '$second_check', '$delivery_check')";
         mysqli_query($con,$insert1);

         $response['status']=1;
         $response['message']='Submitted Succefully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>