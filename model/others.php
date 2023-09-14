<?php
include_once __DIR__.'/../vendor/db/db.php';

class others{
    public function createotherdonor($name,$phone,$nrc,$address,$bloodtype,$remark,$date){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into others(Name,PhNo,NRC,Address,Bloodtype_Id,Remark,Date) values(:name,:phone,:nrc,:address,:bloodtype,:remark,:date)";
        $statement=$con->prepare($sql);
        $statement->bindParam('name',$name);
        $statement->bindParam('phone',$phone);
        $statement->bindParam('nrc',$nrc);
        $statement->bindParam('address',$address);
        $statement->bindParam('bloodtype',$bloodtype);
        $statement->bindParam('remark',$remark);
        $statement->bindParam('date',$date);

        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function addothersinfo($code,$description,$date,$bloodtype,$others){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into bloodstock(Code,Description,Date,BloodType_Id,Others_Id) values(:code,:description,:date,:bloodtype,:others)";
        $statement=$con->prepare($sql);
        $statement->bindParam('code',$code);
        $statement->bindParam('description',$description);
        $statement->bindParam('date',$date);
        $statement->bindParam('bloodtype',$bloodtype);
        $statement->bindParam('others',$others);
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getothers(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT others.Id as Id,others.Name as Name,bloodtype.BloodType as btype
        from others join bloodtype 
        where DATE_ADD(others.Date,INTERVAL 4 MONTH) < CURRENT_DATE
        and others.BloodType_Id=bloodtype.Id";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getothersidinfo($nrc){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT others.Id as Id,others.Name as Name,others.Date as Date,others.BloodType_ID as bid,bloodtype.BloodType as btype,month(max(others.Date)) as oDate
        from others join bloodtype 
        where others.NRC=:nrc
        and others.BloodType_Id=bloodtype.Id";
        $statement=$con->prepare($sql);
        $statement->bindParam('nrc',$nrc);
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }   
    }

    public function getcountOther(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT count(Id) as total from others";
        $statement=$con->prepare($sql);
       
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

}
?>