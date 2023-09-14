<?php
include_once __DIR__.'/../model/bloodstock.php';

class bloodstockController extends bloodstock{
    public function getbloodbybs(){
        return $this->getbloodinfo();
    }

    public function getbloodbybsother(){
        return $this->getbloodinfoother();
    }

    public function getbloods(){
        return $this->getblood();
    }

    public function getnoofblood(){
        return $this->getnoofbloods();
    }

    public function addbloodstock($bcode,$description,$ddate,$bloodtype,$donarid){
        return $this->addbloodstockinfo($bcode,$description,$ddate,$bloodtype,$donarid);
    }

    public function getbsbyblood($bid){
        return $this->getbsbybloods($bid);
    }
    public function addbloodstockbybshos($rid,$bsid,$date){
        return $this->addbloodstockbybsshos($rid,$bsid,$date);
    }
    public function addbloodstockbybs($rid,$bsid,$date,$fee){
        return $this->addbloodstockbybss($rid,$bsid,$date,$fee);
    }
    public function deleteblood($bsid){
        return $this->deletebloods($bsid);
    }

    public function countbloodstocks()
    {
        return $this->countbloodstock();
    }
}
?>