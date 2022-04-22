<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/function.php'); ?> <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["success_message"])) {
    echo '<script type="text/javascript">toastr.success("' . $_SESSION["success_message"] . '")</script>';
    unset($_SESSION["success_message"]);
}
if (isset($_SESSION["error_message"])) {
    echo '<script type="text/javascript">toastr.error("' . $_SESSION["error_message"] . '")</script>';
    unset($_SESSION["error_message"]);
}

?>
<div id="header">
    <div id="up-header">
        <div id="date">
            <p>
                <?php echo date('l, d F Y') ?>
            </p>
        </div>
        <div id="slog">
            <p>No.1 E Learning Website</p>
        </div>
    </div>
    <div id="down-header">
        <div id="title">
            <h2><a href="index.php">E Library</a></h2>
        </div>
        <div id="menu">
            <h2><i class="fas fa-bars"></i></h2>
            <?php include("inc/cat_main.php") ?>
        </div>
        <div id="header-search">
            <form action="search.php">
                <input type="search" name="query" placeholder="Search books">
                <button><i class="fas fa-search"></i></button>
            </form>
        </div>

        <?php if (isset($_SESSION['user'])) { ?>
            <form action="inc/controller/auth_controller.php" method="POST">
                <button type="submit" name="logout">
                    <p class="text-gray-500"><i class="fas fa-user mr-1"></i>Logout</p>
                </button>
            </form>
        <?php } else { ?>
            <div id="header-login">
                <h4><a href=""><i class="fas fa-user"></i>Login</a></h4>
                <form action="inc/controller/auth_controller.php" method="POST">
                    <h3><i class="fa fa-user"></i></h3>
                    <h4 class="center">Login</h4>
                    <div class="form-control mt-2">
                        <i class="fa fa-envelope"></i>
                        <input type="text" name="email" placeholder="Please enter your email">
                    </div>
                    <div class="form-control">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Please enter your password">
                    </div>
                    <div class="flex space-between items-center">
                        <button type="submit" name="login">Login</button>
                        <a href="">
                            <h5>Forgot password?</h5>
                        </a>
                    </div>
                </form>
            </div>
            <div id="header-signup">
                <h4><a href=""><i class="fas fa-user-plus"></i>Signup</a></h4>
                <form action="inc/controller/auth_controller.php" method="POST">
                    <h3><i class="fa fa-user-plus"></i></h3>
                    <h4 class="center">Signup</h4>
                    <div class="form-control">
                        <i class="fa fa-user"></i>
                        <input type="text" name="username" placeholder="Please enter your name">
                    </div>
                    <div class="form-control mt-2">
                        <i class="fa fa-envelope"></i>
                        <input type="text" name="email" placeholder="Please enter your email">
                    </div>
                    <div class="form-control mt-2">
                        <i class="fa fa-phone"></i>
                        <input type="text" name="phone" placeholder="Please enter your phone">
                    </div>
                    <div class="form-control mt-2">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Please enter your password">
                    </div>
                    <div class="form-control mt-2">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="re_password" placeholder="Please re enter your password">
                    </div>
                    <button type="submit" class="mt-2" name="registration">Signup</button>
                </form>
            </div>
        <?php } ?>

    </div>
</div>