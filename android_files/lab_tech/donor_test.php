<?php

include '../../include/connections.php';



    $staffID=$_POST['staffID'];

//creating a query
$select = "SELECT m.id,m.surrogate_id,m.medical_date,m.schedule_status,e.blood_type,e.medication,c.full_name,
          c.phone_no,c.email,m.user,m.equipment_status
          FROM medical_schedule m 
          INNER JOIN egg_donor e ON m.surrogate_id = e.donor_id
          RIGHT JOIN clients c on m.surrogate_id = c.client_id  
          WHERE m.schedule_status = 'Pending' AND m.emp_id='$staffID' AND m.user = 'egg_donor' ORDER BY m.id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Order to ship";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['surrogateId'] = $row['surrogate_id'];
          $temp['medicalDate'] = $row['medical_date'];
          $temp['scheduleStatus'] = $row['schedule_status'];
          $temp['bloodGroup'] = $row['blood_type'];
          $temp['medication'] = $row['medication'];
          $temp['fullName'] = $row['full_name'];
          $temp['phoneNo'] = $row['phone_no'];
          $temp['email'] = $row['email'];
          $temp['user'] = $row['user'];
          $temp['equipment_status'] = $row['equipment_status'];
          $temp['scheduleID'] = $row['id'];


          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing found";

}
//displaying the result in json format
echo json_encode($results);

?>