<?php
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__.'/../controller/PostController.php';

$post_con=new PostController();

    if(isset($_POST['add'])){
            $message='successs';
            $title=$_POST['title'];
            $date=$_POST['date'];
            $desc=$_POST['desc'];
            $image = $_FILES['image'];
            // var_dump($image);
            $result=$post_con->addpost($title,$date,$desc,$image);
            if($result){
                $message=2;
                echo "<script>location.href='Post.php?status=".$message."'</script>";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add_post</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <!-- include summernote css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- include summernote js-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>
<body>
<main class="content">
    <div class="container">
        <h2 class="text-center">Add_post</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="m-3" >
                <label for="" class="form-label">Title</label>
                <input type="text"name="title"class="form-control">

            </div>
            <div class="m-3" >
                <label for=""class="form-label">Date</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="m-3">
                <label for="" class="form-label">Description</label>
                <textarea id='makeMeSummernote' name='desc' class="form-control"></textarea>
            </div>

            <div class="m-3">
                <label for="" class="form-label">Image</label>
                <input type="file" name="image" id="" class="form-control">
            </div>

            <div class="input_field">
                <button class="btn1 btn btn-primary" name="add">Add</button>
            </div>
            
        </form>

    </div>
</main>
    <script type="text/javascript">
        $('#makeMeSummernote').summernote({
            height:300,
        });
    </script>
</body>
</html>

<?php
include_once __DIR__.'/../layouts/footer.php';
?>


        
    







