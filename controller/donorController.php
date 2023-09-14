<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../model/donor.php';
include_once __DIR__.'/../vendor/PHPMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PHPMailer/src/SMTP.php';
include_once __DIR__.'/../vendor/PHPMailer/src/Exception.php';

class donarController extends donar{
    public function getdonarbydonar(){
        return $this->getdonarinfobydonar();
    }
    public function getalldonar(){
        return $this->getalldonarinfo();
    }
    
    public function adddonar($lid,$phone,$address,$lb,$bloodtype){
        return $this->adddonarinfo($lid,$phone,$address,$lb,$bloodtype);
    }
    public function getdonar_reqs($id){
        return $this->getdonar_reqsinfo($id);
    }

    public function getdonar($lid){
        return $this->getdonarinfo($lid);
    }


    public function getdonarbyacceptid($accept_id){
        return $this->getdonarinfobyacceptid($accept_id);
    }
   
    public function adddonars($accept_id,$date,$remark){
        return $this->adddonarinfos($accept_id,$date,$remark);
    }

    public function restatus($id){
        return $this->restatusinfo($id);
    }

    public function deletedonar_req($id){
        return $this->deletedonar_reqinfo($id);
    }

    public function getdonorreqs($lid){
        return $this->getdonorreqsinfo($lid);
    }

    public function getdonorblood($lid){
        return $this->getdonorbloodinfo($lid);
    }

    public function countdonor(){
        return $this->countdonors();
    }
    public function getdonortrash(){
        return $this->getdonortrashinfo();
    }

    public function getdonor_req(){
        return $this->donor_req();
    }

    public function getmailtrainee($id){
        $emailaddress=$this->getmail($id);
        $mailer=new PHPMailer(true);

        //Server setting
        $mailer->SMTPDebug=SMTP::DEBUG_SERVER;
        $mailer->isSMTP();
        $mailer->Host='smtp.gmail.com';
        $mailer->SMTPAuth=true;
        $mailer->SMTPSecure='tls';
        $mailer->Port=587;

        //Mail setting
        $mailer->Username="phuepwint293989@gmail.com";
        $mailer->Password="zwszunlpdalwfwqe";

        $mailer->SetFrom('phuepwint293989@gmail.com','Admin');
        $mailer->addAddress($emailaddress['Email'],"DonorName");

        $mailer->isHTML(true);
        $mailer->Subject="Accept your request";
        $mailer->Body="Name : ". $emailaddress['name']."<br> Blood Type: ". $emailaddress['bloodtype']."<br><p>Thanks you for donating your blood.Your generosity saves and makes a difference.Grateful! </p>";
        if($mailer->send()){
            $sentEmail=$this->setEmailDetails($emailaddress['Id']);
        return $sentEmail;
        }
    }
    public function restoreDonor($id){
        return $this->restoreDonors($id);
    }
    public function clearAllTrash(){
        return $this->clearTrash();
    }

    public function countdonorsbyreports()
    {
        return $this->countdonorsbyreport();
    }

    public function countotherdonorsbyreports()
    {
        return $this->countotherdonorsbyreport();
    }
}
?>