     <?php $user = User::find_by_id($_SESSION['user_id']) ?>
     
     
     


    <div class="side-nav-left">

     <ul class="nav flex-column">

         <li class="nav-item">
             <a class="nav-link" href="index.php?item_per_page"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
         </li>

         <li class="nav-item">
             <a class="nav-link" href="upload.php?page=1"><i class="fa fa-fw fa-upload"></i> Upload</a>

         </li>

         <?php if($user->user_role == "admin") : ?>

         <li class="nav-item">
             <a class="nav-link" href="users.php?item_per_page"><i class="fa fa-fw fa-users"></i> Users</a>
         </li>

         <?php endif; ?>

         <?php if($user->user_role == "admin" || $user->user_role == "moderator") : ?>

         <li class="nav-item">
             <a class="nav-link" href="photos.php?item_per_page"><i class="fa fa-fw fa-photo"></i> Photos</a>

         </li>
         <li class="nav-item">
             <a class="nav-link" href="comments.php?item_per_page"><i class="fa fa-fw fa-comment"></i> Comments</a>

         </li>
         <?php endif; ?>

     </ul>

    </div>