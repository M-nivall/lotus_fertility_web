<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $parentId=$_POST['parentId'];
     $scheduleId=$_POST['scheduleId'];
     $comments=$_POST['comments'];


     $update="UPDATE schedule SET schedule_status = '6' WHERE schedule_id='$scheduleId'";
     if(mysqli_query($con,$update)){

         $update="UPDATE medical_test SET test_status = 'Approved', test_comments = '$comments' 
         WHERE schedule_id='$scheduleId' AND parent_id = '$parentId'";
         mysqli_query($con,$update);

         $response['status']=1;
         $response['message']='Submited Successfully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>