<?php
include_once __DIR__."/../controller/hospitalReqController.php";
$id=$_POST['id'];
$hospital_con=new hospitalReqController();
$result=$hospital_con->getHospital($id);
if($result){
    echo "Success";
}
?>