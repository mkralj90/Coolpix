     <?php $user = User::find_by_id($_SESSION['user_id']) ?>
     
     
     
     <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="upload.php?page=1"><i class="fa fa-fw fa-upload"></i> Upload</a>
                    </li>
                    <?php if($user->user_role == "admin") : ?>
                    <li>
                        <a href="users.php"><i class="fa fa-fw fa-users"></i> Users</a>
                    </li>
                    <?php endif; ?>
                    <?php if($user->user_role == "admin" || $user->user_role == "moderator") : ?>
                    <li>
                        <a href="photos.php"><i class="fa fa-fw fa-photo"></i> Photos</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-fw fa-comment"></i> Comments</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>