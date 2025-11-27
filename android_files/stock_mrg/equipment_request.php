<?php


include '../../include/connections.php';


$select="SELECT * FROM medical_test m 
    INNER JOIN employees e ON m.emp_id = e.emp_id
    WHERE m.equipment_status = 'Pending'
    ORDER BY m.test_id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Equipment Requests';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["test_id"];
    $index["name"]=$row["f_name"]." ".$row["l_name"];
    $index["phoneNo"]=$row["contact"];
    $index["items"]=$row["lab_equipments"];
    $index["requestStatus"]=$row["equipment_status"];
    $index["requestDate"]=date('Y-m-d');
    $index["amount"]=$row["surrogate_id"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Nothing more found';
}
echo json_encode($response);
