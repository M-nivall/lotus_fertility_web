<?php


include '../../include/connections.php';

$select="SELECT * FROM medicine";
$query=mysqli_query($con,$select);


  if(mysqli_num_rows($query)>0){
      $response['status']=1;
      $response['message']="Stock";
      $response['details']=array();

      while ($row=mysqli_fetch_array($query)){
          $index['stockID']=$row['med_id'];
          $index['productName']=$row['med_name'];
          $index['price']=$row['quantity'];
          $index['stock']=$row['quantity'];

          array_push($response['details'],$index);
      }
      echo json_encode($response);
  }
  ?>