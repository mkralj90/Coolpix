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




   <div class="pictures row">
     
       <!-- Blog Entries Column -->
       <div class="col-md-12">
       
       <div class="row">

       <?php if($session->is_signed_in()) : ?>
       <?php foreach($photos as $photo) : ?>

   
   
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

  <?php  endif; ?>
  <?php if(!$session->is_signed_in()){ echo "<div class='alert alert-danger'>You must register or login to see content !!</div>";} ?>
  </div>

       <!-- Blog Sidebar Widgets Column -->
 
   <!-- /.row -->

   <?php include("includes/footer.php"); ?>
