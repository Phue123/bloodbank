<?php 
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__.'/../controller/patientReqController.php';

$patient_con=new patientReqController;
$patients=$patient_con->getpatientinfo();
?>
   <main class="content">
    <div class="container">
        <div class="row">
        <h2 class="text-center text-danger text-uppercase">Patient Infos</h2>
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Hospital Name</th>
                        <th>BloodType</th>
                        <th>Qty</th>
                        <th>Fee</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $count=1;
                    foreach($patients as $patient){
                        echo "<tr>";
                        echo "<td>" . $count++ ."</td>";
                        echo "<td>" . $patient['Name'] ."</td>";
                        echo "<td>" . $patient['Address'] ."</td>";
                        echo "<td>" . $patient['PhNo'] ."</td>";
                        echo "<td>" . $patient['Hospital_Name'] ."</td>";
                        echo "<td>" . $patient['BloodType'] ."</td>";
                        echo "<td>" . $patient['Qty'] ."</td>";
                        echo "<td>" . $patient['Fee'] ."</td>";
                        echo "<td>" . $patient['Date'] ."</td>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
   </main>
<?php
include_once __DIR__.'/../layouts/footer.php';
?>