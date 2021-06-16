<?php

class DB_Object{


    public $errors = array();
    public $upload_errors_array = array(


        UPLOAD_ERR_OK           => "There is no error",
        UPLOAD_ERR_INI_SIZE		=> "<div class='alert alert-danger'>The uploaded file exceeds the upload_max_filesize directive in php.ini</div>",
        UPLOAD_ERR_FORM_SIZE    => "<div class='alert alert-danger'>The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form</div>",
        UPLOAD_ERR_PARTIAL      => "<div class='alert alert-danger'>The uploaded file was only partially uploaded.</div>",
        UPLOAD_ERR_NO_FILE      => "<div class='alert alert-danger'>No file was uploaded.</div>",               
        UPLOAD_ERR_NO_TMP_DIR   => "<div class='alert alert-danger'>Missing a temporary folder.</div>",
        UPLOAD_ERR_CANT_WRITE   => "<div class='alert alert-danger'>Failed to write file to disk.</div>",
        UPLOAD_ERR_EXTENSION    => "<div class='alert alert-danger'>A PHP extension stopped the file upload.</div>"					
                                                    
    
    );
 /* ---------------------------------------------------------------------------- */

    public static function Search()
    {

        $search = $_POST['search'];
        if (isset($_POST['search'])) {

            $sql ="SELECT * FROM " . static::$db_table .   " WHERE title LIKE '%$search%' ";
            $sql .= "OR id LIKE '%$search%' ";
            $sql .= "OR username LIKE '%$search%' ";
            $sql .= "OR upload_date LIKE '%$search%' ";
            $searches = self::find_by_query($sql);



        }

        return $searches;

    }


 /* ---------------------------------------------------------------------------- */
    public static function find_all(){

    return static::find_by_query("SELECT * FROM "  . static::$db_table ." ");

    } // end of find_all
/* ---------------------------------------------------------------------------- */

    public static function find_by_id($id){

    $the_result_array= static::find_by_query("SELECT * FROM "  . static::$db_table ." WHERE id = $id LIMIT 1");

    return !empty($the_result_array) ? array_shift($the_result_array) : false; 


    }  // end of find_by_ID
/* ---------------------------------------------------------------------------- */

    public static function find_by_query($sql){

    global $database;
    $result_set = $database->query($sql);
    $the_object_array = array();

    while($row = mysqli_fetch_array($result_set)){

    $the_object_array[] = static::instantiation($row);

    }   


    return $the_object_array;


    } // end of find_by_query
/* ---------------------------------------------------------------------------- */

    
    public static function instantiation($the_record){

    $calling_class = get_called_class();

    $the_object = new $calling_class;


    foreach($the_record as $the_attribute => $value){

    if($the_object->has_the_attribute($the_attribute)){

    $the_object->$the_attribute = $value;

    }

    }


    return $the_object;


    } // end of instantiation
/* ---------------------------------------------------------------------------- */

    private function has_the_attribute($the_attribute){

   // $object_properties = get_object_vars($this);
    
   // return array_key_exists($the_attribute, $object_properties);
    return property_exists($this, $the_attribute);
    
    } // end of has_the_attribute
/* ---------------------------------------------------------------------------- */

    protected function properties(){

        $properties = array();
    
        foreach(static::$db_table_fields as $db_field){
    
        if(property_exists($this, $db_field)){
    
            $properties[$db_field] = $this->$db_field;
    
    
             }
    
            }
    
        return $properties;
    
        } // end of properties
/* ---------------------------------------------------------------------------- */

    protected function clean_properties(){

        global $database;
    
        $clean_properties = array();
    
        foreach($this->properties() as $key => $value){
    
            $clean_properties[$key] = $database->escape_string($value);
    
        }
    
        return $clean_properties;
    
        } // end of clean_properties
/* ---------------------------------------------------------------------------- */

    public function save() {
    
        return isset($this->id) ? $this->update() : $this->create();
    
    
        } // end of save
    /* ---------------------------------------------------------------------------- */

    
        public function create() {
    
        global $database;
    
        $properties = $this->clean_properties();
    
        $sql  = "INSERT INTO " . static::$db_table . "("  . implode(",", array_keys($properties))   . ")";
        $sql .= "VALUE ('". implode("','", array_values($properties)) ."')";
        
    
        if($database->query($sql)){
    
            $this->id = $database->the_insert_id();
    
            return true;
        
    
        }else{
            
            return false;
        
    
        }
    
    
        $database->query($sql);
        
    
    
        } // end of create
    /* ---------------------------------------------------------------------------- */

    
        public function update() {
    
        global $database;
    
        $properties = $this->clean_properties();
    
        $properties_pairs = array();
    
        foreach ($properties  as $key => $value){
    
        $properties_pairs[] = "{$key}='{$value}'";
    
        }
    
        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= " . $database->escape_string($this->id);
    
        $database->query($sql);
    
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    
        } // end of update
    /* ---------------------------------------------------------------------------- */

    
    
        public function delete() {
    
        global $database;
    
        $sql = "DELETE FROM ". static::$db_table . " ";
        $sql .= "WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";
        
        $database->query($sql);
    
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    
    
        } // end of delete
/* ---------------------------------------------------------------------------- */


        public static function count_all() {

			global $database;

			$sql = "SELECT COUNT(*) FROM " . static::$db_table;
			$result_set = $database->query($sql);
			$row = mysqli_fetch_array($result_set);

			return array_shift($row);


		} // end of count_all
 /* ---------------------------------------------------------------------------- */




} // end of class Object


?>