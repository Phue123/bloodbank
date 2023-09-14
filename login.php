<?php
session_start();
// include_once __DIR__."/layouts/app_nav.php";
include_once __DIR__.'/controller/loginController.php';

$login_con=new loginController();

if(isset($_POST['submit'])){
    if(empty($_POST['email']) || strlen($_POST['password']) < 6 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
          if(empty($_POST['email'])) {
            $emailError='Please enter your email';
          }
          if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $typeemail='Please enter your email';
          }
          if (empty($_POST['password'])) {
            $passwordError='Please enter your password';
          }
          if(strlen($_POST['password']) < 6 ){
            $passwordError='Password should be 4 characters at least';
          }
        }else {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $result=$login_con->getinfobyemail($email);
    if($result){
        if(password_verify($password,$result['Password'])){
            if( $result['verify_otp']==1){
                // session_regenerate_id();
            $_SESSION['user_connected']=TRUE;
            $_SESSION['Id']=$result['Id'];
            $_SESSION['Name']=$result['Name'];
            $_SESSION['Email']=$result['Email'];
            $_SESSION['Logged_in']=time();
            echo '<script>location.href="index.php"</script>';
            }else{
                $_SESSION['Email']=$result['Email'];
                $_SESSION['Logged_in']=time();
                echo '<script>location.href="verify_email.php"</script>';
            }    
        }
        else{
            // $loginerror="It's looks like you are not a menber Click on the bottom link to Sign up";
            echo "<script>alert('Incorrect credentials')</script>";
        }
    }
    else{
        $loginerror="It's looks like you are not a member.<br>Click on the bottom link to <a href='register.php'>Sign up</a>";
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/mycss.css">
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">
                        <img src="img/logo.png"
                          style="width: 185px;" alt="logo">
                        <h4 class="mt-1 mb-5 pb-1">Donor Login</h4>
                      </div>
      
                      <?php if(isset($loginerror)) echo "<p class='bgp rounded text-center p-2'>".$loginerror."</p>" ?>
                      <form action="" method="post">    
                        <p>Please login to your account</p>
      
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example11">Email</label>
                            <input type="email" id="form2Example11" class="form-control" name="email"
                            placeholder="Email"value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" />
                            <p style="color:red"><?php echo empty($emailError) ? '' : '*'.$emailError; ?></p>
                        </div>
      
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example22">Password</label>
                          <input type="password" id="form2Example22" class="form-control" placeholder="Enter password" name="password"/>
                          <p style="color:red"><?php echo empty($passwordError) ? '' : '*'.$passwordError; ?></p>
                        </div>
      
                        <div class="text-center pt-1 mb-5 pb-1 d-grid">
                          <!-- <button class="btn btn-dark gradient-custom-2 mb-3 text-light" type="button" name="submit">Log
                            in</button> -->
                            <button class="btn btn-dark btn-block" name="submit">Login</button>
                            <a class="mt-2 text-primary text-decoration-none" href="forget_password.php">Forgot password?</a>
                        </div>
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-4">Not a member ?</p>
                          <a href="register.php" class="text-decoration-none">Register</a>
                        </div>

                        <div>
                            <a href="logout.php" class="text-primary text-decoration-none">LogOut</a>
                        </div>
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2 bg-danger">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">Life-Saving Impact: The Importance of Blood Donation"</h4>
                      <p class="small mb-0">
                        Blood donation is a critical and selfless act that saves countless lives around the world every day.
                        When individuals choose to donate blood, they contribute to a vital resource that is essential for various medical treatments, surgeries, and emergencies.
                        Each donation has the potential to help patients suffering from injuries, surgeries, cancer, anemia, and other medical conditions.
                        It's a simple yet powerful way for ordinary people to make a significant impact on the well-being of others. Moreover,
                        blood donation is a community effort that fosters a sense of unity and compassion among donors, healthcare professionals,
                        and recipients. It's a humanitarian gesture that transcends borders and connects people through the common goal of saving lives.
                        Encouraging and participating in blood donation drives is an integral part of building a healthier, more resilient society.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</body>
</html>
