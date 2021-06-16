<?php

    class Session{

    private $signed_in = false;
    public $user_id;
    public $message;
    public $count;
    public $item_per_page = 10;

/* ---------------------------------------------------------------------------- */
    
   


    function __construct() {
    session_start();
    $this->check_the_login();
    $this->check_message();
    $this->visitor_count();

    }
    // end of __construct

 /* ---------------------------------------------------------------------------- */


    public function is_signed_in() {

    return $this->signed_in;


    } // end of is_signed_in
/* ---------------------------------------------------------------------------- */


    public function login($user) {
      
    if($user){

        $this->user_id = $_SESSION['user_id'] = $user->id;
		$this->signed_in = true;

    }

    } // end of login
/* ---------------------------------------------------------------------------- */


    public function logout() {
        
    unset($_SESSION['user_id']);
    unset($this->user_id);
    $this->signed_in = false;

    } // end of logout  
/* ---------------------------------------------------------------------------- */

    private function check_the_login() {

    if(isset($_SESSION['user_id'])) {

    $this->user_id = $_SESSION['user_id'];
    $this->signed_in = true;

    }else{

    unset($this->user_id);
    $this->signed_in = false;
    }


    } // end of check_the_login
/* ---------------------------------------------------------------------------- */


    public function message($msg=""){

    if(!empty($msg)){


    $_SESSION['message'] = $msg;

    }else{

        return $this->message;


    }

    } // end of message
/* ---------------------------------------------------------------------------- */



    private function check_message(){

    if(isset($_SESSION['message'])){
    
    $this->message = $_SESSION['message'];
    unset($_SESSION['message']);

    } else{
        

        $this->message = "";

    }


    } // end of check_message
/* ---------------------------------------------------------------------------- */


    public function visitor_count(){

    
		if(isset($_SESSION['count'])) {

			return $this->count = $_SESSION['count'] ++;

		} else {

			return $_SESSION['count'] = 0;


		}


    }


    }  // end of Session class
/* ---------------------------------------------------------------------------- */


    $session = new Session();
    $message = $session->message();
    