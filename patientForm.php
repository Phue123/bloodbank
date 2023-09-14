<?php
session_start();
include_once __DIR__.'/controller/donorController.php';
include_once __DIR__.'/controller/bloodstockController.php';
include_once __DIR__ . "/controller/patientReqController.php";

$bs_con=new bloodstockController();
$preq_controller = new patientReqController();
$bloods=$bs_con->getbloods();
 

if (isset($_POST['submit'])) {

    if(empty($_POST['Name']) || empty($_POST['Address']) || empty($_POST['PhNo']) || !preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['PhNo']) || empty($_POST['Hospital_Name']) || empty($_POST['Qty']) || empty($_POST['Reason']) || empty($_POST['Fee']) ){
    
        if(empty($_POST['Name'])){
            $nameerror='Please enter your name';
        }
    
        if(empty($_POST['Address'])){
            $addresserror='Please enter your address';
        }
    
        if(empty($_POST['PhNo'])){
            $phNoerror='Please enter your phone number';
        }

        if(!preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['PhNo'])){
            $typephNoerror='Incorrect phone number type';
        }
    
        if(empty($_POST['Hospital_Name'])){
            $hoserror='Please fill your hospital name';
        }
    
        if(empty($_POST['Qty'])){
            $qtyerror='Please fill Qty';
        }
    
        if(empty($_POST['Reason'])){
            $reasonerror='Please fill your reason';
        }
    
        if(empty($_POST['Fee'])){
            $feeerror='Please fill your fee';
        }
    
       }else{    
    
        $id=$_POST['BloodtypeId'];

        $result=$preq_controller->checkStock($id);
        
        $result['count'] ??= '0';
        $count=$result['count'];
        $q=$_POST['Qty']; //entered blood amount

        if($count >= $q){
            $result['blood'] ??= 'null';
           
            $bloodt=$result['Id'];
 
            $bloodtype=$bloodt;
            // var_dump($bloodtype);
        }else{
            $error="Blood is not sufficient";
            // var_dump($error);
        }  

        if(isset($error)){
            $error="Blood is not sufficient";
        }else{  
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $phNo = $_POST['PhNo'];
    $hospital = $_POST['Hospital_Name'];
    $reason = $_POST['Reason'];
    $qty = $_POST['Qty'];
    $bloodtypeId = $_POST['BloodtypeId'];
    $fee=$_POST['Fee'];

    $addReq = $preq_controller->addPatientReq($name, $address, $phNo, $hospital, $qty, $bloodtypeId,$reason,$fee);
    if($addReq){
        $reqid=intval($addReq);
        $result=$preq_controller->getReqId($reqid);
        if($result){
                $did=$result['Id'];
                $btype=$bloodtype;
                $bqty=$q;
                $send=$preq_controller->addReqDetail($did,$btype,$bqty);
                if($send)
                {
                echo "<script type='text/javascript'>alert('Your request is being processed');</script>";
                echo "<script>location.href='index.php'</script>";
                }
            }
        }
    }
}
}

if(isset($_POST['submit1'])){
   
    echo "<script>location.href='index.php'</script>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Request</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/css/mycss.css">
</head>
<body>


<div class="container-fluid d-flex justify-content-center flex-row">
        
        <div class="col-md-4">
            <h2 class="text-center text-danger text-uppercase">Patient Request</h2>
            <div class="card bg-light">
            <?php if(isset($error)) echo "<p class='bgp rounded text-center p-2'>".$error."</p>" ?>
                <div class="card-body">
                    <form action="" method="post">
                        <?php if(isset($_SESSION['user_connected'])){ ?>
                        <div class="m-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="Name" class="form-control" value="<?php echo $_SESSION['Name']; ?>">
                            <span class="text-danger"><?php if(isset($nameerror)) echo $nameerror; ?></span>
                        </div>
                        <?php }else{?>
                            <div class="m-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="Name" class="form-control">
                            <span class="text-danger"><?php if(isset($nameerror)) echo $nameerror; ?></span>
                        </div>
                        <?php } ?>

                        <div class="m-3">
                            <label for="" class="form-label">Address</label>
                            <input type="address" name="Address" class="form-control" value="<?php if(isset($_POST['Address'])) echo $_POST['Address']; ?>">
                            <span class="text-danger"><?php if(isset($addresserror)) echo $addresserror; ?></span>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="phone" name="PhNo" class="form-control" value="<?php if(isset($_POST['PhNo'])) echo $_POST['PhNo']; ?>">
                            <span class="text-danger"><?php if(isset($phNoerror)) echo $phNoerror; ?></span>
                            <span class="text-danger"><?php if(isset($typephNoerror)) echo $typephNoerror; ?></span>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Hospital</label>
                            <input type="text" name="Hospital_Name" class="form-control" value="<?php if(isset($_POST['Hospital_Name'])) echo $_POST['Hospital_Name']; ?>"> 
                            <span class="text-danger"><?php if(isset($hoserror)) echo $hoserror; ?></span>       
                        </div>

                        <div class="m-3">
                             <label for="" class="form-label">Quantity</label>
                            <input type="number" name="Qty" class="form-control" value="<?php if(isset($_POST['Qty'])) echo $_POST['Qty']; ?>"> 
                            <span class="text-danger"><?php if(isset($qtyerror)) echo $qtyerror; ?></span>  
                        </div>

                        <div class="m-3">
                                <label for="" class="form-label">Blood Type</label>
                                    <select name="BloodtypeId" id="" class="form-select">
                                        <option value="" disabled selected>--Select Blood--</option>
                                        <?php
                                        foreach($bloods as $blood){
                                            ?>
                                            <option value="<?php echo $blood['Id']; ?>" 
                                            <?php if(isset($_POST['BloodtypeId']) && $_POST['BloodtypeId'] ==$blood['Id'])
                                                    echo 'selected'; 
                                                   ?>>
                                            <?php echo $blood['BloodType']; ?>
                                            </option>;
                                        <?php
                                        }
                                        ?>
                                     </select>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Reason</label>
                            <input type="text" name="Reason" class="form-control" value="<?php if(isset($_POST['Reason'])) echo $_POST['Reason']; ?>"> 
                            <span class="text-danger"><?php if(isset($reasonerror)) echo $reasonerror; ?></span>       
                        </div>

                        <div class="m-3">
                             <label for="" class="form-label">Fee</label>
                            <input type="number" name="Fee" class="form-control" value="<?php if(isset($_POST['Fee'])) echo $_POST['Fee']; ?>">
                            <span class="text-danger"><?php if(isset($feeerror)) echo $feeerror; ?></span>   
                        </div>
                        
                        <div class="m-2 d-grid">
                            <button type="submit" class="btn btn-danger" name="submit">Send</button>
                        </div>
                        <div class="m-2 d-grid">
                            <button type="submit" class="btn btn-info mt-3" name="submit1">Main Page</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   
    </div>
    
</body>
</html>