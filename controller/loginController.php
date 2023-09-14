<?php
include_once __DIR__.'/../model/login.php';

class loginController extends login{
    public function getuser()
    {
        return $this->getuserinfo();
    }
    public function getinfobyemail($email){
        return $this->getuserinfobyemail($email);
    }
    public function setotp($id){
        return $this->setotpinfo($id);
    }
    
    public function setresetpassword($password,$cpassword,$email,$otp_code){
        return $this->updatepassword($password,$cpassword,$email,$otp_code);
    }
    public function getid($email){
        return $this->getidinfo($email);
    }
    public function getinfobyid($id){
        return $this->getuserinfobyid($id);
       }

       public function getuseradmin()
    {
        return $this->getuserinfoadmin();
    }
    public function getinfobyemailadmin($email){
        return $this->getuserinfobyemailadmin($email);
    }
    public function setotpadmin($id){
        return $this->setotpinfoadmin($id);
    }
    
    public function setresetpasswordadmin($password,$cpassword,$email,$otp_code){
        return $this->updatepasswordadmin($password,$cpassword,$email,$otp_code);
    }
    public function getidadmin($email){
        return $this->getidinfoadmin($email);
    }
    public function getinfobyidadmin($id){
        return $this->getuserinfobyidadmin($id);
    }
    public function changepasswordadmin($id,$newpassword,$new_cpassword){
        return $this->changepasswordinfoadmin($id,$newpassword,$new_cpassword);
    }
}
?>