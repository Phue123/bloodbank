<?php
include_once __DIR__."/layouts/app_nav.php";
include_once __DIR__."/controller/donorController.php";

if(empty( $_SESSION['user_connected'])){
    $message="Not a member?  ";
}else
{
    $lid=$_SESSION['Id'];
    $donar_req=new donarController();
    $donars=$donar_req->getdonar($lid);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <!-- <div class="container mt-5">
        <h1 class="text-center text-uppercase mb-5">Thank you for being a life-saving blood donor.</h1>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div>
                     <img src="img/i1.jpg" alt="" class="img-fluid">
                </div>
                <h6 class="text-uppercase text-center mt-2">"Give the gift of life: Donate blood, be a hero in someone's story."</h6>
                <h6 class="text-danger text-center mt-3" style="cursor: pointer;">Read More <span>___________</span></h6>
            </div>

            <div class="col-lg-3 col-md-6">
                <div >
                     <img src="img/i2.jpg" alt="" class="img-fluid">
                </div>
                <h6 class="text-uppercase text-center mt-2">We Have Amazing Campaign for Blood Donor</h6>
                <h6 class="text-danger text-center mt-3" style="cursor: pointer;">Read More <span>___________</span></h6>
            </div>

            <div class="col-lg-3 col-md-6">
                <div>
                     <img src="img/i3.jpg" alt="" class="img-fluid">
                </div>
                <h6 class="text-uppercase text-center mt-2">Donate Blood And Save Life Be a hero</h6>
                <h6 class="text-danger text-center mt-3" style="cursor: pointer;">Read More <span>___________</span></h6>
            </div>

            <div class="col-lg-3 col-md-6">
                <div>
                     <img src="img/i9.jpg" alt="" class="img-fluid">
                </div>
                <h6 class="text-uppercase text-center mt-2">We Have Amazing Campaign for Blood Donor</h6>
                <h6 class="text-danger text-center mt-3" style="cursor: pointer;">Read More <span>___________</span></h6>
            </div>
        </div>
    </div> -->

    <div class="container mt-5">
        <div class="row">
            <h2 class="text-center text-uppercase">My History</h2>
            <p class="text-info text-center mt-4"><?php if(isset($message)) echo $message."<a href='login.php' class='link-underline link-underline-opacity-0'>Login</a>" ?></p>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>BloodType</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($donars)){
                    $count=1;
                    foreach($donars as $donar){
                        echo "<tr>";
                        echo "<td>" . $count++. "</td>";
                        echo "<td>" .$donar['name']. "</td>";
                        echo "<td>" .$donar['email']. "</td>";
                        echo "<td>" .$donar['phone']. "</td>";
                        echo "<td>" .$donar['address']. "</td>";
                        echo "<td>" .$donar['bloodtype']. "</td>";
                        echo "<td>" .$donar['date']. "</td>";
                        echo "</tr>";
                    }
                }
                     ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
include_once __DIR__."/layouts/app_footer.php";
?>