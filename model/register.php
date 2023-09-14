<?php

include_once __DIR__."/../vendor/db/db.php";

class Register{
    public function setuserinfo($name,$email,$password,$comfirm_password,$otp_code){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into user(Name,Email,Password,Cpassword,otp_code) VALUES(:name,:email,:password,:cpassword,:otp_code)";
        $statement=$con->prepare($sql);
        $statement->BindParam('name',$name);
        $statement->BindParam('email',$email);
        $statement->BindParam('password',$password);
        $statement->BindParam('cpassword',$comfirm_password);
        $statement->bindParam('otp_code',$otp_code);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getotpbyemail($email){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where Email=:email";
        $statement=$con->prepare($sql);
        $statement->BindParam('email',$email);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function getuserinfobyid($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function resetotpinfo($id,$otp_code){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="Update user set otp_code=:otp_code where Id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam(':id',$id);
        $statement->BindParam(':otp_code',$otp_code);
        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getotpbyid($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where Id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function setuserinfoadmin($name,$email,$password,$comfirm_password,$otp_code){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into user(Name,Email,Password,Cpassword,otp_code,role) VALUES(:name,:email,:password,:cpassword,:otp_code,1)";
        $statement=$con->prepare($sql);
        $statement->BindParam('name',$name);
        $statement->BindParam('email',$email);
        $statement->BindParam('password',$password);
        $statement->BindParam('cpassword',$comfirm_password);
        $statement->bindParam('otp_code',$otp_code);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getotpbyemailadmin($email){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where Email=:email";
        $statement=$con->prepare($sql);
        $statement->BindParam('email',$email);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function getuserinfobyidadmin($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function resetotpinfoadmin($id,$otp_code){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="Update user set otp_code=:otp_code where Id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam(':id',$id);
        $statement->BindParam(':otp_code',$otp_code);
        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getotpbyidadmin($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where Id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function countregister(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select count(Id) as count from user";
        $statement=$con->prepare($sql);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

}
?>