<?php 
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__.'/../controller/donorController.php';

$donar_con=new donarController();
$donars=$donar_con->getdonarbydonar();
?>
   <main class="content">
    <div class="container">
        <div class="row">
        <h2 class="text-center text-danger text-uppercase">Donors</h2>
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Weight</th>
                        <th>Blood Type</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $count=1;
                    foreach($donars as $donar){
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $donar['name'] ."</td>";
                        echo "<td>" . $donar['email'] ."</td>";
                        echo "<td>" . $donar['phone'] ."</td>";
                        echo "<td>" . $donar['address'] ."</td>";
                        echo "<td>" . $donar['lb'] ."</td>";
                        echo "<td>" . $donar['bloodtype'] ."</td>";
                        echo "<td>" . $donar['date'] ."</td>";
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