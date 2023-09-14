<?php
include_once __DIR__.'/../vendor/db/db.php';

class bloodstock{
    public function getbloodinfo(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT *,bloodtype.BloodType as blood,user.Name as dname
        from bloodstock join bloodtype join user join donor join donor_req
        where bloodstock.BloodType_Id=bloodtype.Id
        and bloodstock.Donor_Id=donor.Id
        and donor.Donor_req_Id=donor_req.Id
        and donor_req.User_Id=user.Id
        and bloodstock.deleted_at=0";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getbloodinfoother(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT *,bloodtype.BloodType as blood,others.Name as other,others.Address as address,others.NRC as nrc
        from bloodstock join bloodtype join others
        where bloodstock.BloodType_Id=bloodtype.Id
        -- and bloodstock.Donor_Id=donor.Id
        -- and donor.Donor_req_Id=donor_req.Id
        and bloodstock.Others_Id=others.Id
        and bloodstock.deleted_at=0";
        // -- and donor_req.User_Id=user.Id";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getblood(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT * from bloodtype";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getnoofbloods(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT bloodtype.BloodType as bloodtype,count(bloodtype_Id) as total
        from bloodstock join bloodtype 
        WHERE bloodstock.BloodType_Id=bloodtype.Id
        and bloodstock.deleted_at=0 
        GROUP BY BloodType_Id";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function addbloodstockinfo($bcode,$description,$ddate,$bloodtype,$donarid){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into bloodstock(Code,Description,Date,BloodType_Id,Donor_Id) values(:code,:desp,:date,:bloodtype,:donarid)";
        $statement=$con->prepare($sql);
        $statement->bindParam('code',$bcode);
        $statement->bindParam('desp',$description);
        $statement->bindParam('date',$ddate);
        $statement->bindParam('bloodtype',$bloodtype);
        $statement->bindParam('donarid',$donarid);
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getbsbybloods($bid){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT bloodtype.BloodType as bloodtype,bloodstock.Code as code,bloodstock.Id as bsid
        from bloodstock join bloodtype 
        WHERE bloodstock.BloodType_Id=bloodtype.Id
        and bloodstock.BloodType_Id=:id
        and bloodstock.deleted_at=0";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$bid);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function addbloodstockbybsshos($rid,$bsid,$date){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT INTO `donation`(`ReqDetail_Id`, `BloodStock_Id`, `Date`) VALUES (:rid,:bsid,:date)";
        $statement=$con->prepare($sql);
        $statement->bindParam('rid',$rid);
        $statement->bindParam('bsid',$bsid);
        $statement->bindParam('date',$date);
        
        if($statement->execute()){
           return true;
        }
    }


    public function addbloodstockbybss($rid,$bsid,$date,$fee){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT INTO `donation`(`ReqDetail_Id`, `BloodStock_Id`, `Date`,`Fee`) VALUES (:rid,:bsid,:date,:fee)";
        $statement=$con->prepare($sql);
        $statement->bindParam('rid',$rid);
        $statement->bindParam('bsid',$bsid);
        $statement->bindParam('date',$date);
        $statement->bindParam('fee',$fee);
        
        if($statement->execute()){
           return true;
        }
    }

    public function deletebloods($bsid){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE bloodstock set deleted_at=1 where Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$bsid);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function countbloodstock(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select count(Id) as count from bloodstock where deleted_at=0";
        $statement=$con->prepare($sql);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }
}
?>