<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $scheduleId=$_POST['scheduleId'];


     $update="UPDATE pharmacist_assignments SET pre_status = 'Dispensed' WHERE schedule_id='$scheduleId'";
     if(mysqli_query($con,$update)){

         $update="UPDATE schedule SET schedule_status = '8' WHERE schedule_id='$scheduleId'";
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