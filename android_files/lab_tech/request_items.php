<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $surrogateId=$_POST['surrogateId'];
     $materials=$_POST['materials'];
     $testID=$_POST['testID'];


     $update="UPDATE medical_test SET lab_equipments = '$materials' WHERE test_id='$testID'";
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