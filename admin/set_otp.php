<?php
session_start();
include_once __DIR__."/../controller/registerController.php";

$id=$_POST['id'];
$reg_con=new registerController();
$otp_code= rand(100000, 999999);	
    $result=$reg_con->resetotpadmin($id,$otp_code);
    if($result){
        $otpresult=$reg_con->regetotpadmin($id);
        if($otpresult){
          echo "success";
        }
    }
?>