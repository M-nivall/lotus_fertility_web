<?php

include '../../include/connections.php';


$clientID=$_POST['clientID'];

//creating a query
$select = "SELECT s.schedule_id,s.parent_id,s.surrogate_id,s.partner_name,s.partner_contact,s.schedule_date,
    s.booking_date,s.schedule_status,s.service_fee,s.surrogate_fee,s.total_fee,s.payment_code,c.full_name,s.schedule_type 
    FROM schedule s
    INNER JOIN clients c ON  s.surrogate_id = c.client_id
    WHERE s.parent_id = '$clientID' ORDER BY s.schedule_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['orders'] = array();
      $results['message']="My Schedule";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['schedule_id'] = $row['schedule_id'];
          $temp['surrogate_id'] = $row['surrogate_id'];
          $temp['partner_name'] = $row['partner_name'];
          $temp['partner_contact'] = $row['partner_contact'];
          $temp['schedule_date'] = $row['schedule_date'];
          $temp['booking_date'] = $row['booking_date'];
          $temp['service_fee'] = $row['service_fee'];
          $temp['surrogate_fee'] = $row['surrogate_fee'];
          $temp['total_fee'] = $row['total_fee'];
          $temp['payment_code'] = $row['payment_code'];
          $temp['full_name'] = $row['full_name'];
          $temp['schedule_type'] = $row['schedule_type'];

               if($row['schedule_status']==1){
              $temp['schedule_status'] = "Proceed Attorney";
          }elseif ($row['schedule_status']==2){
              $temp['schedule_status'] = "Pending Attorney";
          }elseif ( $row['schedule_status']==3){
              $temp['schedule_status'] = "Agreement Completed";
          }elseif ($row['schedule_status']==4){
              $temp['schedule_status'] = "Invoice Paid";
          }elseif ($row['schedule_status']==5){
              $temp['schedule_status'] = "Finance Approved";
          }
          elseif ($row['schedule_status']==6){
              $temp['schedule_status'] = "Medical Approved";

          }elseif ($row['schedule_status']==7){
              $temp['schedule_status'] = "Confirm Completion";

          }elseif ($row['schedule_status']==8){
              $temp['schedule_status'] = "Service Completed";
          }elseif ($row['schedule_status']==9){
            $temp['schedule_status'] = "Completed";
        }
          array_push($results['orders'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "No Invoice Found";

}
//displaying the result in json format
echo json_encode($results);



//$today = date('Ymd');
//$startDate = date('Ymd', strtotime('-100 days'));
//$range = $today - $startDate;
//$rand = rand(100, 999);
//echo $rand;
//echo "</br>";
//$random = substr(md5(mt_rand()), 0, 2);
//echo $random;

?>