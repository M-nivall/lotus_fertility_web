<?php

   include '../../include/connections.php';

   $parentId=$_POST['parentId'];


   $select="SELECT full_name, phone_no, email FROM clients WHERE user='Intended Parents' AND client_id = '$parentId'";
   $record=mysqli_query($con,$select);

   if(mysqli_num_rows($record)>0){

       $response['status']=1;
       $response['message']="Parents";

       $response['details']=array();
       while($row=mysqli_fetch_array($record)){

           $index['full_name']=$row['full_name'];
           $index['phone_no']=$row['phone_no'];
           $index['email']=$row['email'];

           array_push($response['details'],$index);
       }
   }else{
       $response['status']=0;
       $response['message']="No record found";
   }

   echo json_encode($response);

?>