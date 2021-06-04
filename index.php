<?php ob_start(); ?>
<?php include("includes/header.php"); ?>


<?php
/* ---------------------------------------------------------------------------- */

/* PAGINATION */

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1 ;





$item_per_page = 20;

$item_total_count = Photo::count_all();

$paginate = new Paginate($page, $item_per_page, $item_total_count);

$sql  = "SELECT * FROM photos ";
$sql .= "LIMIT {$item_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$photos = Photo::find_by_query($sql);


/* ---------------------------------------------------------------------------- */
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="mb-3">
                        <label for="username1"> Username
                            <input placeholder="username" id="username1" type="text" name="username" class="form-control" minlength="3" required>
                            <ul class="input-requirements">
                                <li class="list-group-item">At least 3 characters long</li>
                                <li class="list-group-item">Must only contain letters and numbers (no special characters)</li>
                            </ul>
                        </label>
                    </div><div class="mb-3">
                        <label> First Name
                            <input placeholder="first name" type="text" name="first_name" class="form-control" required>
                        </label>
                    </div><div class="mb-3">
                        <label> Last Name
                            <input placeholder="Last Name" type="text" name="last_name" class="form-control" required>
                        </label>
                    </div><div class="mb-3">
                        <label> Email
                            <input placeholder="Email" type="email" name="email" class="form-control" required>
                            <ul class="input-requirements">
                                <li class="list-group-item">Enter a valid Email</li>
                            </ul>
                        </label>
                    </div><div class="mb-3">
                        <label> Password
                            <input placeholder="Password"
                                   type="password"
                                   id="password1"
                                   name="password"
                                   class="form-control" maxlength="100" minlength="8" required>
                            <ul class="input-requirements">
                                <li class="list-group-item">At least 8 characters long (and less than 100 characters)</li>
                                <li class="list-group-item">Contains at least 1 number</li>
                                <li class="list-group-item">Contains at least 1 lowercase letter</li>
                                <li class="list-group-item">Contains at least 1 uppercase letter</li>
                                <li class="list-group-item">Contains a special character (e.g. @ !)</li>
                            </ul>
                        </label>
                    </div><div class="mb-3">
                        <label> Confirm password
                            <input placeholder="Confirm password" type="password" id="password2" name="confirm_password" class="form-control">
                        </label>
                    </div><div class="mb-3">
                        <label> User Picture
                            <input type="file" name="file" class="form-control">
                        </label>
                    </div>
                    <input type="text" placeholder="is_admin" name="is_admin" hidden value="no">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->

   <div class="pictures row">
     
       <!-- Blog Entries Column -->
       <div class="col-md-12">
       
       <div class="row">
       <?php

   foreach($photos as $photo) : ?>

   
   
   <div class="col-xs-6 col-md-3">
   
   <div class="picture ">
   <a class="thumbnail" href="photo.php?id=<?php echo $photo->id;?>">

   <img class="home_page_photo img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
        <h5><p><?php echo $photo->title; ?></p></h5>
   </a>
   </div>
   </div>

   <?php endforeach; ?>

   </div>

</div>



<!-- page buttons -->

       <nav aria-label="Page navigation example">
  <ul class="pagination">

  <?php  
/* ---------------------------------------------------------------------------- */

  if($paginate->page_total() >1){

  if($paginate->has_next()){

  echo  "<li class='next page-item'><a class='page-link' href='index.php?page={$paginate->next()}'>Next</a></li>";


  }


  for($i=1; $i <= $paginate->page_total(); $i++){

  if($i == $paginate->current_page){

  echo  "<li class='active page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";


  } else{


  echo  "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";


  }

  }


      


  if($paginate->has_previous()){

    echo  "<li class='previous page-item'><a class='page-link' href='index.php?page={$paginate->previous()}'>Previous</a></li>";


  }


  }

     


     
/* ---------------------------------------------------------------------------- */

     ?>

  </ul>

       </nav>

  
  </div>

       <!-- Blog Sidebar Widgets Column -->
 
   <!-- /.row -->

   <?php include("includes/footer.php"); ?>
