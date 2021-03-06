<?php include("includes/admin_header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php $user = User::find_by_id($_SESSION['user_id']); ?>



<?php

/* PAGINATION */

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1 ;



switch ($_GET['item_per_page']){

    case"5": $item_per_page = 5; break;
    case"10": $item_per_page = 10; break;
    case"15": $item_per_page = 15; break;
    case"20": $item_per_page = 20; break;
    default: $item_per_page = 10;

}



$item_total_count = Photo::count_all();

$paginate = new Paginate($page, $item_per_page, $item_total_count);

$sql  = "SELECT * FROM photos ";
$sql .= "LIMIT {$item_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$photos = Photo::find_by_query($sql);


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
                    Photos
                </h1>
                <p class="bg-success"><?php echo $message;?></p>
                <div class="col-md-12">
                    <?php





                    ?>

    <table class="table table-hover">

        <thead>

        <tr>

            <th>Photo</th>
            <th>ID</th>
            <th>Caption</th>
            <th>Title</th>
            <th>Username</th>
            <th>Description</th>
            <th>Alternate Text</th>
            <th>File Name</th>
            <th>Upload Date</th>
            <th>Size</th>
            <th>Comments</th>

        </tr>

        </thead>

        <tbody>
        <?php
    /* ---------------------------------------------------------------------------- */


    $photos = Photo::Search();
    foreach($photos as $photo) :  ?>

        <tr>

            <td><img width="200px" class="admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt="">

                <div class="action_link">
                    <?php if($user->user_role == "admin" || $user->user_role == "moderator") : ?>
                        <a class="btn btn-danger delete_link" href="delete_photo.php?id=<?php echo $photo->id;?>">Delete</a>
                        <a class="btn btn-primary" href="edit_photos.php?id=<?php echo $photo->id;?>&page=1">Edit</a>
                        <a class="btn btn-primary" href="../photo.php?id=<?php echo $photo->id;?>">View</a>
                    <?php endif; ?>

                </div>


            </td>
            <td><?php echo $photo->id; ?></td>
            <td><?php echo $photo->caption; ?></td>
            <td><?php echo $photo->title; ?></td>
            <td><?php echo $photo->username; ?></td>
            <td><?php echo $photo->description; ?></td>
            <td><?php echo $photo->alternate_text; ?></td>
            <td><?php echo $photo->filename; ?></td>
            <td><?php echo $photo->upload_date; ?></td>
            <td><?php echo $photo->size; ?></td>

            <td>
                <a href="comment_photo.php?id=<?php echo $photo->id; ?>">
                    <?php

                    $comments = Comment::find_the_comments($photo->id);
                    echo count($comments);

                    ?>

                </a>

            </td>

        </tr>


    <?php endforeach; ?>


    </tbody>



</table> <!-- end of table -->

<!-- page buttons -->
<!-- page buttons -->

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Photos per page
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a href="photos.php?page=<?php echo $page=1;?>&item_per_page=5">5</a>

                                    <li>
                                        <a href="photos.php?page=<?php echo $page=1;?>&item_per_page=10">10</a>

                                    </li>
                                    <li>
                                        <a href="photos.php?page=<?php echo $page=1;?>&item_per_page=15">15</a>

                                    </li>
                                    <li>
                                        <a href="photos.php?page=<?php echo $page=1;?>&item_per_page=20">20</a>

                                    </li>
                                </ul>
                            </div>



                            <?php
                            /* ---------------------------------------------------------------------------- */

                            if($paginate->page_total() >1){

                                if($paginate->has_next()){

                                    echo  "<li class='next page-item'><a class='page-link' href='photos.php?page={$paginate->next()}'>Next</a></li>";

                                }

                                for($i=1; $i <= $paginate->page_total(); $i++){

                                    if($i == $paginate->current_page){

                                        echo  "<li class='active page-item'><a class='page-link' href='photos.php?page={$i}&item_per_page={$item_per_page}'>{$i}</a></li>";

                                    } else{

                                        echo  "<li class='page-item'><a class='page-link' href='photos.php?page={$i}&item_per_page={$item_per_page}'>{$i}</a></li>";

                                    }

                                }

                                if($paginate->has_previous()){

                                    echo  "<li class='previous page-item'><a class='page-link' href='photos.php?page={$paginate->previous()}'>Previous</a></li>";

                                }

                            }


                            /* ---------------------------------------------------------------------------- */

                            ?>

                        </ul>

                    </nav>

                </div>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->


</div>
<!-- /#page-wrapper -->



<?php include("includes/admin_footer.php"); ?>