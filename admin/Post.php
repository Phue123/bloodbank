<?php
include_once __DIR__."/../layouts/sidebar.php";
include_once __DIR__."/../controller/PostController.php";
$post_con=new PostController();
$posts=$post_con->getpost();
?>
<main class="content">
    <div class="container">
    <h2 class="text-center text-danger text-uppercase">Post</h2>
    <?php
        if(isset($_GET['status']) && $_GET['status']==2)
        {
          echo "<div class='alert  text-dark'>New post has been successfully created</div>";
        }
        else if(isset($_GET['status']) && $_GET['status']==3)
        {
          echo "<div class='alert  text-dark'>Post has been successfully updated</div>";
        }
        ?>
      <div class="m-4">
        <a href="Add_Post.php" class=" btn btn-success ">Add</a>
      </div>
        <div>
          <table class="table table-striped" id="mytable">
              <thead>
                  <tr>
                      <th>NO</th>
                      <th>Title</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
              </thead>
              <tbody>
                <?php
                    $count=1;
                    foreach($posts as $post){
                        echo "<tr>";
                        echo "<td>" .$count++. "</td>";
                        echo "<td>" . $post['Title'] ."</td>";
                        echo "<td>" . $post['Date'] ."</td>";
                        echo "<td>" . $post['Description'] ."</td>";
                        echo "<td><img src='../uploads/".$post['Image']."' width='100px height='100px'></td>";
                        echo "<td id='".$post['id']."' class='d-flex p-5'> <a class='btn btn-warning mx-3' href='edit_post.php?id=".$post['id']."'>Edit</a><button class='btn btn-danger mx-3 btn_delete'>Delete</button>" ."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
        </table>
      </div>
    </div>

<?php
include_once __DIR__.'/../layouts/footer.php';
?>