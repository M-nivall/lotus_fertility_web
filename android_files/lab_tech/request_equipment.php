<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $surrogateId=$_POST['surrogateId'];
     $materials=$_POST['materials'];
     $scheduleID=$_POST['scheduleID'];


     $update="UPDATE medical_schedule SET lab_equipments = '$materials' WHERE id='$scheduleID'";
     if(mysqli_query($con,$update)){

         $response['status']=1;
         $response['message']='Equipments Submitted Succesfully, Awaiting Inventory Approval';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>