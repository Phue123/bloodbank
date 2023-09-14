<?php
session_start();
include_once __DIR__.'/controller/donorController.php';
include_once __DIR__.'/controller/bloodstockController.php';

if(empty($_SESSION['Name']) && empty($_SESSION['Email']) && empty($_SESSION['Logged_in'])){
    header('Location: donorForm.php');
}
$lid=$_SESSION['Id'];
$lname=$_SESSION['Name'];
$lemail=$_SESSION['Email'];

$donor_con=new donarController();
$bs_con=new bloodstockController();
$bloods=$bs_con->getbloods();
// var_dump($bloods);
$donor_reqs=$donor_con->getdonorreqs($lid);
$d_reqs=$donor_con->getdonorblood($lid);

// $date=$donor_reqs['Date'];
// $dates=date('m',strtotime($date)); 
// var_dump($dates);

if(isset($_POST['submit'])){
    if(empty($_POST['phone']) || empty($_POST['address']) || empty($_POST['lb']) || !preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['phone'])){
    
    if(empty($_POST['phone'])){
        $phErr='Please enter your Phone Number';
    }

    if(!preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['phone'])){
        $typephErr='Incorect Phone Number Type';
    }

    if(empty($_POST['lb'])){
        $lbErr='Please enter your weight';
    }

    if(empty($_POST['address'])){
        $addErr='Please fill your address';
    }

   }else{
    $lid=$_SESSION['Id'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $lb=$_POST['lb'];

    if(isset($d_reqs['Id'])){
    $bloodtype=$d_reqs['bloodtype'];
    }else{
        $bloodtype=$_POST['bloodtype'];
    }

    $latestdate=$donor_reqs['Date'];
    $date=date("Ymd");
    // var_dump($date);
    $currentmonth=date('m',$date);
    $diff=abs($currentmonth-$latestdate);

    if($diff >= 4){
    $result=$donor_con->adddonar($lid,$phone,$address,$lb,$bloodtype);
    if($result){
        $_SESSION['Lid']=$lid;
        echo "<script type='text/javascript'>alert('Your request is being processed');</script>";
        echo "<script>location.href='index.php'</script>";
    }
   }
   $timeerror="You have been donating blood for less than four months";
   }
}
if(isset($_POST['submit1'])){
    $lid=$_SESSION['Id'];
    $_SESSION['Lid']=$lid;
    echo "<script>location.href='index.php'</script>";

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be a Donor </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/css/mycss.css">
</head>
<body>
            

     <div class="container-fluid d-flex justify-content-center flex-row m-5">
        
        <div class="col-md-4">
            <h2 class="text-center text-danger text-uppercase">Be a Donor</h2>
            <div class="card bg-light">

                <div class="card-body">
                <?php if(isset($timeerror)) echo "<p class='bgp rounded text-center p-2'>".$timeerror."</p>" ?>
                    <form action="" method="post">
                        <div class="m-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php if(isset($lname)) echo $lname; ?>" disabled>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php if(isset($lemail)) echo $lemail; ?>" disabled>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php if(isset($_POST['address'])) echo $_POST['address'] ?>">
                            <p style="color:red"><?php  echo empty($addErr) ? '' : '*'.$addErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="phone" name="phone" class="form-control" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'] ?>">
                            <p style="color:red"><?php  echo empty($phErr) ? '' : '*'.$phErr; ?></p>
                            <p style="color:red"><?php  echo empty($typephErr) ? '' : '*'.$typephErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Weight</label>
                            <input type="text" name="lb" class="form-control" value="<?php if(isset($_POST['lb'])) echo $_POST['lb'] ?>">
                            <p style="color:red"><?php  echo empty($lbErr) ? '' : '*'.$lbErr; ?></p>
                            
                        </div>

                        <div class="m-3">
                            
                                <label for="" class="form-label">Blood Type</label>
                                <?php if(isset($d_reqs['Id'])) {?>
                                <input type="text" name="bloodtype" class="form-control" value="<?php echo $d_reqs['bloodtype'] ?>" disabled>
                                <?php }else{?>
                                    <select name="bloodtype" id="" class="form-select">
                                        <option value="" disabled selected>--SELECT BLOOD--</option>
                                        <?php
                                        foreach($bloods as $blood){
                                            ?>

                                            <option value="<?php echo $blood['Id']; ?>" 
                                            <?php if(isset($_POST['bloodtype']) && $_POST['bloodtype'] ==$blood['Id'])
                                                    echo 'selected'; 
                                                   ?>>
                                            <?php echo $blood['BloodType']; ?>
                                            </option>;
                                        <?php
                                        }
                                        ?>
                                    </select>
                        </div>
                        <?php } ?>
                        
                        <div class="m-3 d-grid">
                            <button type="submit" class="btn btn-danger" name="submit">Donate</button>
                            <button class="btn btn-info mt-3" name="submit1">Main Page</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   
</div>

    
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>