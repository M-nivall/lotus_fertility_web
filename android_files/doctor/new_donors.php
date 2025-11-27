<?php

include '../../include/connections.php';


//creating a query
$select = "SELECT s.donor_id,s.height,s.weight,s.blood_type,s.medication,s.marital_status,s.education,
        s.num_children,s.more_details,s.id_image,s.medical_image,s.photo_image,s.donor_status,c.full_name,
        c.phone_no,c.email,c.address,c.gender,c.date_birth,c.county,c.user,s.role
        FROM egg_donor s
        INNER JOIN clients c ON s.donor_id = c.client_id 
        WHERE c.user='Egg Donor' AND s.donor_status = 'Pending approval'
        ORDER BY s.id DESC";
  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Egg Donors";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['surrogateId'] = $row['donor_id'];
          $temp['height'] = $row['height'];
          $temp['weight'] = $row['weight'];
          $temp['bloodType'] = $row['blood_type'];
          $temp['medication'] = $row['medication'];
          $temp['maritalStatus'] = $row['marital_status'];
          $temp['education'] = $row['education'];
          $temp['numchildren'] = $row['num_children'];
          $temp['moreDetails'] = $row['more_details'];
          $temp['idImage'] = $row['id_image'];
          $temp['medicalImage'] = $row['medical_image'];
          $temp['photoImage'] = $row['photo_image'];
          $temp['surrogateStatus'] = $row['donor_status'];
          $temp['fullName'] = $row['full_name'];
          $temp['phoneNo'] = $row['phone_no'];
          $temp['email'] = $row['email'];
          $temp['gender'] = $row['gender'];
          $temp['dateBirth'] = $row['date_birth'];
          $temp['county'] = $row['county'];
          $temp['gender'] = $row['gender'];
          $temp['role'] = $row['role'];

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing  more found";

}
//displaying the result in json format
echo json_encode($results);

?>