<?php
session_start();
include_once __DIR__.'/../controller/registerController.php';
include_once __DIR__."/../controller/loginController.php";

$log_con=new loginController();
$reg_con=new registerController();
if(isset($_POST['submit'])){
    if (empty($_POST['name']) || empty($_POST['email'])){
        if(empty($_POST['name'])){
            $nameError='Please enter your name';
          }
          if (empty($_POST['email'])) {
            $emailError='Please enter your email';
          }
    if (empty($_POST['password']) || empty($_POST['comfirm_password']) || strlen($_POST['password']) < 6 || !preg_match("/\d/", $_POST['password']) || !preg_match("/[A-Z]/", $_POST['password']) || 
    !preg_match("/[a-z]/", $_POST['password']) || !preg_match("/\W/", $_POST['password']) || preg_match("/\s/", $_POST['password'])) {
        
        $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";

    }
      }else {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $comfirm_password=$password;
    $user=$log_con->getinfobyemailadmin($email);
    if($user){
        $erroremail="Email Duplicated";
    }
    else if($_POST['password']==$_POST['comfirm_password']){
    $otp_code= rand(100000, 999999);
    $result=$reg_con->setuseradmin($name,$email,$password,$comfirm_password,$otp_code);
    if($result){
        $otpresult=$reg_con->getotpadmin($email);
       $id=$otpresult['Id'];
        if($otpresult){
            $_SESSION['aotp_Id']=$otpresult['Id'];
            $_SESSION['aLoggedin']=time();
           echo '<script>location.href="verify_otp.php"</script>' ;
        }
    }
    }else{
        $matcherror="Comfirm password doesn't match!";
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
<section class="h-100 h-custom" style="background-color: #d15769;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">

              <div class="card rounded-3">

                <img src="../assets//img/b1.jpg"
                  class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                  alt="Sample photo">

                <div class="card-body p-4 p-md-5">
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Create A New Account</h3>
      
                  <?php if(isset($message)) echo "<p class='bgs rounded text-center p-2'>".$message."</p>" ?>
                  <?php if(isset($erroremail)) echo "<p class='bgp rounded text-center p-2'>".$erroremail."</p>" ?>
                  <?php if(isset($matcherror)) echo "<p class='bgp rounded text-center p-2'>".$matcherror."</p>" ?>
                  <form action="" method="post" class="px-md-2">
                    <div class="form-floating">
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example1c">Your Name</label>
                            <input type="text" id="form3Example1c" class="form-control" name="name" placeholder="Enter Your Name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"/> 
                            <p style="color:red"><?php echo empty($nameError) ? '' : '*'.$nameError; ?></p>
                            </div>
                          </div>
        
                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example3c">Your Email</label>
                                <input type="email" id="form3Example3c" class="form-control"  name="email" placeholder="Enter Your Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/>
                                <p style="color:red"><?php echo empty($emailError) ? '' : '*'.$emailError; ?></p>
                            </div>
                          </div>
        
                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example4c">Password</label>
                                <input type="password" id="form3Example4c" class="form-control" name="password" /> 
                                <p style="color:red"><?php echo empty($msg) ? '' : '*'.$msg; ?></p>
                            </div>
                          </div>
        
                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example4cd">Confirm password</label>
                                <input type="password" id="form3Example4cd" class="form-control" name="comfirm_password" />
                                <p style="color:red"><?php echo empty($msg) ? '' : '*'.$msg; ?></p>
                            </div>
                          </div>
            
                          <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 d-grid">
                                <button class="btn btn-dark btn-block" name="submit">Register</button>
                          </div>

                          <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                             <p>Already a member ? </p><a href="login.php" class="text-decoration-none">Login Here</a>
                          </div>
                    </div>
      
                  </form>
      
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</body>
</html>