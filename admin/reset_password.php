<?php
session_start();
include_once __DIR__.'/../controller/loginController.php';
include_once __DIR__.'/../controller/registerController.php';

if(empty($_SESSION['aEmail']) && empty($_SESSION['alogged_in'])){
    header('Location: login.php');
  }

$reg_con=new registerController();
$login_con=new loginController();
$email=$_SESSION['aEmail'];
if(isset($_POST['submit'])){
    if (empty($_POST['password']) || empty($_POST['cpassword']) || strlen($_POST['password']) < 8 || !preg_match("/\d/", $_POST['password']) || !preg_match("/[A-Z]/", $_POST['password']) || 
    !preg_match("/[a-z]/", $_POST['password']) || !preg_match("/\W/", $_POST['password']) || preg_match("/\s/", $_POST['password'])) {
        
        $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";

    
        }else {
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $cpassword=$password;
    if($_POST['password']==$_POST['cpassword']){
    $otp_code= rand(100000, 999999);	
    $result=$login_con->setresetpasswordadmin($password,$cpassword,$email,$otp_code);
    if($result){
        $otpresult=$reg_con->getotpadmin($email);
        $id=$otpresult['Id'];
        if($otpresult){
            $_SESSION['aid']=$otpresult['Id'];
            $_SESSION['aLoggedin']=time();
           echo '<script>location.href="verify_resetpassword.php"</script>' ;
        }
    }
    }else{
    $matcherror="Password doesn't match";
    }
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
    <div class="container-fluid d-flex justify-content-center flex-row m-5">
        
            <div class="col-md-4">
                <h2 class="text-center">Reset Password</h2>
                <div class="card bg-light">

                    <div class="card-body">
                    <?php if(isset($matcherror)) echo "<p class='bgp rounded text-center p-2'>".$matcherror."</p>" ?>
                        <form action="" method="post">
                            <div class="m-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <?php if(isset($passwordError)){ echo '<span class="text-danger">'.$passwordError.'</span>'; }elseif(isset($passwordchar)) {echo '<span class="text-danger">'.$passwordchar.'</span>'; }?>
                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">Comfirm Password</label>
                                <input type="password" name="cpassword" class="form-control" placeholder="Comfirm Password">
                                <?php if(isset($cpasswordError)) {echo '<span class="text-danger">'.$cpasswordError.'</span>';}elseif(isset($cpasswordchar)) {echo '<span class="text-danger">'.$cpasswordchar.'</span>';}  ?>
                            </div>
                            <div class="m-3">
                                <button class="btn btn-primary btn-block" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
</html>