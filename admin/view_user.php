<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("users.php");} ?>


<?php  $user = User::find_by_id($_GET['id']); ?>



<div class="container">


    <div class="row">
    <h1 class="page-header">
                User
            </h1>
    <h2> <?php echo $user->username; ?>   </h2>

    <img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt="">

    </div>


</div>



<?php include("includes/footer.php"); ?>