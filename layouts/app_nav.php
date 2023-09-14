<?php 
session_start();
// if(empty($_SESSION['user_connected'])){
//   echo "<script>location.href='login.php'</script>";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blood Bank</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- fontawesome  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    
</head>
<body>
      <!-- navbar start  -->
      <div class="nav_header">
            <div class="bg-danger d-flex justify-content-between">
                <div class="ms-5 align-items-center">
                    <h6 class="text-light mt-3">Welcome to blood donation center.</h6>
                </div>
                <div>
                    <div class="d-flex me-3 mt-2">
                        <div class="me-2">
                            <a class="btn btn-outline-light btn-social btn-sm" href=""><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="me-2">
                        <a class="btn btn-outline-light btn-social btn-sm" href=""><i class="fab fa-facebook-f"></i></a>
                        </div>
                        <div class="me-2">
                        <a class="btn btn-outline-light btn-social btn-sm" href=""><i class="fab fa-youtube"></i></a>
                        </div>
                        <div>
                        <a class="btn btn-outline-light btn-social btn-sm" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
      

            <section class="header shadow ">
                <nav class="navbar navbar-expand-lg navbar-light bg-light ms-auto">

                    <div class="d-flex justify-content-center align-items-center ms-4">
                        <a href="#index.html" class="navbar-brand ms-3"><img src="img/logo.png" width="55px" height="55px"></a><h3 class="text-uppercase text-danger fw-bold display-5">Blood Bank</h3>
                    </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto text-dark text-uppercase fw-bold">
                        <li class="nav-item ms-3"><a href="index.php" class="nav-link">Home</a></li>
                        <li class="nav-item ms-3"><a href="index.php" class="nav-link">AboutUs</a></li>
                        <li class="nav-item ms-3"><a href="index.php" class="nav-link">Campaign</a></li>
                        <li class="nav-item ms-3"><a href="index.php" class="nav-link">Volunteers</a></li>
                        <li class="nav-item ms-3"><a href="index.php" class="nav-link">Contact</a></li>
                        <li class="nav-item ms-3 "><a href="history.php" class="nav-link dropdown">History</a></li>
                        <?php if(!isset($_SESSION['user_connected'])){ ?>
                        <li class="nav-item ms-3 "><a href="login.php" class="btn btn-dark dropdown">Login</a></li>
                        <?php }else{ ?>
                            <?php $id=$_SESSION['Id']; ?>
                            <div class="ms-3 dropdown">
                                <a href="change_password.php?id=<?php echo $id; ?>" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"><?php echo $_SESSION['Name'] ?></a>
                                <ul class="dropdown-menu">
                                    <li class=" nav-item"><a href="change_password.php?id=<?php echo $id; ?>" class="dropdown-item">Change Password</a></li>
                                    <li class="nav-item"><a href="logout.php" class="dropdown-item">Logout</a></li>
                                </ul>
                                
                            </div>
                        <?php } ?>
                    </ul>
                </div>

                </nav>
            </section>
        </div>
    <!-- navbar end -->  