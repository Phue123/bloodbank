<?php
include_once __DIR__."/../vendor/db/db.php";

class donar{
    public function getdonarinfobydonar(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT User.name as name,User.email as email,donor_req.PhNo as phone,donor_req.Address as address,bloodtype.BloodType as bloodtype,donor.Date as date,donor_req.Weight as lb
        from donor join donor_req join User join bloodtype
        where donor_req.User_Id=User.Id
        and donor.Donor_req_Id=donor_req.Id
        and donor_req.BloodType_Id=bloodtype.Id";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getalldonarinfo(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT deleted_at,donor_req.Id as Id,bloodtype.BloodType as bloodtype,User.Name as name,User.Email as email,donor_req.Address as address,donor_req.PhNo as phno,donor_req.Weight as lb,donor_req.Status as status,donor_req.Email_Status as email_status
        from donor_req join User join bloodtype
        where donor_req.User_Id=User.Id
        and donor_req.BloodType_Id=bloodtype.Id";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    

    public function adddonarinfo($lid,$phone,$address,$lb,$bloodtype){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into donor_req(User_Id,Address,PhNo,Weight,BloodType_Id) value(:lid,:address,:phone,:weight,:bloodtype)";
        $statement=$con->prepare($sql);
        $statement->bindParam('lid',$lid);
        $statement->bindParam('phone',$phone);
        $statement->bindParam('address',$address);
        $statement->bindParam('bloodtype',$bloodtype);
        $statement->bindParam('weight',$lb);
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getdonar_reqsinfo($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donor_req.Id as Id,user.name as name,user.email as email,donor_req.PhNo as phone,donor_req.Address as address,bloodtype.BloodType as bloodtype
        from donor_req join user join bloodtype
        where donor_req.User_Id=user.Id
        and donor_req.BloodType_Id=bloodtype.Id
        and donor_req.Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getdonarinfo($lid){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donor.Id as Id,User.name as name,User.email as email,donor_req.PhNo as phone,donor_req.Address as address,bloodtype.BloodType as bloodtype,donor.Date as date
        from donor join donor_req join User join bloodtype
        where donor_req.User_Id=user.Id
        and donor_req.BloodType_Id=bloodtype.Id
        and donor.Donor_req_Id=donor_req.Id
        and donor_req.User_Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$lid);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function restatusinfo($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE donor_req set Status=1 where donor_req.Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        
        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function adddonarinfos($accept_id,$date,$remark){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT into donor(Donor_Req_Id,Date,Remark) value(:accept_id,:date,:remark)";
        $statement=$con->prepare($sql);
        $statement->bindParam('accept_id',$accept_id);
        $statement->bindParam('date',$date);
        $statement->bindParam('remark',$remark);
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getdonarinfobyacceptid($accept_id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donor.Id as id,donor.Date as Date,donor_req.BloodType_Id as blood
        from donor join donor_req
        where donor.Donor_req_Id=donor_req.Id
        and donor.Donor_req_Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$accept_id);
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    

    public function deletedonar_reqinfo($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // $sql="DELETE from donor_req where Id=:id";
        $sql="UPDATE donor_req SET deleted_at=1 where Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getdonorreqsinfo($lid){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donor_req.Id as Id,month(max(donor.Date)) as Date,bloodtype.bloodType as bloodtype
        from donor_req join user join bloodtype join donor
        where donor_req.User_Id=user.Id
        and donor_req.BloodType_Id=bloodtype.Id
        and donor_req.Id=donor.Donor_req_Id
        and donor_req.User_Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$lid);
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getdonorbloodinfo($lid){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT bloodtype.Id as Id,bloodtype.bloodType as bloodtype
        from donor_req join user join bloodtype
        where donor_req.User_Id=user.Id
        and donor_req.BloodType_Id=bloodtype.Id
        and donor_req.User_Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$lid);
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function countdonors(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT count(Id) as total from donor";
        $statement=$con->prepare($sql);
       
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }


    public function getmail($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donor_req.Id as Id,bloodtype.bloodType as bloodtype,user.Name as name,user.Email as Email
        from donor_req join user join bloodtype
        where donor_req.User_Id=user.Id
        and donor_req.BloodType_Id=bloodtype.Id
        and donor_req.Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function setEmailDetails($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="Update donor_req set Email_Status=1 where Id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);

        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getdonortrashinfo(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT
        donor_req.deleted_at,
        donor_req.Id AS Id,
        USER.Name AS NAME,
        USER.Email AS email,
        donor_req.Address AS address,
        donor_req.PhNo AS phno,
        donor_req.Weight AS lb,
        donor_req.Status AS STATUS,
        donor_req.Email_Status AS email_status
    FROM
        donor_req
    JOIN USER ON donor_req.User_Id = USER.Id
    WHERE
        donor_req.deleted_at = 1;
    ";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function restoreDonors($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="Update donor_req set deleted_at=0 where Id=:id";
        $statement=$con->prepare($sql);
        $statement->BindParam('id',$id);

        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function clearTrash(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="DELETE from donor_req where deleted_at=1";
        $statement = $con->prepare($sql);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function donor_req(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) AS total_count FROM donor_req WHERE deleted_at = 0 and Status=0";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }


    public function countdonorsbyreport(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select count(Id) as count from donor";
        $statement=$con->prepare($sql);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }

    public function countotherdonorsbyreport(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select count(Id) as count from others";
        $statement=$con->prepare($sql);
        if($statement->execute()){
           $result=$statement->fetch(PDO::FETCH_ASSOC);
           return $result;
        }
    }


}
?>