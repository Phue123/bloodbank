<?php 
include_once __DIR__."/controller/hospitalReqController.php";

$id=$_POST['id'];
$hos_con=new hospitalReqController();
$result=$hos_con->checkStock($id);
echo json_encode($result);
?>