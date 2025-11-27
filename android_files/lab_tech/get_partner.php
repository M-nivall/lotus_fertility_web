<?php

   include '../../include/connections.php';

   $parentId=$_POST['parentId'];
   $scheduleId=$_POST['scheduleId'];


   $select="SELECT partner_name, partner_contact FROM schedule WHERE schedule_id = '$scheduleId' AND parent_id = '$parentId'";
   $record=mysqli_query($con,$select);

   if(mysqli_num_rows($record)>0){

       $response['status']=1;
       $response['message']="Partner";

       $response['details']=array();
       while($row=mysqli_fetch_array($record)){

           $index['partner_name']=$row['partner_name'];
           $index['partner_contact']=$row['partner_contact'];

           array_push($response['details'],$index);
       }
   }else{
       $response['status']=0;
       $response['message']="No record found";
   }

   echo json_encode($response);

?>