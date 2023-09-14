    <footer class="footer footer-black footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
      </div>
	</div>

     
		
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script>
    $(document).on('click','#addmore',function(e){
        i++;
        e.preventDefault();
        let id=$('#bloods'+i).val();

        if(id==''){
            $(".berror").html('Enter your bloodtype');
        }else{
            $(".berror").remove();
        const row = document.createElement('div');
                    row.className = 'bloodstock-row';
                    row.innerHTML = `
                    <?php foreach($reqs as $req){ ?>    
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="form-label">Blood Type</label>
                                    <input type="text" name='btype[]'  class="form-control" value="<?php echo $req['bloodtype'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Qty</label>
                                    <input type="text" name='bqty[]' class="form-control" value="<?php echo $req['qty'] ?>">
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="" class="form-label">Blood Stock</label>
                                    <select name="bloodtype[]" id="bloods${i}" style="padding: 0.3rem;">
                                    <option value="" disabled selected>--SELECT BLOOD--</option>
                                        <?php
                                        $blood=$req['bid'];
                                        $bs_con=new bloodstockController();
                                        $bloodstocks=$bs_con->getbsbyblood($blood);
                                        foreach($bloodstocks as $bloodstock){
                                            ?>
                                            <option value="<?php echo $bloodstock['bsid']; ?>" 
                                            <?php if(isset($_POST['bloodtype']) && in_array($blood['bsid'], $_POST['bloodtype']))
                                                    echo 'selected'; 
                                                   ?>>
                                            <?php echo $bloodstock['code']; ?>
                                            </option>;
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    
                                </div>
                            
                            </div>
                       
                        <?php } ?>
                                    <span class="berror text-danger"><?php if(isset($berror)) echo $berror; ?></span>
            `;
               document.getElementById('bloodstock').appendChild(row); 
        }
    })

 
</script>
<script>
  $(document).on('click','.reject_hospital',function(e){
        console.log('hi');
        e.preventDefault();
        let status=confirm("Are you sure to reject?");
        if(status){
            let id=$(this).parent().attr('id');
            $.ajax({
                method:'post',
                url:'delete_hospital_req.php',
                data:{id:id},
                success:function(response){
                     if('Success'){
                        alert('Successfully rejected')
                        location.href="hospital_req.php"
                     }
                     else{
                        alert(response)
                     }
                },
                error:function(error){

                }
            })
        } 
    })

    $(document).on('click','.reject_patient',function(e){
        console.log('hi');
        e.preventDefault();
        let status=confirm("Are you sure to reject this patient?");
        if(status){
            let id=$(this).parent().attr('id');
            $.ajax({
                method:'post',
                url:'delete_patient_req.php',
                data:{id:id},
                success:function(response){
                     if(response=='Success'){
                        alert('Patient rejected')
                        location.reload();
                     }
                     else{
                        alert(response);
                     }
                },
                error:function(error){

                }
            })
        } 
    })



    let restore=(button)=>{
      var donorId = button.getAttribute('data-donor-id');
    // Now you can use the donorId value in your logic
    var id=parseInt(donorId);
    console.log(id)
    let status=confirm("Are you sure to restore?");
        if(status){
            $.ajax({
                method:'post',
                url:'restore_donor.php',
                data:{id:id},
                success:function(response){
                     if(response=='Success'){
                        alert('Successfully restored')
                        location.reload();
                     }
                     else{
                        alert(response);
                     }
                },
                error:function(error){

                }
            })
        } 
    }

    
    let restorePatient=(button)=>{
      var donorId = button.getAttribute('data-patient-id');
    // Now you can use the donorId value in your logic
    var id=parseInt(donorId);
    console.log(id)
    let status=confirm("Are you sure to restore?");
        if(status){
            $.ajax({
                method:'post',
                url:'restore_patient.php',
                data:{id:id},
                success:function(response){
                     if(response=='Success'){
                        alert('Patient restored')
                        location.reload();
                     }
                     else{
                        alert(response);
                     }
                },
                error:function(error){

                }
            })
        } 
    }



    
    let restoreHospitalReq=(button)=>{
      var donorId = button.getAttribute('data-hospital-id');
    // Now you can use the donorId value in your logic
    var id=parseInt(donorId);
    console.log(id)
    let status=confirm("Are you sure to restore?");
        if(status){
            $.ajax({
                method:'post',
                url:'restore_hospital.php',
                data:{id:id},
                success:function(response){
                     if(response=='Success'){
                        alert('Hospital restored')
                        location.reload();
                     }
                     else{
                        alert('Hospital restored')
                        location.reload();
                     }
                },
                error:function(error){

                }
            })
        } 
    }


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

    //toggle trash

    document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('toggleButton');
    var hospitalContent = document.getElementById('hospitalContent');
    var patientContent = document.getElementById('patientContent');

    toggleButton.addEventListener('change', function() {
        if (toggleButton.checked) {
            hospitalContent.style.display = 'block';
            patientContent.style.display = 'none';
        } else {
            hospitalContent.style.display = 'none';
            patientContent.style.display = 'block';
        }
    });
});


