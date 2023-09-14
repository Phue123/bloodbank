<?php
include_once __DIR__.'/../vendor/db/db.php';

class contact{
    public function createcontact($name,$email,$phone,$message){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $sql="INSERT into recommand(name,email,PhNo,Content) value(:name,:email,:phone,:message)";
        $statement=$con->prepare($sql);
        $statement->bindParam('name',$name);
        $statement->bindParam('email',$email);
        $statement->bindParam('phone',$phone);
        $statement->bindParam('message',$message);
     
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function getcontactinfo(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from recommand";
        $statement=$con->prepare($sql);

        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getMail($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from recommand where id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        

        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function setEmail($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="Update recommand set Email_Status=1 where id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);

        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }

    }
}
?>