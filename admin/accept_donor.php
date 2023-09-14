<?php
include_once __DIR__.'/../controller/donorController.php';

$id=$_GET['id'];

$dor_con=new donarController();
$result=$dor_con->getmailTrainee($id);
if($result){
    $message=3;
    echo '<script>location.href="donor_req.php?status='.$message.'"</script>';
}
?>