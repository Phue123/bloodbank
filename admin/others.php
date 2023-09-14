<?php
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__.'/../controller/bloodstockController.php';
include_once __DIR__.'/../controller/othersController.php';

$bs_con=new bloodstockController();
$bloods=$bs_con->getbloods();

$others_con=new othersController();

if(isset($_POST['submit'])){
    if(empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['nrc']) || empty($_POST['address']) || empty($_POST['bloodtype']) || empty($_POST['remark']) || empty($_POST['date'])){
    
    if(empty($_POST['name'])){
        $nameErr='Please enter your name';
    }

    if(empty($_POST['phone'])){
        $phErr='Please enter your Phone Number';
    }

    if(empty($_POST['nrc'])){
        $nrcErr='Please enter your NRC';
    }

    if(empty($_POST['address'])){
        $addErr='Please fill your address';
    }
    if(empty($_POST['bloodtype'])){
        $btErr="Please select blood type";
    }
    if(empty($_POST['remark'])){
        $remarkErr="Please enter your remark";
    }
    if(empty($_POST['date'])){
        $dateErr="Please select your date";
    }

   }else{
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $nrc=$_POST['nrc'];
    $address=$_POST['address'];
    $bloodtype=$_POST['bloodtype'];
    $remark=$_POST['remark'];
    $date=$_POST['date'];

    $result1=$others_con->getothersid($nrc);
    $latestdate=$result1['oDate'];
    $date=date("Ymd");
    $currentmonth=date('m',$date);
    $diff=abs($currentmonth-$latestdate);
    
    if($bloodtype==$result1['bid'] || $result1['bid']==NULL){
    if($diff >= 4){

    $result=$others_con->addotherdonor($name,$phone,$nrc,$address,$bloodtype,$remark,$date);
    if($result){
        $result1=$others_con->getothersid($nrc);
        if($result1){
            $_SESSION['otherId']=$result1['Id'];
            $_SESSION['bloodtype']=$result1['btype'];
            $_SESSION['bloodtype_id']=$result1['bid'];
            $_SESSION['date']=$result1['Date'];
            $_SESSION['othername']=$result1['Name'];
             echo '<script>location.href="addbloodstock.php"</script>';
        }
    }
    }else{
        $timeerror="You have been donating blood for less than four months";
    }
}else{
    $blooderror="Blood doesn't match";
}
   }
   }


?>

    <main class="content">
     <div class="container">
            <h2 class="text-center text-danger text-uppercase">Other Donate</h2>
            <?php if(isset($timeerror)) echo "<p class='bgp rounded text-center p-2'>".$timeerror."</p>" ?>
            <?php if(isset($blooderror)) echo "<p class='bgp rounded text-center p-2'>".$blooderror."</p>" ?>

                    <form action="" method="post">
                        <div class="m-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
                            <p style="color:red"><?php  echo empty($nameErr) ? '' : '*'.$nameErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="phone" name="phone" class="form-control" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                            <p style="color:red"><?php  echo empty($phErr) ? '' : '*'.$phErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">
                            <p style="color:red"><?php  echo empty($addErr) ? '' : '*'.$addErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">NRC</label>
                            <input type="text" name="nrc" class="form-control" value="<?php if(isset($_POST['nrc'])) echo $_POST['nrc']; ?>">
                            <p style="color:red"><?php  echo empty($nrcErr) ? '' : '*'.$nrcErr; ?></p>
                        </div>


                        <div class="m-3">
                            <label for="" class="form-label">Remark</label>
                            <input type="text" name="remark" class="form-control" value="<?php if(isset($_POST['remark'])) echo $_POST['remark']; ?>">
                            <p style="color:red"><?php  echo empty($addErr) ? '' : '*'.$addErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="<?php if(isset($_POST['date'])) echo $_POST['date']; ?>">
                            <p style="color:red"><?php  echo empty($dateErr) ? '' : '*'.$dateErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Blood Type</label>
                            <select name="bloodtype" id="" class="form-select" style="padding: 0.5rem;">
                                <option value="" selected disabled>--SELECT BLOOD TYPE--</option>
                                <?php
                                        foreach($bloods as $blood){
                                            ?>
                                            <option value="<?php echo $blood['Id']; ?>" 
                                            <?php if(isset($_POST['bloodtype']) && $_POST['bloodtype'] == $blood['Id'])
                                                    echo 'selected'; 
                                            ?>>
                                            <?php echo $blood['BloodType']; ?>
                                            </option>;
                                        <?php
                                        }
                                        ?>
                            </select>
                            <p style="color:red"><?php  echo empty($btErr) ? '' : '*'.$btErr; ?></p>
                        </div>

                        <div class="m-3 d-grid">
                            <button type="submit" class="btn btn-primary" name="submit">Add</button>
                        </div>
            </form>
        </div>
    </main>

<?php
include_once __DIR__.'/../layouts/footer.php';
?>