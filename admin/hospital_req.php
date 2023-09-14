<?php

include_once '../layouts/sidebar.php';
include_once '../controller/hospitalReqController.php';

$hos_req=new hospitalReqController();
$hospitals=$hos_req->getallhrequest();

?>

<main class="content">
    <div class="container">
        <div class="row">
        <h2 class="text-center text-danger text-uppercase">Hospital Requests</h2>
        
            <table class="table table-striped" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Contact Name</th>
                    <th>Department</th>
                    <th>Address</th>
                    <th>PhNo</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    $count=1;

                    foreach($hospitals as $hospital){
                       if($hospital['deleted_at']==0 && $hospital['Status']==0){
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $hospital['Contact_Name'] ."</td>";
                        echo "<td>" . $hospital['Dept'] ."</td>";
                        echo "<td>" . $hospital['Address'] ."</td>";
                        echo "<td>" . $hospital['PhNo'] ."</td>";
                        echo "<td id='".$hospital['Id']."'><a href='request_detail.php?id=".$hospital['Id']."' class='btn btn-success request'>Request Details</a>  
                        <button class='btn btn-danger reject_hospital'>Reject</button>";
                        echo "</tr>";
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


