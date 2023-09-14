$(document).ready(function(){
   
    $(document).on('click','.vbtn',function(e){
        e.preventDefault();


        timeleft(120)
        function timeleft(remaining){

        var downloadTimer=setInterval(function(){
        if(remaining<=0){
            clearInterval(downloadTimer);
            document.getElementById('countdown').innerHTML="<span style='color: green'>Don't receive code?</span> <a class='vbtn style='color: blue''>Resend</a>";
            
        }else{
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;
  
          m = m < 10 ? '0' + m : m;
          s = s < 10 ? '0' + s : s;
          document.getElementById('countdown').innerHTML = m + ':' + s;
          remaining -=1
        }
        },1000);
        }
        

            let id=$(this).parent().attr('id1');
           console.log(id);
           $.ajax({
            method:'post',
            url:'set_otp.php',
            data:{id:id},
            success:function(response){
                if(response="success"){
                   
                }
            },
            error:function(error){

            }
           })
    })
})

timeleft(120)
function timeleft(remaining){

    var downloadTimer=setInterval(function(){
        if(remaining<=0){
            clearInterval(downloadTimer);
            document.getElementById('countdown').innerHTML="Don't receive code? <a class='vbtn' style='color: blue'>Resend</a>";
            
        }else{
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;
  
          m = m < 10 ? '0' + m : m;
          s = s < 10 ? '0' + s : s;
          document.getElementById('countdown').innerHTML = m + ':' + s;
          remaining -=1
        }
    },1000);
}


const patient = document.querySelector(".p_req");
const hospital = document.querySelector(".h_req");
const form = document.querySelector("#form");
const switchs = document.querySelectorAll(".switch");

let current = 1;

function tab2(){
    form.style.marginLeft = "-100%";
    patient.style.background = "none";
    hospital.style.background = "linear-gradient(45deg,#00d5fc,#046af6)";
    switchs[current - 1].classList.add("active");
}

function tab1(){
    form.style.marginLeft = "0%";
    hospital.style.background = "none";
    patient.style.background = "linear-gradient(45deg,#00d5fc,#046af6)";
    switchs[current - 1].classList.remove("active");
}



