<?php

include '../../include/connections.php';


$clientID=$_POST['clientID'];

//creating a query
$select = "SELECT d.donor_status, m.medical_date
        FROM egg_donor d
        INNER JOIN medical_schedule m ON d.donor_id = m.surrogate_id
        WHERE d.donor_id = '$clientID'";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['orders'] = array();
      $results['message']="My Application";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['surrogateStatus'] = $row['donor_status'];
          $temp['medicalDate'] = $row['medical_date'];

          array_push($results['orders'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = " ";

}
//displaying the result in json format
echo json_encode($results);

?>