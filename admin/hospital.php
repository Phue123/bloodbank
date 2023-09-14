<?php 
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__.'/../controller/hospitalReqController.php';

$hospital_con=new hospitalReqController();
$hospitals=$hospital_con->gethospitalinfo();
?>
   <main class="content">
    <div class="container">
        <div class="row">
        <h2 class="text-center text-danger text-uppercase">Hospital Infos</h2>
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Contact Name</th>
                        <th>Department</th>
                        <th>BloodType</th>
                        <th>Qty</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $count=1;
                    foreach($hospitals as $hospital){
                        echo "<tr>";
                        echo "<td>" . $count++ ."</td>";
                        echo "<td>" . $hospital['Contact_Name'] ."</td>";
                        echo "<td>" . $hospital['Dept'] ."</td>";
                        echo "<td>" . $hospital['bloodtype'] ."</td>";
                        echo "<td>" . $hospital['qty'] ."</td>";
                        echo "<td>" . $hospital['Address'] ."</td>";
                        echo "<td>" . $hospital['PhNo'] ."</td>";
                        echo "<td>" . $hospital['Date'] ."</td>";
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