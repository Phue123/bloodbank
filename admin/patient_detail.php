<?php
include_once __DIR__."/../layouts/sidebar.php";
include_once '../controller/patientReqController.php';
include_once '../controller/bloodstockController.php';

$id=$_GET['id'];

 $pat_req=new patientReqController();

  $patients=$pat_req->getallPrequestbyid($id);
//   var_dump($patients);
$fee=$patients[0]['Fee'];

$req_id=$patients[0]['rid'];

$reqs=$pat_req->getreqs($req_id);

$rid=$reqs[0]['rid'];

$bs_con=new bloodstockController();

if(isset($_POST['submit'])){
    $date=date('Y-m-d');
    for($row=0;$row<sizeof($_POST['bloodtype']);$row++)
    {
        $hospitalss[$row][0]=$_POST['bloodtype'][$row];
        $bsid=$hospitalss[$row][0];
        // array_push($bsid_arr, $bsid);
        $result=$bs_con->addbloodstockbybs($rid,$bsid,$date,$fee);
        $result1=$bs_con->deleteblood($bsid);         
    }
    $insertPatient=$pat_req->createPatient($id,$date);
    echo "<script>location.href='donation.php'</script>";

}

?>

<main class="content">
     <div class="container">
            <h2 class="text-center text-danger text-uppercase">Patient Request Details</h2>
                    <form action="" method="post">
                        <?php
                        foreach($patients as $patient)
                        {
                        ?>
                        <div class="m-3">
                            <label for="" class="form-label">Patient Name</label>
                            <input type="text" name="cname" class="form-control" value="<?php echo $patient['Name'] ?>" disabled>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Address</label>
                            <input type="email" name="dept" class="form-control" value="<?php echo $patient['Address'] ?>" disabled>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="phone" name="phno" class="form-control" value="<?php echo $patient['PhNo'] ?>" disabled>
                        </div>

                        <div class="m-3">
                            <label for="" class="form-label">Hospital Name</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $patient['Hospital_Name'] ?>" disabled>
                        </div>
                        <?php
                        }
                        ?>


                        <div id="bloodstock">
                        <?php foreach($reqs as $req){ ?>    
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="form-label">Blood Type</label>
                                    <input type="text" name="btype[]"  class="form-control" value="<?php echo $req['bloodtype'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Qty</label>
                                    <input type="text" name="bqty[]" class="form-control" value="<?php echo $req['qty'] ?>">
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="" class="form-label">Blood Stock</label>
                                    <select name="bloodtype[]" id="bloods0" style="padding: 0.3rem;" multiple="multiple">
                                    <option value="" disabled selected>--SELECT BLOOD--</option>
                                        <?php
                                        $blood=$req['bid'];
                                        $bs_con=new bloodstockController();
                                        $bloodstocks=$bs_con->getbsbyblood($blood);
                                        foreach($bloodstocks as $bloodstock){
                                            ?>
                                            <option value="<?php echo $bloodstock['bsid']; ?>" 
                                            <?php if(isset($_POST['bloodtype']) && $_POST['bloodtype'] ==$bloodstock['bsid'])
                                                    echo 'selected'; 
                                                   ?>>
                                            <?php echo $bloodstock['code']; ?>
                                            </option>;
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    
                                </div>
                            
                            </div>
                       
                            <?php } ?>
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