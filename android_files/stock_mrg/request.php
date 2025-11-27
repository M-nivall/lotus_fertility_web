<?php


include '../../include/connections.php';


$select="SELECT * FROM request r INNER JOIN employees e ON r.emp_id = e.emp_id
    WHERE r.request_status IN ('Pending approval', 'Invoice sent')
    ORDER BY r.id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["id"];
    $index["name"]=$row["f_name"]." ".$row["l_name"];
    $index["phoneNo"]=$row["contact"];
    $index["items"]=$row["items"];
    $index["requestStatus"]=$row["request_status"];
    $index["requestDate"]=$row["request_date"];
    $index["amount"]=$row["amount"];
    $index["quantity"]=$row["quantity"];
    $index["item_type"]=$row["item_type"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Nothing Found ,Please Request Stock';
}
echo json_encode($response);
