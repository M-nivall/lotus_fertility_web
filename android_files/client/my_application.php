<?php

include '../../include/connections.php';


$clientID=$_POST['clientID'];

//creating a query
$select = "SELECT s.surrogate_status, m.medical_date
        FROM surrogate_mother s
        INNER JOIN medical_schedule m ON s.surrogate_id = m.surrogate_id
        WHERE s.surrogate_id = '$clientID'";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['orders'] = array();
      $results['message']="My Application";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['surrogateStatus'] = $row['surrogate_status'];
          $temp['medicalDate'] = $row['medical_date'];

          array_push($results['orders'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "";

}
//displaying the result in json format
echo json_encode($results);

?>