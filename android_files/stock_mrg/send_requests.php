<?php


include '../../include/connections.php';

$username=$_POST['username'];
$items=$_POST['items'];
$quantity=$_POST['quantity'];
$item_type=$_POST['item_type'];

  $select="SELECT * FROM employees WHERE username='$username'";
  $query=mysqli_query($con,$select);
  $row=mysqli_fetch_array($query);
  $id=$row["emp_id"];

   $insert="INSERT INTO request(emp_id, items,quantity, item_type)VALUES ('$id','$items','$quantity', '$item_type')";
  if(mysqli_query($con,$insert)){
    $response['status']=1;
    $response['message']='Submitted successfully';
    }else{
    $response['status']=0;
    $response['message']='Please try again. Something went wrong';
  }
echo json_encode($response);
