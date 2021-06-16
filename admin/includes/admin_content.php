<?php $user = User::find_by_id($_SESSION['user_id']); ?>


<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
 <div class="col-lg-12">
     <h1 class="page-header">
         Admin
         <small>Website Activity</small>
     </h1>
    <?php if($user->user_role == "admin" || $user->user_role == "moderator") : ?>
	        <!-- New Views -->
     <div class="row">
 <div class="col-lg-3 col-md-6">
     <div class="panel panel-green">
         <div class="panel-heading">
             <div class="row">
                 <div class="col-xs-3">
                     <i class="fa fa-users fa-5x"></i>
                 </div>
                 <div class="col-xs-9 text-right">
                     <div class="huge"><?php echo $session->count; ?></div>
                     <div>New Views</div>
                 </div>
             </div>
         </div>
         <a href="#">
             <div class="panel-footer">
               <span class="pull-left">View Details</span> 
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                 <div class="clearfix"></div>
             </div>
         </a>
     </div>
 </div>
  <!-- ----------------------------------------------------------------------------- -->

 <!-- Photos -->
  <div class="col-lg-3 col-md-6">
     <div class="panel panel-green">
         <div class="panel-heading">
             <div class="row">
                 <div class="col-xs-3">
                     <i class="fa fa-photo fa-5x"></i>
                 </div>
                 <div class="col-xs-9 text-right">
                     <div class="huge"><?php echo Photo::count_all(); ?></div>
                     <div>Photos</div>
                 </div>
             </div>
         </div>
         <a href="photos.php">
             <div class="panel-footer">
                 <span class="pull-left">Total Photos in Gallery</span>
                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                 <div class="clearfix"></div>
             </div>
         </a>
     </div>
 </div>
<!-- ----------------------------------------------------------------------------- -->
 <!-- Users -->
  <div class="col-lg-3 col-md-6">
     <div class="panel panel-yellow">
         <div class="panel-heading">
             <div class="row">
                 <div class="col-xs-3">
                     <i class="fa fa-user fa-5x"></i>
                 </div>
                 <div class="col-xs-9 text-right">
                     <div class="huge"><?php echo User::count_all(); ?>

                     </div>

                     <div>Users</div>
                 </div>
             </div>
         </div>
         <a href="users.php">
             <div class="panel-footer">
                 <?php if($user->user_role != "admin"){ echo "<div class='alert alert-danger'>You do not have access !!</div>";} ?>
                 <span class="pull-left">Total Users</span>
                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                 <div class="clearfix"></div>
             </div>
         </a>
     </div>
 </div>
   <!-- ----------------------------------------------------------------------------- -->
 <!-- Comments -->
   <div class="col-lg-3 col-md-6">
     <div class="panel panel-red">
         <div class="panel-heading">
             <div class="row">
                 <div class="col-xs-3">
                     <i class="fa fa-support fa-5x"></i>
                 </div>
                 <div class="col-xs-9 text-right">
                     <div class="huge"><?php echo Comment::count_all(); ?></div>
                     <div>Comments</div>
                 </div>
             </div>
         </div>
         <a href="comments.php">
             <div class="panel-footer">
                 <span class="pull-left">Total Comments</span>
                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                 <div class="clearfix"></div>
             </div>
         </a>
     </div>
 </div>


     </div> <!--First Row-->

<!-- google chart -->
   <!-- website activity -->
<div id="piechart" class="col-xs-6 col-md-12 col-xs-offset-0 col-xs-pull-5 col-sm-pull-0 col-md-pull-0 " style="width: 900px; height: 500px;"></div>

<?php endif; ?>
 </div>
</div>
<!-- /.row -->


</div>
<!-- /.container-fluid -->