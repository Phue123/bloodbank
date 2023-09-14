<?php
include_once __DIR__.'/../controller/hospitalReqController.php';

$id=$_POST['id'];

$hos_con=new hospitalReqController();
$result=$dor_con->getmailTrainee($id);
if($result){
    echo "Success";
}
?>