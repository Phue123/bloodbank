<?php
include_once __DIR__.'/controller/registerController.php';
include_once __DIR__."/controller/loginController.php";
$iid=$_GET['id'];
$id=intval($iid);

$log_con=new loginController();
$reg_con=new registerController();

    
if(isset($_POST['submit'])){
    if (empty($_POST['current_password']) || empty($_POST['newpassword']) || empty($_POST['new_cpassword']) || strlen($_POST['newpassword']) < 6 || !preg_match("/\d/", $_POST['newpassword']) || !preg_match("/[A-Z]/", $_POST['newpassword']) || 
    !preg_match("/[a-z]/", $_POST['newpassword']) || !preg_match("/\W/", $_POST['newpassword']) || preg_match("/\s/", $_POST['newpassword'])) {
    
        if(empty($_POST['current_password'])){
            $cerror="Please fill current password";
        }
        $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
     
      }else {
    $current_password=$_POST['current_password'];
    $result=$log_con->getinfobyid($id);
    if(password_verify($current_password,$result['Password'])){
        $newpassword=password_hash($_POST['newpassword'],PASSWORD_DEFAULT);
        $new_cpassword=$newpassword;
        if($newpassword==$new_cpassword){
        $result1=$log_con->changepasswordadmin($id,$newpassword,$new_cpassword);
        if($result1){
            echo '<script>location.href="index.php"</script>';
        }
       }else{
        $matcherror1="New Password doesn't match";
       }
      }else{
        $matcherror="Current password is wrong";
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
    <div class="container d-flex justify-content-center align-items-center flex-row mt-5">

            <div class="col-md-5">
                <h2 class="text-center">Change Password Page</h2>
                
                <div class="card bg-light">

                    <div class="card-body">
                    
                        <?php if(isset($matcherror1)) echo "<p class='bgp rounded text-center p-2'>".$matcherror1."</p>" ?>
                        <?php if(isset($matcherror)) echo "<p class='bgp rounded text-center p-2'>".$matcherror."</p>" ?>
                        <form action="" method="post">
                            
                            <div class="m-3">
                                <label for="" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" value="<?php if(isset($_POST['current_password'])) echo $_POST['current_password']; ?>">
                                <p style="color:red"><?php echo empty($cerror) ? '' : '*'.$cerror; ?></p>
                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">New Password</label>
                                <input type="password" name="newpassword" class="form-control">
                                <p style="color:red"><?php echo empty($msg) ? '' : '*'.$msg; ?></p>

                            </div>
                            <div class="m-3">
                                <label for="" class="form-label">New Comfirm Password</label>
                                <input type="password" name="new_cpassword" class="form-control">
                                <p style="color:red"><?php echo empty($msg) ? '' : '*'.$msg; ?></p>
                               
                            </div>
                            <div class="mt-3">
                                <div class="d-grid">
                                <button class="btn btn-primary btn-block" name="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
    </div>
</body>
</html>