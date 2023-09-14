<?php
include_once '../layouts/sidebar.php';
include_once '../controller/bloodstockController.php';
include_once '../controller/donorController.php';
include_once '../controller/donationController.php';
include_once '../controller/patientReqController.php';
include_once '../controller/hospitalReqController.php';
include_once '../controller/othersController.php';



$bloodtype_cont = new bloodstockController;
$donor_con=new donarController();
$donate_con=new donationController();
$patients_con=new patientReqController();
$hospitals_con=new hospitalReqController();
$others_con=new othersController();

$bloodnums=$bloodtype_cont->getnoofblood();
$donors=$donor_con->countdonor();
$don_no=$donor_con->getdonor_req();
$donations=$donate_con->countDonate();
$patients=$patients_con->countPatient();
$pat_requests=$patients_con->countpatientsrequests();
$hospitals=$hospitals_con->countHospital();
$hos_requests=$hospitals_con->counthosrequests();
$others=$others_con->countOther();


?>
    
      <div class="content">

        <div class="row">
          <?php
          foreach($bloodnums as $bloodnum){
          ?>
            <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                      <div class="icon-big text-center icon-warning mt-3">
                        <i class="fa-solid fa-droplet text-danger"></i>
                      </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div>
                      <p class="card-category">BloodType</p>
                      <h2 class="card-title"><?php echo $bloodnum['bloodtype']; ?><h2>
                      <h5 class="text-center"><?php echo $bloodnum['total'] ?></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              </div>
                  <?php
                  }
                  ?>
              </div>
        </div>

        <div class="row m-3">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-user text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Donors</p>
                      <p class="card-title"><?php echo $donors['total'] ?><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-hospital-user text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Patients</p>
                      <p class="card-title"><?php echo $patients['total'] ?><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  Last day
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-hospital text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Hospitals</p>
                      <p class="card-title"><?php echo $hospitals['total'] ?><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  In the last hour
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fa-solid fa-user-plus text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Other Donors</p>
                      <p class="card-title"><?php echo $others['total'] ?><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update now
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-9 col-md-8">
                      <div>
                        <p>Total Donor Requests</p>
                      </div>
                  </div>
                  <div class="col-3 col-md-4">
                    <div>
                      <div class="text-center icon-warning">
                          <i class="fa-solid fa-users text-primary"></i>
                          <?php  echo $don_no['total_count']  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>      
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-9 col-md-8">
                      <div>
                        <p>Total Hospital Requests</p>
                      </div>
                  </div>
                  <div class="col-3 col-md-4">
                    <div>
                      <div class="text-center icon-warning">
                      <i class="fa-solid fa-spinner text-primary"></i>
                      <?php  echo $hos_requests['total']  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>      
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-9 col-md-8">
                      <div>
                        <p>Total Patient Request</p>
                      </div>
                  </div>
                  <div class="col-3 col-md-4">
                    <div>
                      <div class="text-center icon-warning">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        <?php echo $pat_requests['total_count']  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>      
          </div>
       </div>
        </div>

      <div class="dash_title">
      <?php if (isset($_SESSION['year'])) {
        $year = $_SESSION['year'];
        if (is_numeric($year)) {
       echo "Monthly Donations for Year - $year";
        }else{
          $year = date('Y');
          echo "Monthly Donations for Default Year - $year";
        }
} else {
  $year = date('Y');
    echo "Monthly Donations for Default Year - $year";
} ?>
      </div>
   
        <canvas id="monthly-donations"></canvas> 

      <div class="dash_title">
        <?php if (isset($_SESSION['year'])) {
        $year = $_SESSION['year'];
        if (is_numeric($year)) {
        echo "Monthly Fees for Year - $year";
        }else{
          $year = date('Y');
          echo "Monthly Fees for Default Year - $year";
        }
} else {
  $year = date('Y');
    echo "Monthly Donations for Default Year - $year";
}  ?>

</div>
    
        <canvas id="monthly-fees"></canvas> 

        <!-- <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-9 col-md-8">
                      <div>
                        <p>Total Donor Requests</p>
                      </div>
                  </div>
                  <div class="col-3 col-md-4">
                    <div>
                      <div class="text-center icon-warning">
                          <i class="fa-solid fa-users text-primary"></i>
                          <?php  echo $don_no['total_count']  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>      
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-9 col-md-8">
                      <div>
                        <p>Total Donor</p>
                      </div>
                  </div>
                  <div class="col-3 col-md-4">
                    <div>
                      <div class="text-center icon-warning">
                      <i class="fa-solid fa-spinner text-primary"></i>
                      <?php  echo $donor_amt['total_count']  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>      
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-9 col-md-8">
                      <div>
                        <p>Donations</p>
                      </div>
                  </div>
                  <div class="col-3 col-md-4">
                    <div>
                      <div class="text-center icon-warning">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        <?php echo $donations['total_count']  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>      
          </div>
       </div>
        </div> -->
      
<?php
  include_once '../layouts/footer.php';
?>
