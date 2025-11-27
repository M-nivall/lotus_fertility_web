<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $schedule_id=$_POST['schedule_id'];
     $surrogate_id=$_POST['surrogate_id'];
     $parent_id=$_POST['parent_id'];
     $username=$_POST['username'];
     $schedule_type=$_POST['schedule_type'];

     $select="SELECT * FROM employees WHERE username='$username'";
     $query=mysqli_query($con,$select);
     $row=mysqli_fetch_array($query);

     $empID=$row['emp_id'];

     $update="UPDATE schedule SET schedule_status = '5' WHERE schedule_id='$schedule_id'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO medical_test ( schedule_id, surrogate_id, parent_id, emp_id, schedule_type)VALUES ('$schedule_id','$surrogate_id','$parent_id','$empID', '$schedule_type')";
         mysqli_query($con,$insert);

         $response['status']=1;
         $response['message']='Assigned Succefully, Awaiting Approval';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>