<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$id=$_POST['requestID'];
$item_type=$_POST['item_type'];


if ($item_type === 'equipment') {


$update="UPDATE  request SET request_status='Supply Confirmed' WHERE id = '$id' ";

$sel="SELECT quantity,payment_description FROM supply_payment  WHERE request_id='$id' ";
          $qury=mysqli_query($con,$sel);
          $rowC=mysqli_fetch_array($qury);
           $quantity= $rowC['quantity'];
           $payment_description= $rowC['payment_description'];

$sel2="SELECT quantity FROM equipments  WHERE equipment_name='$payment_description'";
          $qury2=mysqli_query($con,$sel2);
          $rowD=mysqli_fetch_array($qury2);
         $quantity2= $rowD['quantity'];

         $totalstock = $quantity +  $quantity2;
           

$update1="UPDATE equipments SET quantity =$totalstock WHERE equipment_name='$payment_description'";
    mysqli_query($con,$update1);

//$update2="UPDATE request SET request_status='Paid' WHERE id='$id'";
 //   mysqli_query($con,$update2);
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Confirmed Stock Has Been Recieved and Updated SuccessFully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
//dont exceed here
} else {
    $update="UPDATE  request SET request_status='Supply Confirmed' WHERE id = '$id' ";

$sel="SELECT quantity,payment_description FROM supply_payment  WHERE request_id='$id' ";
          $qury=mysqli_query($con,$sel);
          $rowC=mysqli_fetch_array($qury);
           $quantity= $rowC['quantity'];
           $payment_description= $rowC['payment_description'];

$sel2="SELECT quantity FROM medicine  WHERE med_name='$payment_description'";
          $qury2=mysqli_query($con,$sel2);
          $rowD=mysqli_fetch_array($qury2);
         $quantity2= $rowD['quantity'];

         $totalstock = $quantity +  $quantity2;
           

$update1="UPDATE medicine SET quantity =$totalstock WHERE med_name='$payment_description'";
    mysqli_query($con,$update1);

//$update2="UPDATE request SET request_status='Paid' WHERE id='$id'";
 //   mysqli_query($con,$update2);
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Confirmed Stock Has Been Recieved and Updated SuccessFully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
}
?>