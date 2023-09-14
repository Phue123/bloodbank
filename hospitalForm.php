<?php
session_start();

include_once __DIR__ . '/controller/bloodstockController.php';
include_once __DIR__.'/controller/hospitalReqController.php';

$bs_con = new bloodstockController();
$hos_con=new hospitalReqController();
$bloods = $bs_con->getbloods();

if(isset($_POST['submit'])){
    if(empty($_POST['contact_name']) || empty($_POST['dept']) || empty($_POST['phNo'])|| !preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['phNo']) || empty($_POST['address']) ){
    
    if(empty($_POST['contact_name'])){
        $contact_nameerror='Please enter your contact name';
    }

    if(empty($_POST['dept'])){
        $depterror='Please enter your department';
    }

    if(!preg_match("/(^[0-9]{11}+$)|(^[0-9]{7}+$)|(^[0-9]{9}+$)/",$_POST['phNo'])){
        $typephNoerror='Incorrect Phone Number Type';
    }

    if(empty($_POST['address'])){
        $addresserror='Please fill your address';
    }

    // if(empty($_POST['bloodtypeId'])){
    //     $btypeerror='Please select blood type';
    // }

    // if(empty($_POST['qty'])){
    //     $pqtyerror='Please fill your qty';
    // }

   }else{

    $bloodtype=array();
    $qty=array();
    for($row=0;$row<sizeof($_POST['bloodtypeId']);$row++)
    {
        $hospital[$row][0]=$_POST['bloodtypeId'][$row];
        $hospital[$row][1]=$_POST['qty'][$row];   
    }
    for($row=0;$row<sizeof($hospital);$row++){
        $id=$hospital[$row][0];  //blood id
        $result=$hos_con->checkStock($id);
        
        $result['count'] ??= '0';
        $count=$result['count'];
        $q=intval($hospital[$row][1]); //entered blood amount

        if($count >= $q){
            $result['blood'] ??= 'null';
           
            $bloodt=$result['Id'];
            

            $dbqty=intval($hospital[$row][1]);
            $message="Success";
            array_push($bloodtype,$bloodt);
            array_push($qty,$dbqty);
        }else{
            $error="Blood is not sufficient";
           
        }  
    }
    

    if(isset($error)){
        $message1="Blood is not sufficient";
    }else{
            $contact_name=$_POST['contact_name'];
            $dept=$_POST['dept'];
            $phNo=$_POST['phNo'];
            $address=$_POST['address'];
            $reason=$_POST['reason'];
            $bloodtypes=$_POST['bloodtypeId'];
            $qtys=$_POST['qty'];
            // print_r($qtys);
            
            $result=$hos_con->addHospitalReq($contact_name, $dept,$address,$phNo ,$reason);
            if($result){
                $id=intval($result);
                $result1=$hos_con->getReqId($id);
                if($result1){
                    // var_dump($result1);
                    $did=$result1['Id'];
                    for($i=0;$i<sizeof($bloodtype);$i++){
                        $btype=$bloodtype[$i];
                        $bqty=$qty[$i];
                        $send=$hos_con->addReqDetail($did,$btype,$bqty);
                        if($send){
                        echo "<script type='text/javascript'>alert('Your request is being processed');</script>";
                        echo '<script>location.href="index.php"</script>';
                        }
                    }   
            }
        }
    }
   }
   


}
if(isset($_POST['submit1'])){
   
    echo "<script>location.href='index.php'</script>";

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Request</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/css/mycss.css">
</head>

<body>


    <div class="container-fluid d-flex justify-content-center flex-row">

        <div class="col-md-4">
            <h2 class="text-center text-uppercase">Hospital Request</h2>
            <div class="card bg-light">
            <?php if(isset($error)) echo "<p class='bgp rounded text-center p-2'>".$error."</p>" ?>
                <div class="card-body">
                    <form action="" id="bloodstockForm" method="post">
                        <div id="bloodstockRows">
                            <div class="m-3">
                                <label for="" class="form-label">Contact_Name</label>
                                <input type="text" name="contact_name" class="form-control" value="<?php if(isset($_POST['contact_name'])) echo $_POST['contact_name']; ?>">
                                <span class="text-danger"><?php if(isset($contact_nameerror)) echo $contact_nameerror; ?></span>
                            </div>

                            <div class="m-3">
                                <label for="" class="form-label">Hospital Dept</label>
                                <input type="text" name="dept" class="form-control" value="<?php if(isset($_POST['dept'])) echo $_POST['dept']; ?>">
                                <span class="text-danger"><?php if(isset($depterror)) echo $depterror; ?></span>
                            </div>

                            <div class="m-3">
                                <label for="" class="form-label">Phone</label>
                                <input type="phone" name="phNo" class="form-control" value="<?php if(isset($_POST['phNo'])) echo $_POST['phNo']; ?>">
                                <span class="text-danger"><?php if(isset($phNoerror)) echo $phNoerror; ?></span>
                                <span class="text-danger"><?php if(isset($typephNoerror)) echo $typephNoerror; ?></span>
                            </div>

                            <div class="m-3">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">
                                <span class="text-danger"><?php if(isset($addresserror)) echo $addresserror; ?></span>
                            </div>

                            <div class="m-3">
                                <label for="" class="form-label">Blood Type</label>
                                <select name="bloodtypeId[]" id="bloodt0" class="form-select">
                                    <option value="" disabled selected>--Select Blood--</option>
                                    <?php foreach ($bloods as $blood) { ?>
                                       <option value="<?php echo $blood['Id']; ?>" <?php
                                         if (isset($_POST['bloodtypeId']) && in_array($blood['Id'], $_POST['bloodtypeId'])) {
                                             echo 'selected';
                                             }?>>
                                             <?php echo $blood['BloodType']; ?>
                                            </option>
                                    <?php } ?>
                                </select>
                                <span class="iderror text-danger"><?php if(isset($iderror)) echo $iderror; ?></span>
                                <span class="text-danger"><?php if(isset($btypeerror)) echo $btypeerror; ?></span>
                            </div>

                            <div class="m-3">
                                <label for="" class="form-label">Qty</label>
                                <input type="text" name="qty[]" id="qty0" class="form-control">
                                <span class="qtyerror text-danger"><?php if(isset($qtyerror)) echo $qtyerror; ?></span>
                                <span class="text-danger"><?php if(isset($pqtyerror)) echo $pqtyerror; ?></span>
                            </div>
                        </div>

                        <div class="mt-3">
                        <button type="button" class="btn btn-success" id="addmore">+</button>
                        </div>
                        <div class="m-3">
                                <label for="" class="form-label">Reason</label>
                                <input type="text" name="reason" class="form-control" value="<?php if(isset($_POST['reason'])) echo $_POST['reason']; ?>">
                              
                            </div>

                        <div class="m-2 d-grid">
                            <button type="submit" class="btn btn-danger" name="submit">Send</button>
                        </div>
                        <div class="m-2 d-grid">
                            <button type="submit" class="btn btn-info" name="submit1">Main Page</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

<script src="js/jquery-3.7.0.min.js"></script>
<script>
     var i=0;
    $(document).ready(function(){
        
    $(document).on('click','#addmore',function(e){
        i++;
        e.preventDefault();
        let id=$('#bloodt'+i).val();
        let qty=$('#qty'+i).val();

        if(id=='' || qty==''){
            $(".iderror").html('Enter your bloodtype');
            $(".qtyerror").html('Enter your qty');
        }else{
            $(".iderror").remove();
            $(".qtyerror").remove();
        const row = document.createElement('div');
                    row.className = 'bloodstock-row';
                    row.innerHTML = `
                    <div class="m-3">
                    <label for="" class="form-label">Blood Type</label>
                    <select name="bloodtypeId[]" id="bloodt${i}" class="form-select">
                        <option value="" disabled selected>--Select Blood--</option>
                        <?php
                        foreach ($bloods as $blood) {
                        ?>
                            <option value="<?php echo $blood['Id']; ?>" <?php if (isset($_POST['bloodtype']) && in_array($blood['Id'], $_POST['bloodtype'])) echo 'selected'; ?>>
                                <?php echo $blood['BloodType']; ?>
                            </option>;
                            <?php
                        }
                            ?>
                    </select>
                    <span class="iderror text-danger"><?php if(isset($iderror)) echo $iderror; ?></span>
                </div>
                <div class="m-3">
                    <label for="" class="form-label">Qty</label>
                    <input type="number" name="qty[]" id="qty" required class='form-control'>
                    <span class="qtyerror text-danger"><?php if(isset($qtyerror)) echo $qtyerror; ?></span>
                </div>
                <button class='btn btn-danger removebtn'>-</button>
            `;
               document.getElementById('bloodstockRows').appendChild(row);
               
                    }
    })
    
        // $.ajax({
        //         method:'post',
        //         url:'getbloodbyajax.php',
        //         data:{id:id},
        //         success:function(response){
        //              if(response){
        //                 // alert(response)
        //                let blood=JSON.parse(response);
        //                let val=blood[0]['count'];
        //                 if(val >= qty){
                    
        //                 }else
        //                 {
        //                     alert('Not enough blood')
        //                 }
        //              }
        //              else{
        //                 alert(response);
        //              }
        //         },
        //         error:function(error){

        //         }
        //     })
        // }
        // j=j+1;
        // console.log("btn click");
        // const row = document.createElement('div');
        // row.className = 'bloodstock-row';
        // row.innerHTML = `
        //         <div class="m-3">
        //             <label for="" class="form-label">Blood Type</label>
        //             <select name="bloodtypeId[]" class="form-select">
        //                 <option value="" disabled selected>--Select Blood--</option>
        //                 <?php
        //                 foreach ($bloods as $blood) {
        //                 ?>
        //                     <option value="<?php echo $blood['Id']; ?>" <?php if (isset($_POST['bloodtype']) && $_POST['bloodtype'] == $blood['Id']) echo 'selected'; ?>>
        //                         <?php echo $blood['BloodType']; ?>
        //                     </option>;
        //                     <?php
        //                 }
        //                     ?>
        //             </select>
        //         </div>
        //         <div class="m-3">
        //             <label for="" class="form-label">Qty</label>
        //             <input type="number" name="qty[]" required class='form-control'>
        //         </div>
        //         <button class='btn btn-danger removebtn'>-</button>
        //     `;

        // document.getElementById('bloodstockRows').appendChild(row);
        


    $(document).on('click','.removebtn',function(event){
        event.preventDefault();
        console.log("button is remove");
        $(this).parent().remove();
    })




    // function validateAndSubmit(e) {
    // e.preventDefault();
    // console.log('hi')
    // const rows = document.getElementsByClassName('bloodstock-row');
    // let isValid = true;
    // let completedRequests = 0;

    // // Loop through all rows and check each pair of bloodtypeId and amount
    // for (let i = 0; i < rows.length; i++) {
    //     const row = rows[i];
    //     const bloodtypeId = row.querySelector('select[name="bloodtypeId[]"]').value;
    //     const enteredAmount = parseInt(row.querySelector('input[name="qty[]"]').value);

    //     // Make an AJAX request to the controller to get the bloodstock amount
    //     fetch(`ajax_handler.php?id=${bloodtypeId}`)
    //         .then(response => response.json()) // Parse the response as JSON
    //         .then(data => {
    //             completedRequests++;
    //             const databaseAmount = parseInt(data.amount);

    //             if (enteredAmount > databaseAmount) {
    //                 isValid = false;
    //                 row.style.backgroundColor = 'red'; // Highlight the row with an error
    //             } else {
    //                 row.style.backgroundColor = ''; // Reset the row color
    //             }

    //             // Check if all rows have been validated before submitting the form
    //             if (completedRequests === rows.length) {
    //                 if (isValid) {
    //                     document.getElementById('error').textContent = ''; // Clear any previous error message
    //                     document.getElementById('bloodstockForm').submit();
    //                 } else {
    //                     document.getElementById('error').textContent = 'Some entered amounts are greater than the available bloodstock.';
    //                 }
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error fetching data from the server:', error);
    //             completedRequests++;
    //             if (completedRequests === rows.length) {
    //                 document.getElementById('error').textContent = 'Error fetching data from the server.';
    //             }
    //         });
    // }
    // }
    })
 
</script>

</html>