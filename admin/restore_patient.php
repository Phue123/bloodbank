<?php
include_once __DIR__."/../controller/patientReqController.php";
$id=$_POST['id'];
$patient_con=new patientReqController();
$result=$patient_con->getPatient($id);
if($result){
    echo "Success";
}
?>