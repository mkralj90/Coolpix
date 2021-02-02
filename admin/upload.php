<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php 
/* ---------------------------------------------------------------------------- */

$find_user = User::find_by_id($_SESSION['user_id']);
if(isset($_FILES['file'])){

$photo = new Photo();
$photo->title = $_POST['title'];
$photo->username = $_POST['username'];
$photo->description = $_POST['description'];
$photo->caption = $_POST['caption'];
$photo->alternate_text = $_POST['alternate_text'];
$photo->upload_date = date('d-m-y H:i:s');
$photo->set_file($_FILES['file']);


if($photo->save()){
    redirect("photos.php");
    $session->message("<div class='alert alert-success'>File was uploaded successfully</div>");

}else{
    redirect("photos.php");
    $session->message(join("<br>",$photo->errors));
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
            Upload
        </h1>
        <div class="row">
      <div class="col-md-6">

      <?php echo $message;  ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
    <label for="">Title</label>
    <input type="text" name="title" id="" class="form-control">
    
    </div>
    <div class="form-group">
    <label for="">Username</label>
    <input  type="text" name="username" id="" class="form-control" value="<?php echo $find_user->username; ?>">
    
    </div>

    <div class="form-group">

    <label for="">Caption</label>
    <input type="text" name="caption" class="form-control">

    </div>

    <div class="form-group">

    <label for="">Alternate Text</label>
    <input type="text" name="alternate_text" class="form-control">
    
    </div>

    <div class="form-group">
    <label for="">Description</label>
    <input type="text" name="description" id="" class="form-control">
    
    </div>

    <div class="form-group">
    
    <input type="file" name="file" id="" class="form-control">
    
    </div>
    
    <input class="btn btn-primary" type="submit" name="submit">
    
    </form>
    </div>
    </div>
    </div>
</div><!-- /.row -->
<div class="row">

<div class="col-lg-12">

    <form action="upload.php" class="dropzone"></form>

</div>


</div>
</div>
<!-- /.container-fluid -->


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>

