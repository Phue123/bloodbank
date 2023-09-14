<?php 
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__.'/../controller/bloodstockController.php';

$bs_con=new bloodstockController();
$bloods=$bs_con->getbloodbybs();
$others=$bs_con->getbloodbybsother();

?>
   <main class="content">
    <div class="container">
    <label class="toggle-switch-stock">
            <input type="checkbox" id="toggleStock">
            <script type="module" src="https://unpkg.com/@splinetool/viewer@0.9.416/build/spline-viewer.js"></script>
            <spline-viewer url="https://prod.spline.design/KEjPKTCf-KkoQcou/scene.splinecode"></spline-viewer>
        </label>
        <h2 class="text-center text-danger text-uppercase">BloodStock</h2>
    
        <div class="row" id="donor_stock">
            <h3 class="text-danger">Donars</h3>
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Blood Type</th>
                       
                        <th>Donar Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach($bloods as $blood){
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $blood['Code'] ."</td>";
                        echo "<td>" . $blood['Description'] ."</td>";
                        echo "<td>" . $blood['Date'] ."</td>";
                        echo "<td>" . $blood['blood'] ."</td>";
                        echo "<td>" . $blood['dname'] ."</td>";

                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="row" id="other_stock">
        <!-- <div class="row" >
        <div class="col-md-3">
            <a href="addbloodstock.php" class="btn btn-success">Add Other Donors</a>
        </div>
        </div> -->
            <h3 id="donr">Other Donors</h3>
            <table class="table table-striped" id="mytable4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Blood Type</th>
                        <th>Others Name</th>
                        <th>NRC</th>
                        <th>Other Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    foreach($others as $other){
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $other['Code'] ."</td>";
                        echo "<td>" . $other['Description'] ."</td>";
                        echo "<td>" . $other['Date'] ."</td>";
                        echo "<td>" . $other['blood'] ."</td>";
                        echo "<td>" . $other['other'] ."</td>";
                        echo "<td>" . $other['nrc'] ."</td>";
                        echo "<td>" . $other['address'] ."</td>";

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