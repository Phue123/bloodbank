<?php

include_once '../layouts/sidebar.php';
include_once '../controller/donorController.php';

$donar_req=new donarController();
$donars_trash=$donar_req->getdonortrash();

if (isset($_GET["action"]) && $_GET["action"] == "empty_donor") {
    $donar_req->clearAllTrash();
}
?>

<main class="content">
    <div class="container">
        <div class="row">
        <h2 class="text-center text-danger text-uppercase">Donor Trash</h2>
            <div class="trashcan">
            <a href="?action=empty_donor">
                <i class="fa-regular fa-trash-can fa-2x"></i>
            </a>
            </div>
            <?php
            if(isset($_GET['status'])){
                echo '<div>Successfully</div>';
            }
            ?>
            <table class="table table-striped" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phno</th>
                    <th>Weight</th>
                    <th>Restore</th>
                    <!-- <th>Status</th>
                    <th>Email_Status</th> -->
                </thead>
                <tbody>
                    <?php
                    $count=1;
                    if(isset($donars_trash)){
                        foreach($donars_trash as $donar_trash){
                            echo "<tr>";
                            echo "<td>" .$count++. "</td>";
                            echo "<td>" . $donar_trash['NAME'] ."</td>";
                            echo "<td>" . $donar_trash['email'] ."</td>";
                            echo "<td>" . $donar_trash['address'] ."</td>";
                            echo "<td>" . $donar_trash['phno'] ."</td>";
                            echo "<td>" . $donar_trash['lb'] ."</td>";
                            echo "<td id='".$donar_trash['Id']."'><button onclick='restore(this)' data-donor-id='".$donar_trash['Id']."'  class='btn btn-success'>Resotre</button>";
                            // if($donar_trash['email_status']==0){
                            // // echo "<td id='".$donar_trash['Id']."'><a href='accept_donor.php?id=".$donar_trash['Id']."' class='btn btn-info'>Accept</a></td>";
                            // }else{
                            //     echo "<td><a class='btn btn-info' disabled>Accept</a></td>";
                            // }
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


