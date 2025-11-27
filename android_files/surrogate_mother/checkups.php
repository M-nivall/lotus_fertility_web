<?php

include '../../include/connections.php';


$clientID=$_POST['clientID'];

//creating a query
$select = "SELECT id,schedule_id,parent_id,first_check,second_check,delivery_check,check_status
        FROM checkups
        WHERE surrogate_id = '$clientID'";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['orders'] = array();
      $results['message']="Checkups";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['checkID'] = $row['id'];
          $temp['scheduleID'] = $row['schedule_id'];
          $temp['parentID'] = $row['parent_id'];
          $temp['first_check'] = $row['first_check'];
          $temp['second_check'] = $row['second_check'];
          $temp['delivery_check'] = $row['delivery_check'];
          $temp['check_status'] = $row['check_status'];

          array_push($results['orders'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "";

}
//displaying the result in json format
echo json_encode($results);

?>