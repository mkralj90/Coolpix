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



        <!-- Register Modal -->
        <div class="modal fade" id="registermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Register New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form>
                            <div class="mb-3">
                                <label for="username1"> Username
                                    <input placeholder="username" id="username1" type="text" name="username" class="form-control" minlength="3" required>
                                    <ul class="input-requirements">
                                        <li class="list-group-item">At least 3 characters long</li>
                                        <li class="list-group-item">Must only contain letters and numbers (no special characters)</li>
                                    </ul>
                                </label>
                            </div><div class="mb-3">
                                <label> First Name
                                    <input placeholder="first name" type="text" name="first_name" class="form-control" required>
                                </label>
                            </div><div class="mb-3">
                                <label> Last Name
                                    <input placeholder="Last Name" type="text" name="last_name" class="form-control" required>
                                </label>
                            </div><div class="mb-3">
                                <label> Email
                                    <input placeholder="Email" type="email" name="email" class="form-control" required>
                                    <ul class="input-requirements">
                                        <li class="list-group-item">Enter a valid Email</li>
                                    </ul>
                                </label>
                            </div><div class="mb-3">
                                <label> Password
                                    <input placeholder="Password"
                                           type="password"
                                           id="password1"
                                           name="password"
                                           class="form-control" maxlength="100" minlength="8" required>
                                    <ul class="input-requirements">
                                        <li class="list-group-item">At least 8 characters long (and less than 100 characters)</li>
                                        <li class="list-group-item">Contains at least 1 number</li>
                                        <li class="list-group-item">Contains at least 1 lowercase letter</li>
                                        <li class="list-group-item">Contains at least 1 uppercase letter</li>
                                        <li class="list-group-item">Contains a special character (e.g. @ !)</li>
                                    </ul>
                                </label>
                            </div><div class="mb-3">
                                <label> Confirm password
                                    <input placeholder="Confirm password" type="password" id="password2" name="confirm_password" class="form-control">
                                </label>
                            </div><div class="mb-3">
                                <label> User Picture
                                    <input type="file" name="file" class="form-control">
                                </label>
                            </div>
                            <input type="text" placeholder="is_admin" name="is_admin" hidden value="no">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end of register modal-->
        <div class="drop dropdown bg-dark">

            <button class="dropbtn1 btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if($session->is_signed_in()){echo "Welcome "; $user = User::find_by_id($_SESSION['user_id']); echo $user->username; }else{echo "My Account";}   ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                <div class="dropdowncontaoner">

                    <a class="logoutlink btn btn-dark" href="admin/index.php">Access Your Account</a>
                    <button type="button" class="logoutlink btn btn-dark" data-bs-toggle="modal" data-bs-target="#registermodal">
                        Register New User
                    </button>
                    <a class="logoutlink btn btn-dark" href="admin/logout.php">Logout</a>


                </div>

            </div>
        </div>


        <!-- Button trigger Loginmodal -->
        <?php if(!$session->is_signed_in()) : ?>
        <button type="button" class="btnmodallog btn btn-dark" data-bs-toggle="modal" data-bs-target="#loginmodal">
            Login
        </button>
        <button type="button" class="btnmodalreg btn btn-dark" data-bs-toggle="modal" data-bs-target="#registermodal">
           <?php if (!$session->is_signed_in()){echo "Register";}else{echo "Register new User";} ?>
        </button>
        <?php endif; ?>
    </div>
        </div>
        <!-- /.container -->
    </nav>




