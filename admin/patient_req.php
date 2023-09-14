<?php
// session_start();
include_once '../layouts/sidebar.php';
include_once '../controller/patientReqController.php';

$pat_req=new patientReqController();
$patients=$pat_req->patientRequests();
?>

<main class="content">
    <div class="container">
        <div class="row">
        <h2 class="text-center text-danger text-uppercase">Patient Requests</h2>
        
            <table class="table table-striped" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>PhNo</th>
                    <th>Hospital</th>
                    <th>Blood Type</th>
                    <th>Reason</th>
                    <th>Actions</th>

                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach($patients as $patient){
                       if($patient['deleted_at']==0){

                       
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $patient['Name'] ."</td>";
                        echo "<td>" . $patient['Address'] ."</td>";
                        echo "<td>" . $patient['PhNo'] ."</td>";
                        echo "<td>" . $patient['Hospital_Name'] ."</td>";
                        echo "<td>" . $patient['BloodType'] ."</td>";

                        // echo "<td>" . $patient['Qty'] ."</td>";
                        echo "<td>" . $patient['Reason'] ."</td>";
                        // echo "<td>" . $patient['Fee'] ."</td>";

                         echo "<td id='".$patient['Patient_Id']."' class='d-flex'><a href='patient_detail.php?id=".$patient['Patient_Id']."' class='btn btn-success'>Request Details</a>  <button class='btn btn-danger reject_patient'>Reject</button>";
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


