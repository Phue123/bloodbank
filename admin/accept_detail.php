<?php
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__.'/../controller/bloodstockController.php';
include_once __DIR__.'/../controller/donorController.php';

$id=$_GET['id'];

$donar_con=new donarController();
$donor_reqs=$donar_con->getdonar_reqs($id);

$bs_con=new bloodstockController();
$bloods=$bs_con->getbloods();

if(isset($_POST['submit'])){
    if(empty($_POST['remark']) || empty($_POST['desp'])){
    
    if(empty($_POST['remark'])){
        $remarkErr="Please enter your remark";
    }
    if(empty($_POST['desp'])){
        $despErr="Please enter your description";
    }

   }else{
    $accept_id=$id;
    $remark=$_POST['remark'];
    $date=date("Ymd");
    $result=$donar_con->adddonars($accept_id,$date,$remark);
    if($result){
        $donars=$donar_con->getdonarbyacceptid($id);
        $donarid=$donars['id'];
        $bcode=rand(1000,9999);
        $ddate=$donars['Date'];
        $bloodtype=$donars['blood'];
        $description=$_POST['desp'];
        $result1=$bs_con->addbloodstock($bcode,$description,$ddate,$bloodtype,$donarid);
        if($result1){
            $restatus=$donar_con->restatus($id);
            if($restatus){
            echo "<script>location.href='donor_req.php'</script>";
            }
        }
    }
   }
}

?>

    <main class="content">
     <div class="container">
            <h2 class="text-center text-danger text-uppercase">Donor Request Details</h2>
                    <form action="" method="post">
                        <div class="m-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $donor_reqs['name']; ?>" disabled>
                            <p style="color:red"><?php  echo empty($nameErr) ? '' : '*'.$nameErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $donor_reqs['email'] ?>" disabled>
                            <p style="color:red"><?php echo empty($emailErr) ? '' : '*'.$emailErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="phone" name="phone" class="form-control" value="<?php echo $donor_reqs['phone'] ?>" disabled>
                            <p style="color:red"><?php  echo empty($phErr) ? '' : '*'.$phErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $donor_reqs['address'] ?>" disabled>
                            <p style="color:red"><?php  echo empty($addErr) ? '' : '*'.$addErr; ?></p>
                        </div>

                        <div class="m-3">
                        <label for="" class="form-label">Blood Type</label>
                            <input type="text" name="bloodtype" class="form-control" value="<?php echo $donor_reqs['bloodtype'] ?>" disabled>
                            <p style="color:red"><?php  echo empty($btErr) ? '' : '*'.$btErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Donor Remark</label>
                            <textarea type="text" name="remark" class="form-control"></textarea>
                            <p style="color:red"><?php  echo empty($remarkErr) ? '' : '*'.$remarkErr; ?></p>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Bloodstock Description</label>
                            <textarea type="text" name="desp" class="form-control"></textarea>
                            <p style="color:red"><?php  echo empty($despErr) ? '' : '*'.$despErr; ?></p>
                            
                        </div>

                        <div class="m-3 d-grid">
                            <button type="submit" class="btn btn-danger" name="submit">Submit</button>
                        </div>
            </form>
        </div>
    </main>
<?php
include_once __DIR__.'/../layouts/footer.php';
?>