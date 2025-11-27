<?php


include '../../include/connections.php';

$select="SELECT * FROM destinations";
$query=mysqli_query($con,$select);


  if(mysqli_num_rows($query)>0){
      $response['status']=1;
      $response['message']="Stock";
      $response['details']=array();

      while ($row=mysqli_fetch_array($query)){
          $index['destinationID']=$row['destination_id'];
          $index['destination']=$row['destination'];
          $index['price']=$row['price'];

          array_push($response['details'],$index);
      }
      echo json_encode($response);
  }
  ?>