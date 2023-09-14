<?php
include_once __DIR__."/../controller/patientReqController.php";
$id=$_POST['id'];
$patient_con=new patientReqController();
$result=$patient_con->deletepatient_req($id);
if($result){
    // $result1=$hos_con->deletereq($id);
    echo "Success";
}
?>