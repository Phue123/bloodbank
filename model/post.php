<?php
include_once __DIR__.'/../vendor/db/db.php';
class post{
    public function createpost($title,$date,$desc,$filename){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $sql="INSERT into post(Title,Date,Description,Image) value(:title,:date,:desc,:image)";
        $statement=$con->prepare($sql);
        $statement->bindParam('title',$title);
        $statement->bindParam('date',$date);
        $statement->bindParam('desc',$desc);
        $statement->bindParam('image',$filename);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function getpostinfo(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from post ";
        $statement=$con->prepare($sql);
       

        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getpostinfobyid($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from post where Id=:id";
        $statement=$con->prepare($sql);
       $statement->BindParam('id',$id);

        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function updatepost($id,$title,$date,$desc,$filename)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="Update post set Title=:Title,Date=:Date,Description=:Description,Image=:Image where Id=:id ";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        $statement->bindParam('Title',$title);
        $statement->bindParam('Date',$date);
        $statement->bindParam('Description',$desc);
        $statement->bindParam('Image',$filename);
        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function deletePostinfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="delete from post where id=:id ";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>