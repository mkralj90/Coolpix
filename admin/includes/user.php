<?php

class User extends DB_Object{

protected static $db_table = "users";
protected static $db_table_fields = array('username','email', 'user_image', 'password', 'first_name', 'last_name', 'user_role', 'NOW()');

public $id;
public $username;
public $email;
public $user_image;
public $password;
public $first_name;
public $last_name;
public $user_role;
public $date_created;
public $upload_directory = "user_images";
public $image_placeholder = "http://placehold.it/400x400&text=image";
public $tmp_path;
/* ---------------------------------------------------------------------------- */




/* ---------------------------------------------------------------------------- */


public function image_path_and_placeholder(){

return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;


} // end of image_path_and_placeholder
/* ---------------------------------------------------------------------------- */



public static function verify_user($username, $password ){

global $database;

$username = $database->escape_string($username);
$password = $database->escape_string($password);

$sql = "SELECT * FROM "  . self::$db_table ." WHERE ";
$sql .= "username = '{$username}' ";
$sql .= "AND password = '{$password}' ";
$sql .= "LIMIT 1";

$the_result_array = self::find_by_query($sql);

return !empty($the_result_array) ? array_shift($the_result_array) : false; 



} // end of verify_user
/* ---------------------------------------------------------------------------- */


public function set_file($file) {


    if(empty($file) || !$file || !is_array($file)) {

    $this->errors[] = "<div class='alert alert-danger'>There was no file uploaded here</div>";
    return false;
    
    }elseif($file['error'] !=0){

    $this->errors[] = $this->upload_errors_array[$file['error']];
    return false;

    }else {

    $this->user_image = basename($file['name']);
    $this->tmp_path = $file['tmp_name'];
    $this->type     = $file['type'];
    $this->size     = $file['size'];



    }


   
    } // end of set_file
/* ---------------------------------------------------------------------------- */

    public function upload_photo(){

     
    
            if(!empty($this->errors)){
    
                return false;
            }
            if(empty($this->user_image) || empty($this->tmp_path)){
    
                $this->errors[] = "<div class='alert alert-danger'>The file was not available</div>";

                return false;
            }
    
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
    
    
            if(file_exists($target_path)){
                $this->errors[] = "<div class='alert alert-danger'>The file {$this->user_image} already exists</div>";

            return false;
    
            }
    
            if(move_uploaded_file($this->tmp_path, $target_path)){
    
               
                 
                    unset($this->tmp_path);
                    return true;
                    
            }else {
    
                $this->errors[] = "<div class='alert alert-danger'>The file directory does not have permission !!</div>";
                return false;
    
            
        }
    
        
    
        } // end of upload_photo
/* ---------------------------------------------------------------------------- */

 

        public function picture_path(){

            return $this->upload_directory.DS.$this->user_image;
    
        }



        public function delete_user(){


            if($this->delete()){
        
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path(); 
        
        
            return unlink($target_path) ? true : false;
           
            }else{
        
            return false;
        
            }
        
        
        
            } // end of delete_photo
/* ---------------------------------------------------------------------------- */

public function ajax_save_user_image($user_image, $user_id){

global $database;

$user_image = $database->escape_string($user_image);
$user_id = $database->escape_string($user_id);

$this->user_image = $user_image;
$this->id         = $user_id;

$sql  = "UPDATE " .self::$db_table . " SET user_image = '{$this->user_image}'";
$sql .= " WHERE id = {$this->id}";
$update_image = $database->query($sql);

echo $this->image_path_and_placeholder();


} // end of ajax_save_user_image
/* ---------------------------------------------------------------------------- */


} // End of class User  /* ---------------------------------------------------------------------------- */







?>