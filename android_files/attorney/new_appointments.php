<?php

include '../../include/connections.php';



    $staffID=$_POST['staffID'];

//creating a query
$select = "SELECT a.id,a.schedule_id,a.parent_id,a.surrogate_id,s.partner_name,s.partner_contact,s.schedule_date,s.schedule_type,
     
    -- Parent Details
    parent.full_name AS parent_name,
    parent.phone_no AS parent_phone,
    parent.email AS parent_email,

        -- Surrogate Details
    surrogate.full_name AS surrogate_name,
    surrogate.phone_no AS surrogate_phone,
    surrogate.email AS surrogate_email

          FROM attorney_assignments a
          INNER JOIN schedule s ON a.schedule_id = s.schedule_id
          INNER JOIN clients parent ON a.parent_id = parent.client_id  AND parent.user = 'Intended Parents' 
          INNER JOIN clients surrogate ON a.surrogate_id = surrogate.client_id AND (surrogate.user = 'Surrogate Mother' OR surrogate.user = 'Egg Donor')
          WHERE a.assign_status = 'Pending' AND a.emp_id='$staffID' ORDER BY a.id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Appointments";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['id'] = $row['id'];
          $temp['schedule_id'] = $row['schedule_id'];
          $temp['parent_id'] = $row['parent_id'];
          $temp['surrogate_id'] = $row['surrogate_id'];
          $temp['partner_name'] = $row['partner_name'];
          $temp['partner_contact'] = $row['partner_contact'];
          $temp['schedule_date'] = $row['schedule_date'];
          $temp['parent_name'] = $row['parent_name'];
          $temp['parent_phone'] = $row['parent_phone'];
          $temp['parent_email'] = $row['parent_email'];
          $temp['surrogate_name'] = $row['surrogate_name'];
          $temp['surrogate_phone'] = $row['surrogate_phone'];
          $temp['surrogate_email'] = $row['surrogate_email'];
          $temp['schedule_type'] = $row['schedule_type'];

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing found";

}
//displaying the result in json format
echo json_encode($results);

?>