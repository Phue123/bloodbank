<?php

include_once __DIR__.'/../controller/donationController.php';

$donate_con=new donationController();
session_start();
if (isset($_SESSION['year'])) {
$year=$_SESSION['year'];

if(is_numeric($year)){
$result=$donate_con->getFee($year);

        $data = array();
        foreach ($result as $row) {
        $data[] = $row;   
    }
    // echo $year;

// var_dump($year);
echo json_encode($data);
}
else{
 $year = date('Y');

        $result=$donate_con->getFee($year);

        $data = array();
        foreach ($result as $row) {
        $data[] = $row;
        
    }
   
    // echo $year;

// var_dump($year);
echo json_encode($data);
        
}
}
?>