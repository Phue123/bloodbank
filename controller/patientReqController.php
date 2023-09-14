<?php

include_once __DIR__ . '/../model/patient_req.php';

class patientReqController extends Patient_Req
{

    public function patientRequests()
    {
        return  $this->getRequests();
    }
    public function addPatientReq($name, $address, $phNo, $hospital, $reason, $qty, $bloodtypeId, $fee)
    {
        return $this->createPatientReq($name, $address, $phNo, $hospital, $reason, $qty, $bloodtypeId, $fee);
    }
    public function getReqId($reqid){
        return $this->getlastId($reqid);
    }
    public function checkStock($id){
        return $this->getBloodstockAmount($id);
    }
    public function addReqDetail($did,$btype,$bqty){
        return $this->sendReqDetail($did,$btype,$bqty);
    }
    public function selectBloodType()
    {
        return $this->getBloodType();
    }
    public function getallPrequestbyid($id)
    {
        return $this->getAllrequestById($id);
    }
    public function getreqs($req_id)
    {
        return $this->getreqsid($req_id);
    }
    public function getpatientTrash()
    {
        return $this->getpatientTrashinfo();
    }
    public function getPatient($id){
        return $this->restorePatient($id);
    }
    public function deletepatient_req($id){
        return $this->deletepatient_reqs($id);
    }
    // public function deletereq($id){
    //     return $this->deletereqs($id);
    // }
    public function clearAllTrash(){
        return $this->clearTrash();
    }
    public function createPatient($id,$date){
        return $this->addPatient($id,$date);
    }

    public function countPatient(){
        return $this->getcountPatient();
    }

    public function getpatientinfo(){
        return $this->getpatientinfos();
    }

    public function countpatientsrequests(){
        return $this->countpatienetsrequest();
    }
}

