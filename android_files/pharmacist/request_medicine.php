<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $surrogateId=$_POST['surrogateId'];
     $materials=$_POST['materials'];
     $scheduleId=$_POST['scheduleId'];


     $update="UPDATE pharmacist_assignments SET medicine = '$materials' WHERE schedule_id='$scheduleId'";
     if(mysqli_query($con,$update)){

         $response['status']=1;
         $response['message']='Submitted Succesfully, Awaiting Inventory Approval';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>