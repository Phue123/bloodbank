<?php
include_once __DIR__.'/../model/donation.php';

class donationController extends donation{
    public function getOthers(){
        return $this->getOthersdonations();
    }

    public function getdonation(){
        return $this->getdonations();
    }

    public function getdonationbypatient(){
        return $this->getdonationsbypatient();
    }

    public function getpOthers(){
        return $this->getdonationsbyOthers();
    }

    public function countDonate(){
        return $this->getDonate();
    }
    public function getData($year){
        return $this->retreiveData($year);
    }
    public function getFee($year){
        return $this->retreiveFee($year);
    }

}
?>