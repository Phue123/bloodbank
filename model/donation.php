<?php
include_once __DIR__.'/../vendor/db/db.php';

class donation{
    public function getdonations(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donation.Id as Id,hospital_req.Contact_Name as cname,donation.Date as date,User.Name as dname,bloodtype.BloodType as btype
        from donation join req_detail join req join hospital_req join bloodstock join donor join donor_req join user join bloodtype
        where donation.ReqDetail_Id=req_detail.Id
        and req_detail.Req_Id=req.Id
        and req.Hospital_Req_Id=hospital_req.Id
        and donation.BloodStock_Id=bloodstock.Id
        and bloodstock.BloodType_Id=bloodtype.Id
        and bloodstock.Donor_Id=Donor.Id
        and donor.Donor_Req_Id=donor_req.Id
        and donor_req.User_Id=User.Id";
        $statement=$con->prepare($sql);
        
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getOthersdonations(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donation.Id as Id,hospital_req.Contact_Name as cname,donation.Date as date,others.Name as Oname,bloodtype.BloodType as btype
        from donation join req_detail join req join hospital_req join bloodstock join others join bloodtype
        where donation.ReqDetail_Id=req_detail.Id
        and req_detail.Req_Id=req.Id
        and req.Hospital_Req_Id=hospital_req.Id
        and donation.BloodStock_Id=bloodstock.Id
        and bloodstock.BloodType_Id=bloodtype.Id
        and bloodstock.Others_Id=others.Id";
        $statement=$con->prepare($sql);
        
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }


    public function getdonationsbypatient(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donation.Id as Id,patient_req.Name as pname,donation.Date as date,User.Name as dname,bloodtype.BloodType as btype
        from donation join req_detail join req join patient_req join bloodstock join donor join donor_req join user join bloodtype
        where donation.ReqDetail_Id=req_detail.Id
        and req_detail.Req_Id=req.Id
        and req.Patient_Req_Id=patient_req.Id
        and donation.BloodStock_Id=bloodstock.Id
        and bloodstock.BloodType_Id=bloodtype.Id
        and bloodstock.Donor_Id=Donor.Id
        and donor.Donor_Req_Id=donor_req.Id
        and donor_req.User_Id=User.Id";
        $statement=$con->prepare($sql);
        
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }


    public function getdonationsbyOthers(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT donation.Id as Id,patient_req.Name as pname,donation.Date as date,others.Name as Oname,bloodtype.BloodType as btype
        from donation join req_detail join req join patient_req join bloodstock join others join bloodtype
        where donation.ReqDetail_Id=req_detail.Id
        and req_detail.Req_Id=req.Id
        and req.Patient_Req_Id=patient_req.Id
        and donation.BloodStock_Id=bloodstock.Id
        and bloodstock.BloodType_Id=bloodtype.Id
        and bloodstock.Others_Id=others.Id";
        $statement=$con->prepare($sql);
        
        
        if($statement->execute()){
            $result=$statement->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }
    }



    public function getDonate(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT COUNT(*) AS total_count FROM donation";
        $statement=$con->prepare($sql);
        
        
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }

    public function retreiveData($year)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT DATE_FORMAT(Date, '%M') AS month,
        DATE_FORMAT(Date, '%Y') AS YEAR,
        COUNT(*) AS record_count
        FROM donation
        WHERE 
        YEAR(Date) = $year
        GROUP BY month,year;";

        $statement = $con->prepare($sql);


        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function retreiveFee($year){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT SUM(fee) AS total_fee,DATE_FORMAT(Date, '%M') AS month,
        DATE_FORMAT(Date, '%Y') AS YEAR
        FROM donation WHERE 
        YEAR(Date) = $year
        GROUP BY month,year;";

        $statement = $con->prepare($sql);


        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

}
?>