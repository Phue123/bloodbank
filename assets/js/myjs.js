$(document).ready(function(){
    
    $(document).on('click','.donar_abtn',function(e){
        e.preventDefault();
        
            let id=$(this).parent().attr('id');
            $.ajax({
                method:'post',
                url:'adddonar.php',
                data:{id:id},
                success:function(response){
                     if(response=='Success'){
                       console.log('success')
                        location.href="donor_req.php"
                     }
                     else{
                        alert(response);
                     }
                },
                error:function(error){

                }
            })
        
    })

    $(document).on('click','.reject_donar',function(e){
        e.preventDefault();
        let status=confirm("Are you sure to reject?");
        if(status){
            let id=$(this).parent().attr('id');
            $.ajax({
                method:'post',
                url:'delete_donar_req.php',
                data:{id:id},
                success:function(response){
                     if(response=='Success'){
                        alert('Successfully reject')
                        location.href="donor_req.php"
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

    $(document).on('click','.accept_hos',function(e){
        e.preventDefault();
        
            let id=$(this).parent().attr('id');
            $.ajax({
                method:'post',
                url:'accept_hreq.php',
                data:{id:id},
                success:function(response){
                     if(response=='Success'){
                       console.log('success')
                        location.href="hospital_req.php"
                     }
                     else{
                        alert(response);
                     }
                },
                error:function(error){

                }
            })
        
    })
   
})