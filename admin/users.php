<?php include("includes/admin_header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php $active_user = User::find_by_id($_SESSION['user_id']); if($active_user->user_role != "admin") {redirect("index.php");} ?>

<?php $users = User::find_all(); ?>


        <!-- Navigation -->
       
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">


<!-- Brand and toggle get grouped for better mobile display -->

        <?php include("includes/top_nav.php"); ?>




            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

       <?php include("includes/side_nav.php");  ?>

            <!-- /.navbar-collapse -->
        </nav>






        <div id="page-wrapper">
        
        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Users
        </h1>
        <p class="bg-success"> <?php echo $message; ?>  </p>

        <a href="add_user.php" class="btn btn-primary">Add User</a>

        
    <div class="col-md-12">
    <?php 
    
    
    
    
    
    ?>

    <table class="table table-hover">
    
        <thead>
        
            <tr>
            
               
                <th>ID</th>
                <th>Photo</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date Registered</th>
                <th>User Role</th>

            
            </tr>
        
        </thead>
    
        <tbody>
        
        <?php 
/* ---------------------------------------------------------------------------- */

        foreach($users as $user) :  ?>

            <tr>
            
                <td><?php echo $user->id; ?></td>
                <td><img width="100px" class="admin-user-thumbnail" src="<?php   echo $user->image_path_and_placeholder(); ?>" alt=""> </td>
                <td><?php echo $user->username; ?>
                <div class="actions_link">

                <a class="btn btn-danger delete_link"  href="delete_user.php?id=<?php echo $user->id;?>">Delete</a>
                <a class="btn btn-primary" href="edit_user.php?id=<?php echo $user->id;?>">Edit</a>
                <a class="btn btn-primary" href="view_user.php?id=<?php echo $user->id;?>">View User</a>
                </div>
            </td>

                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->first_name; ?></td>
                <td><?php echo $user->last_name; ?></td>
                <td><?php echo $user->date_created; ?></td>
                <td><?php echo $user->user_role; ?></td>

            
            </tr>
            

    <?php endforeach; 
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

  <?php include("includes/admin_footer.php"); ?>