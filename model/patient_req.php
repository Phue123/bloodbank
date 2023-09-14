<?php

include_once __DIR__ . '/../vendor/db/db.php';

class Patient_Req
{
    public function getRequests()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT *,patient_req.Id as Patient_Id FROM `patient_req` JOIN bloodtype where patient_req.BloodType_Id=bloodtype.id";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function createPatientReq($name, $address, $phNo, $hospital, $qty, $bloodtypeId, $reason, $fee)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 1. Write and execute the first SQL query to insert patient data
        $sql = "INSERT INTO `patient_req`(`Name`, `Address`, `PhNo`, `Hospital_Name`, `Qty`, `BloodType_Id`, `Reason`, `Fee`, `Status`) 
        VALUES (:name,:address,:phNo,:hospital,:qty,:bloodtypeId,:reason,:fee,0)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':phNo', $phNo);
        $statement->bindParam(':hospital', $hospital);
        $statement->bindParam(':qty', $qty);
        $statement->bindParam(':bloodtypeId', $bloodtypeId);
        $statement->bindParam(':reason', $reason);
        $statement->bindParam(':fee', $fee);
        // 2. sql execute
        if ($statement->execute()) {
            // Get the last inserted ID
            $lastInsertedID = $con->lastInsertId();

            // 3. Write and execute the second SQL query
            $sql2 = "INSERT INTO `Req`(`Patient_Req_Id`, `Hospital_Req_Id`, `Status`) 
                     VALUES (:patientReqId, NULL, 0)";
            $statement2 = $con->prepare($sql2);
            $statement2->bindParam(':patientReqId', $lastInsertedID);

            // 4. sql execute for the second query
            if ($statement2->execute()) {
                return $lastInsertedID;
            }
        } else {
            return false;
        }
    }

    public function getlastId($reqid)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT Id FROM req where Patient_Req_Id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $reqid);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
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
    public function sendReqDetail($did, $btype, $bqty)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `req_detail`( `Req_Id`, `BloodType_Id`, `Qty`) VALUES (:did,:btype,:bqty)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':did', $did);
        $statement->bindParam(':btype', $btype);
        $statement->bindParam(':bqty', $bqty);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getBloodType()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from BloodType";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getAllrequestById($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select patient_req.*,req.Id as rid
        from patient_req join req
        where patient_req.Id=req.Patient_Req_Id
        and req.Patient_Req_Id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam('id', $id);
        if ($statement->execute()) {
            $result = $statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getreqsid($req_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select bloodtype.BloodType as bloodtype,req_detail.Qty as qty,req_detail.BloodType_Id as bid,req_detail.Id as rid
        from req_detail join bloodtype
        where req_detail.BloodType_Id=bloodtype.Id
        and req_detail.Req_Id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam('id', $req_id);
        if ($statement->execute()) {
            $result = $statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getpatientTrashinfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT
        patient_req.deleted_at,
        patient_req.Id,
        patient_req.Name,
        patient_req.Address,
        patient_req.PhNo,
        patient_req.Hospital_Name,
        patient_req.Qty,
        patient_req.Reason
    FROM
        patient_req
    WHERE
        patient_req.deleted_at = 1";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }


    public function restorePatient($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "Update patient_req set deleted_at=0 where Id=:id";
        $statement = $con->prepare($sql);
        $statement->BindParam('id', $id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deletepatient_reqs($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE patient_req set `deleted_at`=1 where Id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // public function deletereqs($id)
    // {
    //     $con = Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     $sql = "UPDATE patient_req set deleted_at=1 where deleted_at=0";
    //     $statement = $con->prepare($sql);
    //     $statement->bindParam(':id', $id);

    //     if ($statement->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function clearTrash()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE from patient_req where deleted_at=1";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addPatient($id, $date)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO `patient`(`Patient_Id`, `Date`) 
        VALUES (:patientId, :date)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':patientId', $id);
        $statement->bindParam(':date', $date);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function getcountPatient(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT count(Id) as total from patient";
        $statement=$con->prepare($sql);
       
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getpatientinfos(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT patient.Date as Date,patient_req.Name as Name,patient_req.Address as Address,
        patient_req.PhNo as PhNo,patient_req.Hospital_Name as Hospital_Name,patient_req.Qty as Qty,patient_req.Fee as Fee,bloodtype.BloodType as BloodType
        from patient join patient_req join bloodtype
        where patient.Patient_Id=patient_req.Id
        and patient_req.BloodType_Id=bloodtype.Id";
        $statement=$con->prepare($sql);
       
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function countpatienetsrequest(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) AS total_count FROM patient_req where deleted_at=0 and Status=0";
        $statement=$con->prepare($sql);
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}
