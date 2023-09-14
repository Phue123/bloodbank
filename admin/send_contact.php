<?php
include_once __DIR__.'/../controller/contactController.php';
$id=$_GET['id'];
$contact_con=new contactController();
$result=$contact_con->mailcontact($id);
if($result)
{
    $message=3;
    echo '<script>location.href="contact.php?status='.$message.'"</script>';
}
?>