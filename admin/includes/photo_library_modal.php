<?php require_once("init.php") ?>

<?php

$photos = Photo::find_all();


?>

<div class="modal fade col-xs-12 col-sm-12 col-md-12" id="photo-library">
  <div class="modal-dialog">
    <div class="modal-content col-xs-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Gallery System Library</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-9">
             <div class="thumbnails col-xs-10 col-md-12 row">
            
               <?php foreach($photos as $photo) : ?>
                
               <div class="col-xs-6 col-sm-6 col-lg-2">
                 <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail">
                   <img class="modal_thumbnails img" src="<?php echo $photo->picture_path(); ?>" data="<?php echo $photo->id; ?>">
                 </a>
                  <div class="photo-id hidden"></div>
               </div>
                <?php endforeach; ?>

             </div>
          </div><!--col-md-9 -->

  <div class="col-sm-3 col-md-3">
    <div id="modal_sidebar"></div>
  </div>

   </div><!--Modal Body-->
      <div class="modal-footer">
        <div class="row">
               <!--Closes Modal-->
              <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Apply Selection</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- ------------------------------------------------------------------------------ -->
