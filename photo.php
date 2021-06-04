<?php include("includes/header.php"); ?>

<?php
/* ---------------------------------------------------------------------------- */

require_once("admin/includes/init.php");


$photo = Photo::find_by_id($_GET['id']);



if(empty($_GET['id'])){

redirect("index.php");

}

if(isset($_POST['comment'])){

$author = trim($_POST['author']);
$body = trim($_POST['body']);
$comment_date = date('d-m-y H:i:s');

$new_comment = Comment::create_comment($photo->id, $author, $body ,$comment_date);

if($new_comment && $new_comment->save()){



redirect("photo.php?id={$photo->id}");

}else{

$message = "There was some problem saving";


}

}else{

$author = "";
$body = "";

}

$comments = Comment::find_the_comments($photo->id);


/* ---------------------------------------------------------------------------- */

?>




           <div class="row">
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="admin/users.php"><?php echo $photo->username; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $photo->upload_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img width="1000px" class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="<?php echo $photo->alternate_text; ?>">

                <hr>

                <!-- Post Content -->

                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?> </p>
                
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->


                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                    <div class="form-group">
                    <label for="">Author</label>
                    <input type="text" name="author" class="form-control" hidden value="<?php
                    $user = User::find_by_id($_SESSION['user_id']);
                    echo $user->username ?>">
                    </div>
                            <label for="">Comment</label>
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" name="comment" class="btn btn-primary">Submit</button>
                    </form>
                
                <hr>





                <!-- Posted Comments -->


                <?php   foreach($comments as $comment) : ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment->author; ?>
                            <small> <?php echo $comment->comment_date; ?> </small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>

                    <?php  endforeach; ?>
          

            </div>




      <!-- Blog Sidebar Widgets Column -->
     <!--  <div class="col-md-4"> -->

            
<?php // include("includes/sidebar.php"); ?>

</div>

<!-- </div> -->
<!-- /.row -->

<?php include("includes/footer.php"); ?>
