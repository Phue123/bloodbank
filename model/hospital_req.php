<?php

include_once __DIR__ . '/../vendor/db/db.php';

class Hospital_Req
{
    public function getRequests()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from Hospital_Req";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function createHospitalReq($contact_name, $dept,$address,$phNo ,$reason)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 1. Write and execute the first SQL query to insert patient data
        $sql = "INSERT INTO Hospital_Req(`Contact_Name`, `Dept`, `Address`, `PhNo`,`Reason`, `Status`) 
                VALUES (:name, :dept, :address, :phNo,:reason, 0)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $contact_name);
        $statement->bindParam(':dept', $dept);
        $statement->bindParam(':phNo', $phNo);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':reason', $reason);


        // 2. sql execute
        if ($statement->execute()) {
            $lastInsertedID = $con->lastInsertId();

            $sql2 = "INSERT INTO `Req`(`Patient_Req_Id`, `Hospital_Req_Id`, `Status`) 
            VALUES (NULL, :hospitalReqId, 0)";
            $statement2 = $con->prepare($sql2);
            $statement2->bindParam(':hospitalReqId', $lastInsertedID);
            if ($statement2->execute()) {
                return $lastInsertedID;
            }

        } else {
            return false;
        }
    }
    public function getBloodstockAmount($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(Code) as count ,bloodtype.BloodType as blood,bloodtype.Id as Id
        FROM bloodstock join bloodtype
        WHERE bloodstock.BloodType_Id=bloodtype.Id
        and BloodType_Id = :id
        and deleted_at=0
        group by BloodType_Id"; // Assuming the bloodstock data is in the row with ID 1
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        
    }
}
    public function getlastId($id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT Id FROM req where Hospital_Req_Id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function sendReqDetail($did,$btype,$bqty){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="INSERT INTO `req_detail`( `Req_Id`, `BloodType_Id`, `Qty`) VALUES (:did,:btype,:bqty)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':did', $did);
        $statement->bindParam(':btype', $btype);
        $statement->bindParam(':bqty', $bqty);
        if ($statement->execute()) {
            return true;
        }

    }

    public function getallhrequests(){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from hospital_req";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function getallhrequestsbyid($id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select hospital_req.*,req.Id as rid
        from hospital_req join req
        where hospital_req.Id=req.Hospital_Req_Id
        and req.Hospital_Req_Id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam('id',$id);
        if ($statement->execute()) {
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function getreqsid($req_id){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select bloodtype.BloodType as bloodtype,req_detail.Qty as qty,req_detail.BloodType_Id as bid,req_detail.Id as rid
        from req_detail join bloodtype
        where req_detail.BloodType_Id=bloodtype.Id
        and req_detail.Req_Id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam('id',$req_id);
        if ($statement->execute()) {
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }

    }

    public function deletehospital_reqs($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE `hospital_req` SET `deleted_at`=1 where Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deletereqs($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE `hospital_req` SET `Status`=1 where Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function gethospitalTrashinfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT
        hospital_req.deleted_at,
        hospital_req.Id,
        hospital_req.Contact_Name,
        hospital_req.Dept,
        hospital_req.Address,
        hospital_req.PhNo,
        hospital_req.Reason
    FROM
        hospital_req
    WHERE
        hospital_req.deleted_at = 1";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function restoreHospital($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "Update hospital_req set deleted_at=0 where Id=:id";
        $statement = $con->prepare($sql);
        $statement->BindParam('id', $id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function clearTrash(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="DELETE from hospital_req where deleted_at=1";
        $statement = $con->prepare($sql);
        if($statement->execute()){
            return true;
        }else{
            return false;
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

    public function restatusinfo($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE hospital_req set Status=1 where hospital_req.Id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        
        try{
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function createAllHospitals($req_id,$date){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="INSERT INTO `hospital`(Hospital_Id,Date) VALUES (:req_id,:date)";    
        $statement=$con->prepare($sql);
        $statement->bindParam('req_id',$req_id);    
        $statement->bindparam(':date', $date);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function getcountHospital(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT count(Id) as total from hospital";
        $statement=$con->prepare($sql);
       
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function gethospitalinfos(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT hospital.Date as Date,hospital_req.Contact_Name as Contact_Name,hospital_req.Dept as Dept,hospital_req.Address as Address,hospital_req.PhNo as PhNo,bloodtype.BloodType as bloodtype,req_detail.Qty as qty
        from hospital join hospital_req join req join req_detail join bloodtype
        where hospital.Hospital_Id=hospital_req.Id
        and hospital_req.Id=req.Hospital_Req_Id
        and req.Id=req_detail.Req_Id
        and req_detail.BloodType_Id=bloodtype.Id";
        $statement=$con->prepare($sql);
       
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function counthosrequest(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT count(Id) as total from hospital_req where Status=0 and deleted_at=0";
        $statement=$con->prepare($sql);
       
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
   
}
