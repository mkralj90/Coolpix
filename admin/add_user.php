<?php include("includes/header.php"); ?>
    <?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


    <?php $users = User::find_all(); ?>

    <?php  
/* ---------------------------------------------------------------------------- */



  

        $user = new User();        
        
        if(isset($_POST['create'])) {

            if($user){

            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->password =$_POST['password'];
            $user->first_name =$_POST['first_name'];
            $user->last_name =$_POST['last_name'];
            $user->date_created = date('d-m-Y H:i:s');
            $user->user_role =$_POST['user_role'];
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            

            redirect("users.php");
            $session->message("The user {$user->username} has been created");
            

            


        }else{
                redirect("users.php");
                $session->message("Something went wrong");

            }


        
    }
/* ---------------------------------------------------------------------------- */



?>

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
            Users
            <small>Create</small>
        </h1>
        <?php echo $message; ?>
    <form action="" method="post" enctype="multipart/form-data">  <!-- start edit form -->
    <div class="col-md-6 col-md-offset-3"> 
 
    <div class="form-group">
    
    <label for="">Photo</label>
    <input type="file" name="user_image">
    
    </div>
    <div class="form-group">
    
    <label for="">Username</label>
    <input type="text" name="username" class="form-control" >
    
    </div>
        <div class="form-group">

    <label for="">Email</label>
    <input type="email" name="email" class="form-control" >

    </div>
 
  

    <div class="form-group">

    <label for="">Password</label>
    <input type="password" name="password" class="form-control">
    
    </div>
        <div class="form-group">

    <label for="">Confirm Password</label>
    <input type="password" name="confirmpassword" class="form-control">

    </div>
   
    <div class="form-group">

    <label for="">First Name</label>
    <input type="text" name="first_name" class="form-control" >
    
    </div>
   
    <div class="form-group">

    <label for="">Last Name</label>
    <input type="text" name="last_name" class="form-control" >
    
    </div>
        <input name="user_role" type="text" value="subscriber" hidden>
    <div class="form-group">

    <input type="submit" name="create" class="btn btn-primary pull-right" >
    
    </div>
   
    
   
    
    </div> 



      </div>

     </form>  <!-- end of edit form -->

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>