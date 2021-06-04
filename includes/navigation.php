<?php


if(isset($_POST['submit'])){

    $username =trim($_POST['username']);
    $password =trim($_POST['password']);

    $user_found = User::verify_user($username, $password);

    if($user_found){

        $session->login($user_found);
        redirect("index.php");

    }else{

        $the_message = "Your password or username are incorrect !!!";

    }

} else{

    $the_message = "";
    $username = "";
    $password = "";

}


?>


<nav class="mainnav navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="home navbar-brand" href="index.php"><img width="80px" src="css/images/Logo/logo_transparent.png" alt=""> </a>
                <a class="home1 navbar-brand" href="index.php"><p>Home</p></a>
                <a class="about navbar-brand" href="index.php"><p>About</p></a>

            </div>

            <!-- /.navbar-collapse -->
    <div class="top-right">

        <!--Login Modal-->

        <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form  action="" method="post" accept-charset="UTF-8" class="modal-login-form">
                            <div class="form-group">
                                <input name="username" placeholder="username" type="text" class="form-control">
                            </div>
                            <div class="from-group">
                                <input name="password" placeholder="password" type="password" class="form-control">
                            </div>
                            <button class="btn btn-primary btn-sm"  name="submit">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!--end login modal-->
        <div class="drop dropdown bg-dark">

            <button class="dropbtn1 btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if($session->is_signed_in()){echo "Welcome "; $user = User::find_by_id($_SESSION['user_id']); echo $user->username; }else{echo "My Account";}   ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                <div class="dropdowncontaoner">

                    <a class="logoutlink btn btn-dark" href="admin/index.php">Access Your Account</a>
                    <a class="logoutlink btn btn-dark" href="admin/logout.php">Logout</a>

                </div>

            </div>
        </div>


        <!-- Button trigger Loginmodal -->
        <?php if(!$session->is_signed_in()) : ?>
        <button type="button" class="btnmodallog btn btn-dark" data-bs-toggle="modal" data-bs-target="#loginmodal">
            Login
        </button>
        <?php endif; ?>
    </div>
        </div>
        <!-- /.container -->
    </nav>





