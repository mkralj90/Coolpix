<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php $user = User::find_by_id($_SESSION['user_id']); if($user->user_role == "subscriber") {redirect("index.php");} ?>


<?php $comments = Comment::find_all(); ?>


        <!-- Navigation -->
       
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">


<!-- Brand and toggle get grouped for better mobile display -->

        <?php include("includes/top_nav.php"); ?>




            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

       <?php include("includes/side_nav.php"); ?>

            <!-- /.navbar-collapse -->
        </nav>


        <div id="page-wrapper">

        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Comments
        </h1>

        <p class="bg-success"><?php echo $message; ?></p>
        
    <div class="col-md-12">

    <table class="table table-hover">
    
        <thead>
        
            <tr>
            
               
                <th>ID</th>
                <th>Author</th>
                <th>Body</th>
               
            
            </tr>
        
        </thead>
    
        <tbody>
        
        <?php 
/* ---------------------------------------------------------------------------- */

        foreach($comments as $comment) :  ?>

            <tr>
            
                <td><?php echo $comment->photo_id; ?></td>
                <td><?php echo $comment->author; ?>
            
                <div class="actions_link">
                
                <a class="btn btn-danger delete_link" href="delete_comment.php?id=<?php echo $comment->id;?>">Delete</a>
                    <!-- Button trigger Loginmodal -->
                    <?php if($session->is_signed_in()) : ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentmodal">
                            Edit
                        </button>
                    <?php endif; ?>

                    <!--Edit comment Modal-->

                    <div class="modal fade" id="commentmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form  action="" method="post" accept-charset="UTF-8" class="modal-login-form">
                                        <div class="form-group">
                                            <input name="username" placeholder="username" type="text" class="form-control">
                                        </div>
                                        <div class="from-group">
                                            <input name="password" placeholder="password" type="password" class="form-control">
                                        </div>
                                        <button class="btn btn-primary btn-sm"  name="submit">Submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end login modal-->
                
                </div>
            
            </td>
                
                <td><?php echo substr($comment->body,0,100); ?></td>
        
            
            </tr>
            

    <?php 

endforeach; 
/* ---------------------------------------------------------------------------- */

?>

        </tbody>



    </table> <!-- end of table -->
    
    
    </div>

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>