<?php


include '../../include/connections.php';


$select="SELECT * FROM pharmacist_assignments WHERE medicine_status = 'Pending' ORDER BY id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Equipment Requests';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["id"];
    $index["name"]="Vivan Wahome";
    $index["phoneNo"]="0745679842";
    $index["items"]=$row["medicine"];
    $index["requestStatus"]=$row["medicine_status"];
    $index["requestDate"]=date('Y-m-d');
    $index["amount"]=$row["id"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Nothing more found';
}
echo json_encode($response);
