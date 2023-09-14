<?php
include_once __DIR__."/../controller/PostController.php";
$id=$_POST['id'];
$post_con=new PostController();
$result=$post_con->deletePost($id);
if($result)
{
    echo "success";
}
?>