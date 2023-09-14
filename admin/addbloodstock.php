<?php
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__."/../controller/bloodstockController.php";
include_once __DIR__."/../controller/othersController.php";

    $date=$_SESSION['date'];
    $bloodtype=$_SESSION['bloodtype'];
    $othername=$_SESSION['othername'];

$bs_con=new bloodstockController();
$bloods=$bs_con->getblood();

$other_con=new othersController();
$others=$other_con->getothersinfo();

$code=rand(0000,9999);
if(isset($_POST['submit'])){
    if( empty($_POST['desp'])){

    if(empty($_POST['desp'])){
        $despErr='Please fill your desption';
    }

   }else{

    $code=$_POST['code'];
    $description=$_POST['desp'];
    $date=$_SESSION['date'];
    $bloodtype=$_SESSION['bloodtype_id'];
    $other=$_SESSION['otherId'];
    $result=$other_con->addothers($code,$description,$date,$bloodtype,$other);
    if($result){
        echo '<script>location.href="bloodstock.php"</script>';
    }

    }
   }

?>
<main class="content">
    <div class="container">
      <div>
      <?php if(isset($timeerror)) echo "<p class='bgp rounded text-center p-2'>".$timeerror."</p>" ?>
      </div>
        <form action="" method="post">
            <div class="mt-3">
                <label for="" class="form-label">Code</label>
                <input type="text" name="code" class="form-control" value="<?php echo $code; ?>">
            </div>
            <div class="mt-3">
                <label for="" class="form-label">Bloodstock Description</label>
                <input type="text" name="desp" class="form-control" value="<?php if(isset($description)) echo $description; ?>">
                <p style="color:red"><?php  echo empty($despErr) ? '' : '*'.$despErr; ?></p>

            </div>
            <div class="mt-3">
                <label for="" class="form-label">Date</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['date'];?>" disabled>
            </div>

            <div class="mt-3">
                <label for="" class="form-label">BloodType</label>
                <input type="text" class="form-control" value="<?php if(isset($bloodtype)) echo $bloodtype ;?>" disabled>
            </div>

            <div class="mt-3">
                <label for="" class="form-label">Other Name</label>
                <input type="text" class="form-control" value="<?php if(isset($othername)) echo $othername ;?>" disabled>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
       
    </div>
   </main>
<?php
include_once __DIR__.'/../layouts/footer.php';
?>