<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exeception;

include_once __DIR__."/../model/contact.php";
include_once __DIR__.'/../vendor/PHPMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PHPMailer/src/SMTP.php';
include_once __DIR__.'/../vendor/PHPMailer/src/Exception.php';

class contactController extends contact{
    
    public function addcontact($name,$email,$phone,$message){
        return $this->createcontact($name,$email,$phone,$message);
    }
    public function getcontact(){
        return $this->getcontactinfo();
    }
    public function mailcontact($id){
        $mailaddress=$this->getMail($id);
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
        $mailer->addAddress($mailaddress['Email'],"ContactName");

        $mailer->isHTML(true);
        $mailer->Subject="Accept your Recommendation Letter";
        $mailer->Body="Name : ". $mailaddress['Name']."<br><p>Thanks you for your recommendation.Whether you want to donate blood or need blood,you can contact at any time.Thank you</p>";
        if($mailer->send()){
            $sentEmail=$this->setEmail($mailaddress['Id']);
        return $sentEmail;
        }
            

    }
}
?>