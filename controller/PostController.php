<?php
include_once __DIR__."/../model/post.php";

class PostController extends post{
    public function addpost($title,$date,$desc,$image){

        if($image['error'] == 0)
        {
            $filename = $image['name'];
            $extension = explode('.',$filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $allowed_type = ['jpg','jpeg','svg','png','jfif'];
            $temp_file = $image['tmp_name'];
            if(in_array($filetype,$allowed_type))
            {

                if($filesize <= 2000000)
                {
                    $timestamp = time();
                    $filename = $timestamp.$filename;

                    if(move_uploaded_file($temp_file,'../uploads/'.$filename));
                         return $this->createpost($title,$date,$desc,$filename);
                }
            }
        }
        
    }
    public function getpost(){
        return $this->getpostinfo();
    }
    public function getpostbyid($id){
        return $this->getpostinfobyid($id);
    }

    public function editpost($id,$title,$date,$desc,$image){

        if($image['error'] == 0)
        {
            $filename = $image['name'];
            $extension = explode('.',$filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $allowed_type = ['jpg','jpeg','svg','png','jfif'];
            $temp_file = $image['tmp_name'];
            if(in_array($filetype,$allowed_type))
            {

                if($filesize <= 2000000)
                {
                    $timestamp = time();
                    $filename = $timestamp.$filename;

                    if(move_uploaded_file($temp_file,'../uploads/'.$filename));
                        return $this->updatepost($id,$title,$date,$desc,$filename);
                }
            }
        }
        
    }
        
    public function deletePost($id)
    {
        return $this->deletePostinfo($id);
    } 
        
}
?>