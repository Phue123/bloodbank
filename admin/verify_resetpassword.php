<?php
session_start();
include_once __DIR__."/../controller/loginController.php";
include_once __DIR__.'/../controller/registerController.php';

if(empty($_SESSION['aid']) && empty($_SESSION['aLoggedin'])){
    header('Location: forget_password.php');
  }

$id=$_SESSION['aid'];
$login_con=new loginController();
$reg_con=new registerController();
$otpresult=$reg_con->getinfobyidadmin($id);
$oid=$otpresult['Id'];
// var_dump($otpresult);
if(isset($_POST['submit'])){
    $otp=$_POST['otp'];
    if($otp == $otpresult['otp_code']){
        $result=$login_con->setotpadmin($id);
        echo '<script>location.href="login.php"</script>';
    }else
    {
        $invalid="Otp is invalid number";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mycss.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-row mt-5">

            <div class="col-md-5">
                <h2 class="text-center">Reset OTP Verification</h2>
                
                <div class="card bg-light">
                    <div class="card-body">
                    <?php if(isset($invalid)) echo "<p class='bgs rounded text-center p-2'>".$invalid."</p>" ?>
                        <form action="" method="post">
                            <div class="mt-3">
                                <input type="number" name="otp" class="form-control" placeholder="Enter verification code">
                                <div id="countdown" id1="<?php echo $oid; ?>" class="mt-3 text-center text-info"></div>
                                <p style="color:red"><?php echo empty($otperror) ? '' : '*'.$otperror; ?></p>
                            </div>
                            <div class="mt-3" id="<?php echo $oid; ?>">
                                <button class="btn btn-primary btn-block" name="submit">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/script.js"></script>
</html>