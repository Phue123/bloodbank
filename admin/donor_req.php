<?php

include_once '../layouts/sidebar.php';
include_once '../controller/donorController.php';

$donar_req=new donarController();
$donars=$donar_req->getalldonar();

?>

<main class="content">
    <div class="container">
        <div class="row">
        <h2 class="text-center text-danger text-uppercase">Donor Requests</h2>
            <?php
            if(isset($_GET['status'])){
                echo '<div>Successfully</div>';
            }
            ?>
            <table class="table" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phno</th>
                    <th>BloodType</th>
                    <th>Weight</th>
                    <th>Status</th>
                    <th>Email_Status</th>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach($donars as $donar){
                        if($donar['deleted_at']==0 && $donar['status'] ==0){
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $donar['name'] ."</td>";
                        echo "<td>" . $donar['email'] ."</td>";
                        echo "<td>" . $donar['address'] ."</td>";
                        echo "<td>" . $donar['phno'] ."</td>";
                        echo "<td>" . $donar['bloodtype'] ."</td>";
                        echo "<td>" . $donar['lb'] ."</td>";
                        if($donar['status']==1){
                            echo "<td id='".$donar['Id']."'class='d-flex'><a href='accept_detail.php?id=".$donar['Id']."' class='btn btn-success' disabled>Confirm</a><button onclick='rmvDonor(this)' data-donor-id='".$donar['Id']."' class='btn btn-danger reject_donar'>Reject</button>";
                        }else{
                            echo "<td id='".$donar['Id']."' class='d-flex'><a href='accept_detail.php?id=".$donar['Id']."' class='btn btn-success float-start'>Confirm</a><button onclick='rmvDonor(this)' data-donor-id='".$donar['Id']."' class='btn btn-danger reject_donar'>Reject</button>";
                        }
                        if($donar['email_status']==0){
                        echo "<td id='".$donar['Id']."'><a href='accept_donor.php?id=".$donar['Id']."' class='btn btn-info'>Accept</a></td>";
                        }else{
                            echo "<td><a class='btn btn-info' disabled>Accept</a></td>";
                        }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
include_once __DIR__."/../layouts/footer.php";
?>


