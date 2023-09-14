<?php
session_start();
include_once __DIR__.'/controller/contactController.php';
include_once __DIR__.'/controller/PostController.php';
include_once __DIR__.'/controller/contactController.php';
include_once __DIR__.'/controller/registerController.php';
include_once __DIR__.'/controller/donorController.php';
include_once __DIR__.'/controller/bloodstockController.php';

    $contact_con=new contactController();
    $contacts=$contact_con->getcontact();
    if(isset($_POST['send'])){
      if(empty($_POST['name']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['phone']) || !preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['phone']) || empty($_POST['message'])){
         if(empty($_POST['name'])){
          $nameError="Please fill your name";
         }
         if(empty($_POST['email'])){
          $emailError="Please fill your email";
         }
         if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $typeemail='Invalid your email type';
        }
         if(empty($_POST['phone'])){
          $phoneError="Please fill your phone";
         }
         if(!preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['phone'])){
          $typephNoerror='Invalid phone number type';
         }   
         if(empty($_POST['message'])){
          $messageError="Please fill your message";
         }
      }else{
        $message='successs';
            $name=$_POST['name'];
            $email=$_POST['email'];
            $phone=$_POST['phone'];
            $message=$_POST['message'];
            $result=$contact_con->addcontact($name,$email,$phone,$message);
            if($result){
              echo "<script type='text/javascript'>alert('Thank you! for your recommand.');</script>";
                // echo '<script>location.href=index.php</script>';
                header("Refresh:0");
            }
          }
    }

    $post_con = new PostController();
    $posts = $post_con->getPost();

    $register_con=new registerController();
    $registers=$register_con->countregisters();
   
    $donor_con=new donarController();
    $donors=$donor_con->countdonorsbyreports();

    $others=$donor_con->countotherdonorsbyreports();
   
    $blood_con=new bloodstockController();
    $bloodstocks=$blood_con->countbloodstocks();
    
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
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    
</head>
<body>
      <!-- navbar start  -->
      <div class="nav_header fixed-top">
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
                        <li class="nav-item ms-3"><a href="#aboutus" class="nav-link">AboutUs</a></li>
                        <li class="nav-item ms-3"><a href="#campaigns" class="nav-link">Campaign</a></li>
                        <li class="nav-item ms-3"><a href="#volunteers" class="nav-link">Volunteers</a></li>
                        <li class="nav-item ms-3"><a href="#contact" class="nav-link">Contact</a></li>
                        <li class="nav-item ms-3 "><a href="history.php" class="nav-link dropdown">History</a></li>
                        <?php if(empty($_SESSION['user_connected'])){ ?>
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

      <!-- start page section  -->
       <section class="banner">
            <div class="banner_text text-center">
                <h2 class="display-4 fw-bold text-uppercase">Donate Blood and Get Real Blessings.</h2>
                <p class="lead fw-bold">Blood is the most precious gift that anyone can give to another person.</p>
                <p class="lead fw-bold">Donating blood not only saves the life also save donor's lives</p>
                <a href="#contact" class="btn btn-dark text-light lg-btn">Get Donation</a>
            </div>
       </section>

       <!-- end page section  -->




    <!-- aboutus section start  -->
    <section id="aboutus">
        <div class="container-fluid p-5 mb-4">

            <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-sm-12 pt-2 align-items-start">
                    
                    <h2 class="fw-bold text-center text-danger">Learn About Donation</h2>
                    <h3 class="fw-semibold bg-danger text-light p-2">Compatible Blood Type Donors</h3>
                    
                      <table class="table table-sm mx-auto table-stripe-danger">
                        <thead>
                            <tr>
                              <th>Blood Type</th>
                              <th>Donate Blood To</th>
                              <th>Receive Blood From</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-danger fw-bold">A+</td>
                            <td>A+ AB+</td>
                            <td>A+ A- O+ O-</td>
                          </tr>
                          <tr>
                            <td class="text-danger fw-bold">O+</td>
                            <td>O+ A+ B+ AB+</td>
                            <td>O+ O-</td>
                          </tr>
                          <tr>
                            <td class="text-danger fw-bold">B+</td>
                            <td>B+ AB+</td>
                            <td>B+ B- O+ O-</td>
                          </tr>
                          <tr>
                            <td class="text-danger fw-bold">AB+</td>
                            <td>AB+</td>
                            <td>Everyone</td>
                          </tr>
                          <tr>
                            <td class="text-danger fw-bold">A-</td>
                            <td>A+ A- AB+ AB-</td>
                            <td>A- O-</td>
                          </tr>
                          <tr>
                            <td class="text-danger fw-bold">O-</td>
                            <td>Everyone</td>
                            <td>O-</td>
                          </tr>
                          <tr>
                            <td class="text-danger fw-bold">B-</td>
                            <td>B+ B- AB+ AB-</td>
                            <td>B- O-</td>
                          </tr>
                          <tr>
                            <td class="text-danger fw-bold">AB-</td>
                            <td>AB+ AB-</td>
                            <td>AB- A- B- O-</td>
                          </tr>

                        </tbody>
                      </table>
                        </div>

                <div class="col-md-6 col-sm-12 mt-4">
                    <div class="d-flex justify-content-center">
                        <!-- <img src="img/bg5.jpg" alt="controls" width="400px" height="400px" class="bg2"> -->
                        <!-- <h1>My YouTube Video</h1> -->
                       <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID_HERE" frameborder="0" allowfullscreen></iframe> -->
                        <iframe width="930" height="400" src="https://www.youtube.com/embed/Tfwq_vJHwT8" title="What happens to donated blood?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div> 
            </div>
        </div>

    </section>
    <!-- aboutus section end  -->
      <!-- count section  -->
<!-- 
    <div id="triggerPointRegistered" style="height: 1px;"></div>
    <div id="triggerPointDonors" style="height: 1px;"></div>
    <div id="triggerPointBloodStock" style="height: 1px;"></div>

    <div class="container-fluid d-flex justify-content-center mt-3" style="background-color:#f2f2f2;">
        <div class="row mt-5 m-5">
            <div class="col-lg-4 col-md-12 mt-3">
                <div class="card bg-primary" style="width:200px;height:200px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <h3><i class="fa-solid fa-circle-exclamation text-light"></i></h3>
                        </div>
                        <h1 class="card-title text-center text-light" id="registeredCount">0</h1>
                        <h3 class="card-title text-center text-light">Registered</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mt-3">
                <div class="card bg-warning" style="width:200px;height:200px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <h3><i class="fa-solid fa-users align-center text-light"></i></h3>
                        </div>
                        <h1 class="card-title text-center text-light" id="donorsCount">0</h1>
                        <h3 class="card-title text-center text-light">Donors</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mt-3">
                <div class="card bg-danger" style="width:200px;height:200px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <h3><i class="fa-solid fa-droplet text-light"></i></h3>
                        </div>
                        <h1 class="card-title text-center text-light" id="bloodStockCount" >0</h1>
                        <h3 class="card-title text-center text-light">Blood Stock Collection</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var registeredCount = <?php echo $registers['count']; ?>;
        var donorsCount = <?php echo $donors['count']+$others['count']; ?>;
        var bloodStockCount = <?php echo $bloodstocks['count']; ?>;
        var step = 1;

        function countUp(targetId, finalValue) {
            var targetElement = document.getElementById(targetId);
            var currentCount = 0;
            function updateCount() {
                if (currentCount < finalValue) {
                    currentCount += step;
                    targetElement.innerHTML = currentCount;
                    setTimeout(updateCount, 50);
                } else {
                    targetElement.innerHTML = finalValue;
                }
            }
            updateCount();
        }

        // Create an Intersection Observer
        var observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    // Start the count-up animation when the element enters the viewport
                    if (entry.target.id === "triggerPointRegistered") {
                        countUp("registeredCount", registeredCount);
                    } else if (entry.target.id === "triggerPointDonors") {
                        countUp("donorsCount", donorsCount);
                    } else if (entry.target.id === "triggerPointBloodStock") {
                        countUp("bloodStockCount", bloodStockCount);
                    }
                    // Unobserve the element to stop unnecessary animations
                    observer.unobserve(entry.target);
                }
            });
        });

        // Observe the trigger point elements
        var triggerPointRegistered = document.getElementById("triggerPointRegistered");
        var triggerPointDonors = document.getElementById("triggerPointDonors");
        var triggerPointBloodStock = document.getElementById("triggerPointBloodStock");

        observer.observe(triggerPointRegistered);
        observer.observe(triggerPointDonors);
        observer.observe(triggerPointBloodStock);
    </script> -->
  <!-- count section  -->

  <!-- count section  --> 
  <div id="triggerPointRegistered" style="height: 1px;"></div> 
    <div id="triggerPointDonors" style="height: 1px;"></div> 
    <div id="triggerPointBloodStock" style="height: 1px;"></div> 
 
    <div class="container-fluid d-flex justify-content-center mt-3" style="background-color:#f2f2f2;"> 
        <div class="row mt-5 m-5"> 
            <div class="col-lg-4 col-md-12 mt-3 "> 
                <div class="card bg-primary" style="width:200px;height:200px;"> 
                    <div class="card-body"> 
                        <div class="d-flex justify-content-center"> 
                            <h3><i class="fa-solid fa-circle-exclamation text-light"></i></h3> 
                        </div> 
                        <h1 style="font-size:4rem" class="card-title text-center text-light" id="registeredCount">0</h1> 
                        <h3 class="card-title text-center text-light">Registered</h3> 
                    </div> 
                </div> 
            </div> 
 
            <div class="col-lg-4 col-md-12 mt-3"> 
                <div class="card bg-warning" style="width:200px;height:200px;"> 
                    <div class="card-body"> 
                        <div class="d-flex justify-content-center"> 
                            <h3><i class="fa-solid fa-users align-center text-light"></i></h3> 
                        </div> 
                        <h1 style="font-size:4rem" class="card-title text-center text-light" id="donorsCount">0</h1> 
                        <h3 class="card-title text-center text-light">Donors</h3> 
                    </div> 
                </div> 
            </div> 
 
            <div class="col-lg-4 col-md-12 mt-3"> 
                <div class="card bg-danger" style="width:200px;height:200px;"> 
                    <div class="card-body"> 
                        <div class="d-flex justify-content-center"> 
                            <h3><i class="fa-solid fa-droplet text-light"></i></h3> 
                        </div> 
                        <h1 style="font-size:4rem" class="card-title text-center text-light" id="bloodStockCount">0</h1> 
                        <h3 class="card-title text-center text-light">Blood Stock</h3> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
 
    <script> 
        var registeredCount = <?php echo $registers['count']; ?>; 
        var donorsCount = <?php echo $donors['count']+$others['count']; ?>; 
        var bloodStockCount = <?php echo $bloodstocks['count']; ?>; 
        var step = 1; 
        var observer; 
 
        function countUp(targetId, finalValue) { 
            var targetElement = document.getElementById(targetId); 
            var currentCount = 0; 
            function updateCount() { 
                if (currentCount < finalValue) { 
                    currentCount += step; 
                    targetElement.innerHTML = currentCount; 
                    setTimeout(updateCount, 40); 
                } else { 
                    targetElement.innerHTML = finalValue; 
                } 
            } 
            updateCount(); 
        } 
 
        function resetCount(targetId) { 
            var targetElement = document.getElementById(targetId); 
            targetElement.innerHTML = '0'; 
        } 
 
        // Create an Intersection Observer 
        observer = new IntersectionObserver(function(entries, observer) { 
            entries.forEach(function(entry) { 
                if (entry.isIntersecting) { 
                    // Start the count-up animation when the element enters the viewport 
                    if (entry.target.id === "triggerPointRegistered") { 
                        countUp("registeredCount", registeredCount); 
                    } else if (entry.target.id === "triggerPointDonors") { 
                        countUp("donorsCount", donorsCount); 
                    } else if (entry.target.id === "triggerPointBloodStock") { 
                        countUp("bloodStockCount", bloodStockCount); 
                    }
                  } else { 
                    // Reset the count when the element is not in the viewport 
                    if (entry.target.id === "triggerPointRegistered") { 
                        resetCount("registeredCount"); 
                    } else if (entry.target.id === "triggerPointDonors") { 
                        resetCount("donorsCount"); 
                    } else if (entry.target.id === "triggerPointBloodStock") { 
                        resetCount("bloodStockCount"); 
                    } 
                } 
            }); 
        }); 
 
        // Observe the trigger point elements 
        var triggerPointRegistered = document.getElementById("triggerPointRegistered"); 
        var triggerPointDonors = document.getElementById("triggerPointDonors"); 
        var triggerPointBloodStock = document.getElementById("triggerPointBloodStock"); 
 
        observer.observe(triggerPointRegistered); 
        observer.observe(triggerPointDonors); 
        observer.observe(triggerPointBloodStock); 
    </script>

      <!-- campaigns section start  -->
    <section id="campaigns">
        <div class="line text-center">
            <h2 class="text-uppercase fw-bold">Donation Campaigns</h2>
            <span class="line1"></span>
            <img src="img/b-logo.jpg" alt="" width="30px" height="30px">
            <span class="line2"></span>
        </div>

        <div>
            <p class="text-center fw-bold">Campaigns to encourage new dones to join and existing to continue to give blood</p>
        </div>

        <div class="container-fluid mt-4">
          <div class="owl-carousel owl-theme">
            <?php
            foreach($posts as $post)
            {
            
            ?>
                <div class="item">
                     <div class="card mb-3" style="max-width: 580px;border:none;">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="uploads/<?php echo $post['Image'] ?>" class="img-fluid rounded-start" alt="..." style="width: 300px;height:300px;">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title bg-dark text-light"><?php echo $post['Date']; ?></h5>
                                <h4 class="card-title text-danger"><?php echo $post['Title']; ?></h4>
                                <p class="card-text"><?php echo $post['Description']; ?></p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
                            
            
        </div>
    </section>
    <!-- campaigns section end  -->

    <!-- donate section start  -->
    <section id="form">

        <div class="container-fluid d-flex justify-content-center flex-row mt-5">
        
        <!-- <div class="col-md-4"> -->
          
            <div class="card bg-light py-3" style="box-shadow: 7px 7px 5px #333;">
              <h2 class="text-center  text-uppercase">Can you be a blood donor?</h2>
                <div class="card-body">
                    <ul>
                        <li>You must be between (18) and (55) years of age.</li>
                        <li>For men, weight must be above 110 pounds.</li>
                        <li>For women, weight must be above 100 pounds.</li>
                        <li>He must be a good sleeper.</li>
                        <li>Must not drink alcohol.</li>
                        <li>Must be free of recent illness.</li>
                        <li>In the past 6 months, injection pierced ears, He must not have had acupuncture.</li>
                        <li>pregnancy breastfeeding She must not be menstruating recently.</li>
                    </ul>

                    <div>
                         <p>Even if the above information is consistent, the doctors will take care to ensure that your health is not harmed by donating blood.</p>
                     </div>

                     <?php if(empty($_SESSION['user_connected'])) {?>
                    <div class="text-center">
                        <a href="login.php" class="btn btn-lg btn-dark rounded-0">Donate</a>
                    </div>
                    <?php
                     }else{
                     ?>
                     <div class="text-center">
                        <a href="donorForm.php" class="btn btn-lg btn-dark rounded-0">Donate</a>
                    </div>
                     <?php
                     }
                     ?>
                </div>
            </div>
        <!-- </div> -->
   
    </section>
    <!-- donate section end  -->

    <!-- volunteers section start  -->

    <section class="team_section layout_padding">
    <div class="container">
         <div class="line text-center mt-5">
            <h2 class="text-uppercase fw-bold p-2">Our Volunteers</h2>
        </div>
      <div class="carousel-wrap ">
        <div class="owl-carousel team_carousel">
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="img/kaung1.jpg" alt="" width="300px" height="300px" />
              </div>
              <div class="detail-box">
                <h5>
                  Kaung Si Thu
                </h5>
                <h6>
                  Strategy First
                </h6>
                <div class="social_box">
                  <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="img/phue.jpg" alt="" width="300px" height="300px"/>
              </div>
              <div class="detail-box">
                <h5>
                  Phue Pwint
                </h5>
                <h6>
                  CU(Mgy)
                </h6>
                <div class="social_box">
                  <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="img/nay.jpg" alt="" width="300px" height="300px" />
              </div>
              <div class="detail-box">
                <h5>
                  Nay Lin Aung
                </h5>
                <h6>
                  Yadanabon University(CS)
                </h6>
                <div class="social_box">
                  <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="img/mie.jpg" alt="" width="300px" height="300px" />
              </div>
              <div class="detail-box">
                <h5>
                  Lwin Mie Mie Han
                </h5>
                <h6>
                 Host Myanmar
                </h6>
                <div class="social_box">
                  <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

   
  <!-- testimonial section start  -->
  <section class="client_section ">
    <div class="container mt-5">
        <div class="heading_container mt-4">
            <div class="line text-center mt-5">
                <h2 class="text-uppercase fw-bold">Testimonial</h2>
                <span class="line1"></span>
                <img src="img/b-logo.jpg" alt="" width="30px" height="30px">
                <span class="line2"></span>
            </div>
        </div>
    </div>
  <div class="container px-0">
    <div id="customCarousel2" class="carousel carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="box">
            <div class="client_info">
              <div class="client_name">
                <h5>
                  Morijorch
                </h5>
                <h6>
                Regular Donors:
                </h6>
              </div>
              <i class="fa fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>
            "I can't emphasize enough how crucial blood donation is, and I'm incredibly grateful to all the selfless blood donors out there.
             As a recipient of donated blood, I can attest to the fact that their generous act saved my life. 
             When I faced a critical medical situation and needed blood transfusions,
              I didn't fully comprehend the gravity of the situation until I saw the bags of blood being brought to my bedside.
            </p>
          </div>
          <!-- <div class="d-flex justify-content-evenly">
              <div class="col-md-6 d-flex justify-content-center">
              <div class="skyBlueBox">
                  <h4 class="text-center display-5 fw-bold">459385</h4>
                  <h6 class="text-center fw-bold">Donors Registered <i class="fa-solid fa-exclamation"></i> </h6>
              </div>
              </div>

              <div class="col-md-6 d-flex justify-content-center">
                <div class="purpleBox">
                    <h4 class="text-center display-5 fw-bold">459385</h4>
                    <h6 class="text-center fw-bold">Blood Unit Collect  <i class="fas fa-droplet"></i> </h6>
                </div>
              </div>
          </div> -->

        </div>
        <div class="carousel-item">
          <div class="box">
            <div class="client_info">
              <div class="client_name">
                <h5>
                  Rochak
                </h5>
                <h6>
                Blood Recipients
                </h6>
              </div>
              <i class="fa fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>
            Words cannot express the profound gratitude I feel towards the blood donors who have given me a chance at life. 
            As a blood recipient, I've experienced firsthand the incredible impact of their selfless act.
             When I found myself facing a critical health situation, I didn't know if there was hope for recovery until I received the gift of donated blood.
            </p>
          </div>
            <!-- <div class="d-flex justify-content-evenly">
                <div class="skyBlueBox">
                    <h4 class="text-center display-5 fw-bold">459385</h4>
                    <h6 class="text-center fw-bold">Donors Registered <i class="fa-solid fa-exclamation"></i> </h6>
                </div>

                <div class="purpleBox">
                    <h4 class="text-center display-5 fw-bold">459385</h4>
                    <h6 class="text-center fw-bold">Blood Unit Collect  <i class="fas fa-droplet"></i> </h6>
                </div>
            </div> -->
        </div>
        <div class="carousel-item">
          <div class="box">
            <div class="client_info">
              <div class="client_name">
                <h5>
                  Lee Dong Wook
                </h5>
                <h6>
                    Regular Donor
                </h6>
              </div>
              <i class="fa fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>
              Being a community leader comes with its responsibilities,
               and one of the most rewarding roles I've taken on is advocating for blood donation and supporting our local blood bank.
                As someone who deeply cares about our community's well-being, I understand the immense importance of having a reliable and well-stocked blood bank to serve those in need.
            </p>
          </div>
        </div>
      </div>
      <div class="carousel_btn-box">
        <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel2" data-bs-slide="prev">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
          <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#customCarousel2" data-bs-slide="next">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <span class="sr-only">Next</span>
        </button>
      </div>
    </div>
  </div>
</section>
  <!-- testimonial section end  -->

  

    <!-- req form section start  -->
    <section>
    <div class="container-xxl">
            <div class="container py-5 px-lg-5">
              <div class="heading_container mb-4">
                <div class="line text-center mt-5">
                    <h2 class="text-uppercase fw-bold">Make Request</h2>
                    <span class="line1"></span>
                    <img src="img/b-logo.jpg" alt="" width="30px" height="30px">
                    <span class="line2"></span>
                </div>
              </div>  

                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                    <script type="module" src="https://unpkg.com/@splinetool/viewer@0.9.443/build/spline-viewer.js"></script>  
                    <spline-viewer loading-anim url="https://prod.spline.design/J3Te-vSwiHNwVg4J/scene.splinecode"></spline-viewer>
                  </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <h5 class="text-primary-gradient fw-medium">Blood Request</h5>
                        <h1 class="mb-4">Warmly Welcome</h1>
                        <p class="card-text">In the urgency of need, in the face of uncertainty, we call upon the kindness of strangers. To all those who can give the gift of life, we humbly request your help. Your blood is the lifeline that connects hope to healing, and in your selfless act, you become the beacon of compassion that brightens someone's darkest days. One moment of your time can save a life, and in that moment, you become a hero</p>
                        <div class="row g-4">
                          <?php if(isset($_SESSION['user_connected'])){ 
                            $name= $_SESSION['Name']?>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <a href="" class="d-flex bg-primary-gradient rounded py-3 px-4">
                                    <div class="ms-3">
                                        <a href="patientForm.php" class="patientBtn">Request for Patient</a>
                                    </div>
                                </a>
                            </div>
                            <?php }else{ ?>
                              <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <a href="" class="d-flex bg-primary-gradient rounded py-3 px-4">
                                    <div class="ms-3">
                                        <a href="patientForm.php" class="patientBtn">Request for Patient</a>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <a href="" class="d-flex bg-secondary-gradient rounded py-3 px-4">
                                   
                                    <div class="ms-2">
                                        <a href="hospitalForm.php" class="hospitalBtn">Request for Hospital</a>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <!-- volunteers section end  -->

    <!-- contact section start  -->
    <section id="contact" class="container mt-4">
        <div class="row d-flex justify-content-center">
        <h2 class="text-dark text-center text-uppercase fw-bold p-3">Contact Us <i class="fa-regular fa-message text-dark" ></i></h2>
            <div class="col-lg-6 col-md-12">
                <img src="img/p3.jpg" alt="">
            </div>
            <div class="col-lg-6 col-md-12 mt-4">
                <div class="form">
                  <?php if(isset($_SESSION['user_connected'])){ ?>
                <form method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['Name']; ?>">
                                            <label for="name">Your Name</label>
                                            <span class="text-danger"><?php if(isset($nameError)) echo $nameError; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>">
                                            <label for="email">Your Email</label>
                                            <span class="text-danger"><?php if(isset($emailError)) echo $emailError; ?></span>
                                            <span class="text-danger"><?php if(isset($typeemail)) echo $typeemail; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="phone" class="form-control" id="phone" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                                            <label for="phone">Phone</label>
                                            <span class="text-danger"><?php if(isset($phoneError)) echo $phoneError; ?></span>
                                            <span class="text-danger"><?php if(isset($typephNoerror)) echo $typephNoerror; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="message" placeholder="Leave a message here" id="message" style="height: 150px"><?php if(isset($_POST['message'])) {  echo htmlentities ($_POST['message']); }?></textarea>
                                             <label for="message">Message</label>
                                            <span class="text-danger"><?php if(isset($messageError)) echo $messageError; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="send">Send Message</button>
                                    </div>
                                </div>
                </form>
                <?php }else{ ?>
                  <form method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
                                            <label for="name">Your Name</label>
                                            <span class="text-danger"><?php if(isset($nameError)) echo $nameError; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                                            <label for="email">Your Email</label>
                                            <span class="text-danger"><?php if(isset($emailError)) echo $emailError; ?></span>
                                            <span class="text-danger"><?php if(isset($typeemail)) echo $typeemail; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="phone" class="form-control" id="phone" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                                            <label for="phone">Phone</label>
                                            <span class="text-danger"><?php if(isset($phoneError)) echo $phoneError; ?></span>
                                            <span class="text-danger"><?php if(isset($typephNoerror)) echo $typephNoerror; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="message" placeholder="Leave a message here" id="message" style="height: 150px"><?php if(isset($_POST['message'])) {  echo htmlentities ($_POST['message']); }?></textarea>
                                             <label for="message">Message</label>
                                            <span class="text-danger"><?php if(isset($messageError)) echo $messageError; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="send">Send Message</button>
                                    </div>
                                </div>
                </form>
                <?php }?>
                </div>
            </div>
        </div>
            
    </section>

    <!-- contact section end  -->

    <!-- footer section start -->
   <div class="container-fluid bg-dark text-light footer ">
        <div class="container mt-4 py-3">
            <img src="img/logo.png" alt="" width="100px" height="100px">
        </div>
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link text-light text-decoration-none" href="">About Us</a>
                    <a class="btn btn-link text-light text-decoration-none" href="">Contact Us</a>
                    <a class="btn btn-link text-light text-decoration-none" href="">Privacy Policy</a>
                    <a class="btn btn-link text-light text-decoration-none" href="">Terms & Condition</a>
                    <a class="btn btn-link text-light text-decoration-none" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>bloodbank@gmail.com</p>
                    <div class="d-flex pt-2 ms-3">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/bg5.jpg" alt="">
                        </div>
                        <div class="col-4">
                          <img class="img-fluid bg-light p-1" src="img/bg6.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/bg8.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/bg12.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/bg13.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/bg11.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-dark py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom text-light text-decoration-none" href="#">Blood Bank</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="" class="text-light text-decoration-none">Home</a>
                            <a href="" class="text-light text-decoration-none">Cookies</a>
                            <a href="" class="text-light text-decoration-none">Help</a>
                            <a href="" class="text-light text-decoration-none">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <button id="scrollToTopBtn"><i class="fas fa-chevron-up"></i></button>

    <script src="https://kit.fontawesome.com/4194aa8b0e.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="js/owlscript.js"></script>
    <script>
      const scrollToTopBtn = document.getElementById("scrollToTopBtn");


      //remove all logo for spline 
    window.onload = function() { 
    var splineViewers = document.querySelectorAll('spline-viewer'); 
    splineViewers.forEach(function(splineViewer) { 
        var shadowRoot = splineViewer.shadowRoot; 
        var logo = shadowRoot.querySelector('#logo'); 
        if (logo) { 
            logo.remove(); 
        } 
    }); 
};


     window.addEventListener("scroll", () => {
    if (document.documentElement.scrollTop > 700) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
    });

    scrollToTopBtn.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth" 
    });
    });
    </script>
</body>
</html>