<?php

include '../../include/connections.php';



    $staffID=$_POST['staffID'];

//creating a query
$select = "SELECT test_id,schedule_id,surrogate_id,parent_id,test_status,schedule_type,equipment_status
          FROM medical_test
          WHERE test_status = 'Pending test' AND emp_id='$staffID' ORDER BY test_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Fertility Test";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['test_id'] = $row['test_id'];
          $temp['schedule_id'] = $row['schedule_id'];
          $temp['surrogate_id'] = $row['surrogate_id'];
          $temp['parent_id'] = $row['parent_id'];
          $temp['test_status'] = $row['test_status'];
          $temp['schedule_type'] = $row['schedule_type'];
          $temp['equipment_status'] = $row['equipment_status'];

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing found";

}
//displaying the result in json format
echo json_encode($results);

?>