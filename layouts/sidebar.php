<?php
session_start();
if(empty($_SESSION['admin_connected'])){
  echo "<script>location.href='login.php'</script>";
}
if(isset($_POST['submit'])){
  if(isset($_POST['year'])){
  $year = $_POST['year'];
  $_SESSION['year']=$year; 
  // echo $year;
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Blood Bank
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4194aa8b0e.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="../assets/css/mycss.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/toggle.css">
  <link rel="stylesheet" href="../assets/css/bs_toggle.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <style>

.dataTables_filter label{
  display:none;
}

.dash_title{
  text-align: center;
  font-size:2rem;
  margin-top:1.5rem;
  color: #ff8f33;
}

.trash-switch{
    margin-top: -2.5rem;
    margin-left:-2rem;
    margin-bottom: -1.7rem;
}
  </style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../img/logo.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          Blood Bank
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "index.php" ? "active" : "";?>">
            <a href="./index.php">
              <i class="nc-icon nc-bank"></i>
              <p class="fw-bold fs-6">Dashboard</p>
            </a>
          </li>


          <!-- Request Dropdown  -->
          <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle fw-bold fs-6" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-clipboard"></i>
                Requests
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <ul class="list-unstyled">
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == "donor_req.php" ? "active" : "";?>">
                      <a href="donor_req.php">
                        <!-- <i class="nc-icon nc-diamond"></i> -->
                        <!-- <i class="fa-solid fa-user"></i> -->
                        <i class="fa-solid fa-clipboard"></i>
                        <p class="fw-bold fs-6">Donar Requests</p>
                      </a>
                    </li>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == "hospital_req.php" ? "active" : "";?>">
                      <a href="hospital_req.php">
                        <!-- <i class="nc-icon nc-diamond"></i> -->
                        <i class="fa-solid fa-hospital"></i>
                        <p class="fw-bold fs-6">Hospital Requests</p>
                      </a>
                    </li>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == "patient_req.php" ? "active" : "";?>">
                        <a href="patient_req.php">
                          <i class="fas fa-hospital-user"></i>
                          <p class="fw-bold fs-6">Patient Requests</p>
                        </a>
                    </li>
                  </ul>
                </div>
          </li>
          <!-- Request Dropdown  -->

          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "donor.php" ? "active" : "";?>">
            <a href="donor.php">
              <!-- <i class="nc-icon nc-diamond"></i> -->
              <i class="fa-solid fa-users"></i>
              <p class="fw-bold fs-6">Donars</p>
            </a>
          </li>

          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "bloodstock.php" ? "active" : "";?>">
            <a href="bloodstock.php">
              <!-- <i class="nc-icon nc-diamond"></i> -->
              <i class="fa-solid fa-droplet"></i>
              <p class="fw-bold fs-6">BloodStock</p>
            </a>
          </li>


          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "others.php" ? "active" : "";?>">
            <a href="others.php">
              <!-- <i class="nc-icon nc-diamond"></i> -->
              <i class="fa-solid fa-layer-group"></i>
              <p class="fw-bold fs-6">Others</p>
            </a>
          </li>
          
          
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "donation.php" ? "active" : "";?>">
            <a href="donation.php">
              <i class="fas fa-heart"></i>
              <p class="fw-bold fs-6">Donations</p>
            </a>
          </li>


          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "patient.php" ? "active" : "";?>">
            <a href="patient.php">
              <!-- <i class="nc-icon nc-diamond"></i> -->
              <i class="fa-solid fa-hospital-user"></i>
              <p class="fw-bold fs-6">Patients</p>
            </a>
          </li>

          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "hospital.php" ? "active" : "";?>">
            <a href="hospital.php">
              <!-- <i class="nc-icon nc-diamond"></i> -->
              <i class="fa-solid fa-hospital"></i>
              <p class="fw-bold fs-6">Hospitals</p>
            </a>
          </li>
                 
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "Post.php" ? "active" : "";?>">
            <a href="Post.php">
              <i class="fas fa-plus-circle"></i>
              <p class="fw-bold fs-6">Post</p>
            </a>
          </li>
          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "contact.php" ? "active" : "";?>">
            <a href="contact.php">
              <i class="fas fa-envelope-square"></i>
              <p class="fw-bold fs-6">Contact</p>
            </a>
          </li>

          <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle fw-bold fs-6" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Trash
                  <i class="fas fa-trash"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <ul class="list-unstyled">
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == "trash.php" ? "active" : "";?>">
                      <a href="trash.php">
                        <i class="fas fa-trash"></i>
                        <p class="fw-bold fs-6">Donor Trash</p>
                      </a>
                    </li>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == "receiver_trash.php" ? "active" : "";?>">
                      <a href="receiver_trash.php">
                        <i class="fas fa-trash-alt"></i>
                        <p class="fw-bold fs-6">Receiver Trash</p>
                      </a>
                    </li>
                  </ul>
                </div>
          </li>


          <li class="<?php echo basename($_SERVER['PHP_SELF']) == "logout.php" ? "active" : "";?>">
            <a href="logout.php">
              <i class="fas fa-sign-out"></i>
              <p class="fw-bold fs-6">Logout</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>

    <!-- Navbar -->
    <div class="main-panel">
     
    <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Admin Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form method="POST" >
              <div class="input-group no-border">
                
                  <input type="text" value="" class="form-control" id="searchBox" name="year" placeholder="Search...">
                 
                  <i class="mdi mdi-magnify mdi-18px"></i>
                <div class="input-group-append">
                  <div class="input-group-text">
                   
                    <button style="background:transparent;color:black;border:none;" type="submit" name="submit"><i class="nc-icon nc-zoom-split">  </i></button> 
                  
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="javascript:;">
                  <!-- <i class="nc-icon nc-layout-11"></i> -->
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <?php if(!empty($_SESSION['admin_connected'])){ ?>
                <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p class="text-primary" style="font-size: 25px;"> <?php echo $_SESSION['aName']; ?></p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <?php $id=$_SESSION['aId']; ?>
                  <a class="dropdown-item" href="change_password.php?id=<?php echo $id; ?>">Change Password</a>
                </div>
              </li>
                <?php
              }
                  ?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <script>
        // let datas="[{"month":"August","YEAR":"2023","record_count":1}]";
        
//         function submitForm() {
//             // e.preventDefault();
//         console.log('ok')
//         var formData = new FormData(document.getElementById("myForm"));
//         var xhr = new XMLHttpRequest();
        
//         xhr.open("POST", "../admin/dashdata.php", true);
        
//         xhr.onreadystatechange = function() {
//     try {
//         if (xhr.readyState === 4) {
//             if (xhr.status === 200) {
//                 console.log('here?');
//                 console.log(xhr.responseText);
//                 datas=xhr.responseText;
               
               
             
//             } else {
//                 console.error("HTTP Error: " + xhr.status + " " + xhr.statusText);
//             }
//         }
//     } catch (error) {
//         console.error("JavaScript Error: " + error);
//     }
// };
//         xhr.send(formData);
// }


       


      </script>

      