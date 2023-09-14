<?php

include_once '../layouts/sidebar.php';
include_once '../controller/donationController.php';

if (empty($_SESSION['aEmail']) && empty($_SESSION['aLogged_in'])) {
    echo "<script>location.href='login.php'</script>";
}

$do_con = new donationController();
$doantions = $do_con->getdonation();
$others=$do_con->getOthers();

$pdoantions = $do_con->getdonationbypatient();
$pOthers=$do_con->getpOthers();


?>

<main class="content">
    <div class="container">
    <h2 class="text-center text-danger text-uppercase">Donations</h2>
        <label class="toggle-switch-donation">
            <input type="checkbox" id="toggleDonation">
            <script type="module" src="https://unpkg.com/@splinetool/viewer@0.9.416/build/spline-viewer.js"></script>
            <spline-viewer url="https://prod.spline.design/KEjPKTCf-KkoQcou/scene.splinecode"></spline-viewer>
        </label>
        <div class="row" id="hos_req">
            <h2 style="margin-top:1rem;">Hospital Donations</h2>
            <table class="table table-striped" id="mytable1">
                <thead>
                    <th>No</th>
                    <th>Contact Name</th>
                    <th>Donor Name</th>
                    <th>Blood Type</th>
                    <th>Date</th>

                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($doantions as $doantion) {

                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $doantion['cname'] . "</td>";
                        echo "<td>" . $doantion['dname'] . "</td>";
                        echo "<td>" . $doantion['btype'] . "</td>";
                        echo "<td>" . $doantion['date'] . "</td>";
                    }
                    ?>
                </tbody>
            </table>

            <h2>Others</h2>
            <table class="table table-striped" id="mytable2">
                <thead>
                    <th>No</th>
                    <th>Contact Name</th>
                    <th>Others' Name</th>
                    <th>Blood Type</th>
                    <th>Date</th>

                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($others as $other) {

                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $other['cname'] . "</td>";
                        echo "<td>" . $other['Oname'] . "</td>";
                        echo "<td>" . $other['btype'] . "</td>";
                        echo "<td>" . $other['date'] . "</td>";
                    }
                    ?>
                </tbody>
            </table>

        </div>




    </div>
    <div class="container">
        <div class="row" id="patient_req">
            <h2 style="margin-top:1rem;">Patient Donations</h2>

            <table class="table table-striped" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Contact Name</th>
                    <th>Donor Name</th>
                    <th>Blood Type</th>
                    <th>Date</th>

                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($pdoantions as $pdoantion) {

                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $pdoantion['pname'] . "</td>";
                        echo "<td>" . $pdoantion['dname'] . "</td>";
                        echo "<td>" . $pdoantion['btype'] . "</td>";
                        echo "<td>" . $pdoantion['date'] . "</td>";
                    }
                    ?>
                </tbody>
            </table>


            <h2>Others</h2>
            <table class="table table-striped" id="mytable3">
                <thead>
                    <th>No</th>
                    <th>Contact Name</th>
                    <th>Others Name</th>
                    <th>Blood Type</th>
                    <th>Date</th>

                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($pOthers as $pOther) {

                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $pOther['pname'] . "</td>";
                        echo "<td>" . $pOther['Oname'] . "</td>";
                        echo "<td>" . $pOther['btype'] . "</td>";
                        echo "<td>" . $pOther['date'] . "</td>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
include_once __DIR__ . "/../layouts/footer.php";
?>