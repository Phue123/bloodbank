<?php
include_once __DIR__."/../controller/donorController.php";
$id=$_POST['id'];
$donar_req=new donarController();
$result=$donar_req->deletedonar_req($id);
if($result){
    echo "Success";
}
?>