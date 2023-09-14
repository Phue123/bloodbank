$(document).ready(function(){
    $(document).on('click','.btn_delete',function(e){
        e.preventDefault();
        let status=confirm("Are you sure to delete?");
        if(status)
        {
            let id=$(this).parent().attr('id')
            $.ajax({
                method:'post',
                url:'delete_post.php',
                data:{id:id},
                success:function(response){
                    if(response=='success')
                    {
                        alert("Successfully deleted")
                        location.href='Post.php'
                    }
                    else{
                        alert(response)
                    }
                    
                },
                error:function(error)
                {

                }
            })
        }
    })
})