//toggle donation

document.addEventListener('DOMContentLoaded', function() {
    var toggleDonation = document.getElementById('toggleDonation');
    var hospitalReq = document.getElementById('hos_req');
    var patientReq = document.getElementById('patient_req');

    toggleDonation.addEventListener('change', function() {
        if (toggleDonation.checked) {
            hospitalReq.style.display = 'block';
            patientReq.style.display = 'none';
        } else {
            hospitalReq.style.display = 'none';
            patientReq.style.display = 'block';
        }
    });
});

//toogle bloodstock
document.addEventListener('DOMContentLoaded', function() {
    var toggleStock = document.getElementById('toggleStock');
    var donorStock = document.getElementById('donor_stock');
    var otherStock = document.getElementById('other_stock');

    toggleStock.addEventListener('change', function() {
        if (toggleStock.checked) {
            donorStock.style.display = 'none';
            otherStock.style.display = 'block';
        } else {
            donorStock.style.display = 'block';
            otherStock.style.display = 'none';
        }
    });
});


</script>


  
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  <script src="../assets/js/jquery-3.7.0.min.js"></script>
  <script src="../assets/js/myjs.js"></script>
  <script src="../assets/js/delete.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script> 
    $(document).ready(function(){ 
        $('#mytable').DataTable(); 
        $('#mytable1').DataTable(); 
        $('#mytable2').DataTable(); 
        $('#mytable3').DataTable(); 
        $('#mytable4').DataTable(); 
        $('#mytable6').DataTable(); 
 
        $('#searchBox').keyup(function() { 
            var searchTerm = $(this).val(); // Get the search term from the input 
    var myTable = $('#mytable').DataTable(); // Initialize or get a reference to the DataTable 
    var myTable1 = $('#mytable1').DataTable(); 
    var myTable2 = $('#mytable2').DataTable(); 
    var myTable3 = $('#mytable3').DataTable(); 
    var myTable4 = $('#mytable4').DataTable(); 
    var myTable6 = $('#mytable6').DataTable(); 
    myTable.search(searchTerm).draw();  
    myTable1.search(searchTerm).draw(); 
    myTable2.search(searchTerm).draw();  
    myTable3.search(searchTerm).draw();  
    myTable4.search(searchTerm).draw();  
    myTable6.search(searchTerm).draw();  
        }); 
    }) 
  </script>

  <script>
    
    var i=0;
    $(document).ready(function(){
        console.log('hello');
        showGraph();
        showGraph2();

         //dashboard
         function showGraph() {
    $.post("dashdata.php", function(datas) {
        datas = JSON.parse(datas);
        console.log('here is data')
        console.log(datas);
        var months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        var donations = new Array(12).fill(0); // Initialize with 0 donations for each month

        for (var i in datas) {
            var monthIndex = months.indexOf(datas[i].month);
            if (monthIndex !== -1) {
                donations[monthIndex] = datas[i].record_count;
            }
        }
        console.log(months);
        console.log(donations);
        
        var chartdata = {
            labels: months,
            datasets: [{
                label: 'Monthly Donations',
                backgroundColor: 'coral',
                borderColor: '#46d5f1',
                hoverBackgroundColor: 'aqua',
                hoverBorderColor: 'yellow',
                data: donations
            }]
        };

        var graphTarget = $("#monthly-donations");

        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 5
                        }
                    }],
                    xAxes: [{
                        type: 'category', // Use category scale for x-axis
                        labels: months
                    }]
                }
            }
        });
    });
    }



function showGraph2() {
    $.post("feeData.php", function(data_s) {
        data_s = JSON.parse(data_s);
        console.log('here is data2')
        console.log(data_s);
        
        // Create an array of all months from January to December
        var months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        // Initialize an array to store fees
        var fees = new Array(12).fill(0); // Initialize with 0 fees for each month
        
        // Fill the fees array with actual fees based on data from the database
        for (var i in data_s) {
            var monthIndex = months.indexOf(data_s[i].month);
            if (monthIndex !== -1) {
                fees[monthIndex] = data_s[i].total_fee;
            }
        }
        
        console.log(months);
        console.log(fees);
        
        var chartdata = {
            labels: months,
            datasets: [{
                label: 'Monthly Fees in MMK',
                backgroundColor: 'transparent',
                borderColor: '#46d5f1',
                hoverBackgroundColor: 'aqua',
                hoverBorderColor: 'yellow',
                data: fees
            }]
        };

        var graphTarget = $("#monthly-fees");

        var barGraph = new Chart(graphTarget, {
            type: 'line',
            data: chartdata,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 100000,
                            callback: function (value, index, values) {
                                // Format tick values with commas
                                return value.toLocaleString();
                            }
                        }
                    }],
                    xAxes: [{
                        type: 'category', // Use category scale for x-axis
                        labels: months
                    }]
                }
            }
        });
    });
}
});
  </script>
</body>

</html>
