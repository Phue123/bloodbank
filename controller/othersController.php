<?php
include_once __DIR__.'/../model/others.php';

class othersController extends others{
    public function addotherdonor($name,$phone,$nrc,$address,$bloodtype,$remark,$date){
        return $this->createotherdonor($name,$phone,$nrc,$address,$bloodtype,$remark,$date);
    }
    public function addothers($code,$description,$date,$bloodtype,$others){
        return $this->addothersinfo($code,$description,$date,$bloodtype,$others);
    }
    public function getothersinfo(){
        return $this->getothers();
    }

    public function getothersid($nrc){
        return $this->getothersidinfo($nrc);
    }

    public function countOther(){
        return $this->getcountOther();
    }
  
}
?>