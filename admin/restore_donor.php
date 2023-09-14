<?php
include_once __DIR__."/../controller/donorController.php";
$id=$_POST['id'];
$donor_con=new donarController();
$result=$donor_con->restoreDonor($id);
if($result){
    echo "Success";
}
?>