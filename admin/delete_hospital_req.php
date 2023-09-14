<?php
include_once __DIR__."/../controller/hospitalReqController.php";
$id=$_POST['id'];
$hos_con=new hospitalReqController();
$result=$hos_con->deletehospital_req($id);
if($result){
    echo "Success";
}
?>