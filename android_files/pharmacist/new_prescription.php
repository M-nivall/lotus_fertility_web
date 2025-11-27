<?php

include '../../include/connections.php';



    $staffID=$_POST['staffID'];

//creating a query
$select = "SELECT p.schedule_id,p.parent_id,p.surrogate_id,p.prescription,p.pre_date,s.partner_name,s.partner_contact,p.schedule_type,p.medicine_status
     

          FROM pharmacist_assignments p
          INNER JOIN schedule s ON p.schedule_id = s.schedule_id
          WHERE p.pre_status = 'Pending' AND s.schedule_status = '7' ORDER BY p.schedule_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Appointments";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['schedule_id'] = $row['schedule_id'];
          $temp['parent_id'] = $row['parent_id'];
          $temp['surrogate_id'] = $row['surrogate_id'];
          $temp['partner_name'] = $row['partner_name'];
          $temp['partner_contact'] = $row['partner_contact'];
          $temp['prescription'] = $row['prescription'];
          $temp['schedule_date'] = $row['pre_date'];
          $temp['schedule_type'] = $row['schedule_type'];
          $temp['medicine_status'] = $row['medicine_status'];

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing found";

}
//displaying the result in json format
echo json_encode($results);

?>