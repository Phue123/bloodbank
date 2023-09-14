<?php

include_once '../layouts/sidebar.php';
include_once '../controller/patientReqController.php';
include_once '../controller/hospitalReqController.php';

$patient_req = new patientReqController();
$patients_trash = $patient_req->getpatientTrash();


$hospital_req = new hospitalReqController();
$hospitals_trash = $hospital_req->gethospitalTrash();

if (isset($_GET["action"])) {
var_dump($_GET["action"]);
    if ($_GET["action"] == "empty_patient") {
        $patient_req->clearAllTrash();
        echo '<script>window.location.href = "receiver_trash.php";</script>';
    } else if ($_GET["action"] == "empty_hospital") {
        $hospital_req->clearAllTrash();
        echo '<script>window.location.href = "receiver_trash.php";</script>';
    }
   
}
?>

<main class="content">
    <div class="container">
        <label class="toggle-switch trash-switch">
            <input type="checkbox" id="toggleButton">
            <script type="module" style="margin-top: -2rem;" src="https://unpkg.com/@splinetool/viewer@0.9.416/build/spline-viewer.js"></script>
            <spline-viewer url="https://prod.spline.design/KEjPKTCf-KkoQcou/scene.splinecode"></spline-viewer>
        </label>
        <div class="row" id="patientContent">
        <h4 class="text-center text-danger text-uppercase">Patient Trash</h4>
            <div class="trashcan">
                <a href="?action=empty_patient">
                    <i class="fa-regular fa-trash-can fa-2x"></i>
                </a>
            </div>
            <?php
            if (isset($_GET['status'])) {
                echo '<div>Successfully</div>';
            }
            ?>
            <table class="table table-striped" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Address</th>
                    <th>Phno</th>
                    <th>Hospital</th>
                    <th>Reason</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    if (isset($patients_trash)) {
                        foreach ($patients_trash as $patient) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $patient['Name'] . "</td>";
                            echo "<td>" . $patient['Address'] . "</td>";
                            echo "<td>" . $patient['PhNo'] . "</td>";
                            echo "<td>" . $patient['Hospital_Name'] . "</td>";
                            echo "<td>" . $patient['Qty'] . "</td>";
                            echo "<td>" . $patient['Reason'] . "</td>";
                            echo "<td id='" . $patient['Id'] . "'><button onclick='restorePatient(this)' data-patient-id='" . $patient['Id'] . "'  class='btn btn-success'>Restore</button>";
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="row" id="hospitalContent">
        <h2 class="text-center text-danger text-uppercase">Hospital Trash</h2>
            <div class="trashcan">
                <a href="?action=empty_hospital">
                    <i class="fa-regular fa-trash-can fa-2x"></i>
                </a>
            </div>
            <?php
            if (isset($_GET['status'])) {
                echo '<div>Successfully</div>';
            }
            ?>
            <table class="table table-striped" id="mytable6">
                <thead>
                    <th>No</th>
                    <th>Contact_Name</th>
                    <th>Dept</th>
                    <th>Address</th>
                    <th>Phno</th>
                    <th>Reason</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    if (isset($hospitals_trash)) {
                        foreach ($hospitals_trash as $hospital) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $hospital['Contact_Name'] . "</td>";
                            echo "<td>" . $hospital['Dept'] . "</td>";
                            echo "<td>" . $hospital['Address'] . "</td>";
                            echo "<td>" . $hospital['PhNo'] . "</td>";
                            echo "<td>" . $hospital['Reason'] . "</td>";
                            echo "<td id='" . $hospital['Id'] . "'><button onclick='restoreHospitalReq(this)' data-hospital-id='" . $hospital['Id'] . "'  class='btn btn-success'>Restore</button>";
                        }
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