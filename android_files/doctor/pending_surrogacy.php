<?php

include '../../include/connections.php';


//creating a query
$select = "SELECT s.schedule_id,s.parent_id,s.surrogate_id,s.partner_name,s.partner_contact,s.schedule_date,s.booking_date,s.schedule_type,
    -- Parent Details
    parent.full_name AS parent_name,
    parent.phone_no AS parent_phone,
    parent.email AS parent_email,

    -- Surrogate Details
    surrogate.full_name AS surrogate_name,
    surrogate.phone_no AS surrogate_phone,
    surrogate.email AS surrogate_email

        FROM schedule s
        INNER JOIN clients parent ON s.parent_id = parent.client_id  AND parent.user = 'Intended Parents' 
        INNER JOIN clients surrogate ON s.surrogate_id = surrogate.client_id AND (surrogate.user = 'Surrogate Mother' OR surrogate.user = 'Egg Donor')
        INNER JOIN medical_test m ON s.schedule_id = m.schedule_id
        WHERE s.schedule_status = '6' AND m.test_status = 'Approved'
        ORDER BY s.schedule_id DESC";
  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Approved Surrogacy";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['schedule_id'] = $row['schedule_id'];
          $temp['schedule_type'] = $row['schedule_type'];
          $temp['parent_id'] = $row['parent_id'];
          $temp['surrogate_id'] = $row['surrogate_id'];
          $temp['partner_name'] = $row['partner_name'];
          $temp['partner_contact'] = $row['partner_contact'];
          $temp['schedule_date'] = $row['schedule_date'];
          $temp['booking_date'] = $row['booking_date'];
          $temp['parent_name'] = $row['parent_name'];
          $temp['parent_phone'] = $row['parent_phone'];
          $temp['parent_email'] = $row['parent_email'];
          $temp['surrogate_name'] = $row['surrogate_name'];
          $temp['surrogate_phone'] = $row['surrogate_phone'];
          $temp['surrogate_email'] = $row['surrogate_email'];

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing  more found";

}
//displaying the result in json format
echo json_encode($results);

?>