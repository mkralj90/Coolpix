    <?php

    require_once("new_config.php");


    class Database {

    public $connection;


    function __construct(){

    $this->open_db_connection();

    } // end of __construct
/* ---------------------------------------------------------------------------- */



    public function open_db_connection(){


    $this->connection = new Mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    if($this->connection->connect_errno){

    die("Database connection failed badly" . $this->connection->connect_error);

            }else{

             
            }

        }  // end of open_db_connection
/* ---------------------------------------------------------------------------- */


    public function query($sql){

    $result = $this->connection->query($sql);

    $this->confirm_query($result);

    return $result;

    }  // end of query
/* ---------------------------------------------------------------------------- */

    private function confirm_query($result){

        if(!$result){

            die("Query Failed" . $this->connection->error);
        }

    } // end of confirm_query
/* ---------------------------------------------------------------------------- */


    public function escape_string($string){

    $escaped_string = $this->connection->real_escape_string($string);

    return $escaped_string;

    } // end of escape_string
/* ---------------------------------------------------------------------------- */

    public function the_insert_ID() {
    return mysqli_insert_id($this->connection);

    } // end of the_insert_ID
/* ---------------------------------------------------------------------------- */



    } // end of Database class


    $database = new Database();



