<?php

class Photo extends DB_Object{

    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'username', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size','NOW()');
    
    public $id;
    public $title;
    public $username;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;
    public $upload_date;   

    public $tmp_path;
    public $upload_directory = "images";
/* ---------------------------------------------------------------------------- */


    // This is passing $_FILES['uploaded_file] as an argument

    public function set_file($file) {


    if(empty($file) || !$file || !is_array($file)) {

    $this->errors[] = "<div class='alert alert-danger'>There was no file uploaded here</div>";
    return false;
    
    }elseif($file['error'] !=0){

    $this->errors[] = $this->upload_errors_array[$file['error']];
    return false;

    }else {

    $this->filename = basename($file['name']);
    $this->tmp_path = $file['tmp_name'];
    $this->type     = $file['type'];
    $this->size     = $file['size'];



    }


   
    } // end of set_file
/* ---------------------------------------------------------------------------- */



    public function picture_path(){

        return $this->upload_directory.DS.$this->filename;

    }


    public function save(){

    if($this->id){
        $this->update();
 
    }else{

        if(!empty($this->errors)){

            return false;
        }
        if(empty($this->filename) || empty($this->tmp_path)){

            $this->errors[] = "<div class='alert alert-danger'>the file was not available</div>";
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;


        if(file_exists($target_path)){
        
        $this->errors[] = "<div class='alert alert-danger'>The file {$this->filename} already exists</div>";
        return false;

        }

        if(move_uploaded_file($this->tmp_path, $target_path)){

            if($this->create()){

                unset($this->tmp_path);
                return true;
            }
        }else {

            $this->errors[] = "<div class='alert alert-danger'>The file directory does not have permission !!</div>";
            return false;

        
    }

    }

    } // end of save
 /* ---------------------------------------------------------------------------- */



    public function delete_photo(){


    if($this->delete()){

    $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path(); 


    return unlink($target_path) ? true : false;
   
    }else{

    return false;

    }



    } // end of delete_photo
/* ---------------------------------------------------------------------------- */

    public function comments(){

    return Comment::find_the_comments($this->id);

    } // end of comments

/* ---------------------------------------------------------------------------- */

    public static function display_sidebar_data($photo_id){

    $photo = Photo::find_by_id($photo_id);

    $output = "<a class='thumbnail text-secondary bg-info' href='#'><img width='100' src='{$photo->picture_path()}'></a> ";   
    $output .= "<p class='bg-info text-secondary'>{$photo->filename}</p>";
    $output .= "<p class='bg-info text-secondary'>{$photo->username}</p>";
    $output .= "<p class='bg-info text-secondary'>{$photo->type}</p>";
    $output .= "<p class='bg-info text-secondary'>{$photo->size}</p>";

    echo $output;
    


    }  // end of display_sidebar_data
    


/* ---------------------------------------------------------------------------- */


} // end of photo class


?>