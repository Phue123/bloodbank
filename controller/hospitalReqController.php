<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../vendor/PHPMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PHPMailer/src/SMTP.php';
include_once __DIR__.'/../vendor/PHPMailer/src/Exception.php';
include_once __DIR__.'/../model/hospital_req.php';

class hospitalReqController extends hospital_req{

    public function checkStock($id){
        return $this->getBloodstockAmount($id);
    }
    public function handleAjaxRequest($hospitalReqModel, $bloodtypeId)
    {
        // Call the method in the model to get the bloodstock amount
        $bloodstockAmount = $hospitalReqModel->getBloodstockAmount($bloodtypeId);

        // Perform any necessary validation and logic with the bloodstock amount
        // In this example, we are only returning the amount
        return ['amount' => $bloodstockAmount];
    }
    public function addHospitalReq($contact_name, $dept,$address,$phNo ,$reason){
        return $this->createHospitalReq($contact_name, $dept,$address,$phNo ,$reason);
    }
    public function getReqId($id){
        return $this->getlastId($id);
    }
    public function addReqDetail($did,$btype,$bqty){
        return $this->sendReqDetail($did,$btype,$bqty);
    }
    public function getallhrequest(){
        return $this->getallhrequests();
    }
    public function getallhrequestbyid($id){
        return $this->getallhrequestsbyid($id);
    }
    public function getreqs($req_id){
        return $this->getreqsid($req_id);
    }
    public function deletehospital_req($id){
        return $this->deletehospital_reqs($id);
    }
    public function deletereq($id){
        return $this->deletereqs($id);
    }
    public function gethospitalTrash()
    {
        return $this->gethospitalTrashinfo();
    }
    public function getHospital($id){
        return $this->restoreHospital($id);
    }
    public function clearAllTrash(){
        return $this->clearTrash();
    }
    public function addAllHospitals($req_id,$date){
        return $this->createAllHospitals($req_id,$date);
    }

    public function countHospital(){
        return $this->getcountHospital();
    }

    public function gethospitalinfo(){
        return $this->gethospitalinfos();
    }

    public function counthosrequests(){
        return $this->counthosrequest();
    }

}

?>