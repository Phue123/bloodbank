<?php
include_once __DIR__. '/../layouts/sidebar.php';
include_once __DIR__.'/../controller/PostController.php';
$id=$_GET['id'];
$post_con=new PostController();
$post=$post_con->getpostbyid($id);

$posts=$post_con->getpost();

if(isset($_POST['edit']))
{
    $title=$_POST['title'];
    $date=$_POST['date'];
    $desc=$_POST['desc'];
    $image = $_FILES['image'];
    $status=$post_con->editpost($id,$title,$date,$desc,$image);
    if($status)
    {
        $message=3;
        echo "<script>location.href='Post.php?status=$message'</script>";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit_post</title>
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
            <h2 class="text-center">Edit_post</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="m-3" >
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $post['Title'] ?>">

                </div>
                <div class="m-3" >
                    <label for=""class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo $post['Date'] ?>">
                </div>
                <div class="m-3">
                    <label for="" class="form-label">Description</label>
                    <textarea id='makeMeSummernote' name='desc' class="form-control"><?php echo $post['Description'] ?></textarea>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Post Image</label>
                        <div class="mb-3">
                            <?php
                                echo "<img src='../uploads/".$post['Image']."' width='100px height='100px'";
                            ?>
                        </div>
                    
                 </div>

                 <div class="my-3">
                    <input type="file" name="image" id="" class="form-control"  value="<?php echo $post['Image'] ?>">
                 </div>

                <div class="input_field">
                    <button  class="btn1 btn-primary" name="edit">Update</button>
                </div>
                
            </form>

        </div>
    </main>
    <script type="text/javascript">
        $('#makeMeSummernote').summernote({
            height:200,
        });
    </script>
</body>
</html>
    
<?php
include_once __DIR__.'/../layouts/footer.php';
?>