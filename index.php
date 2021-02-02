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





   <div class="row">
     
       <!-- Blog Entries Column -->
       <div class="col-md-12">
       
       <div class="thumbnail row">
       <?php

   foreach($photos as $photo) : ?>

   
   
   <div class="col-xs-6 col-md-3">
   
   
   <a class="thumbnail" href="photo.php?id=<?php echo $photo->id;?>">
   
   
   <img class="img-responsive home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
   
   </a>
   
   </div>
   
   



   <?php endforeach; ?>
       

   
   </div>
     
   

   
</div>



<!-- page buttons -->
  <ul class="pager">

  <?php  
/* ---------------------------------------------------------------------------- */

  if($paginate->page_total() >1){

  if($paginate->has_next()){

  echo  "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";


  }


  for($i=1; $i <= $paginate->page_total(); $i++){

  if($i == $paginate->current_page){

  echo  "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";


  } else{


  echo  "<li class=''><a href='index.php?page={$i}'>{$i}</a></li>";


  }

  }


      


  if($paginate->has_previous()){

    echo  "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";


  }


  }

     


     
/* ---------------------------------------------------------------------------- */

     ?>

  </ul>
  


  
  </div>

       <!-- Blog Sidebar Widgets Column -->
 
   <!-- /.row -->

   <?php include("includes/footer.php"); ?>