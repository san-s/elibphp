
<?php include('inc/head.php') ?>

<body>

	<?php include("inc/header.php") ?>
	<div id="wrap">
		<div id="" class="w-1/3 mx-auto py-8">
		<form action="inc/controller/auth_controller.php" method="POST">
                <h3 class="login-circle"><i class="fa fa-user-plus"></i></h3>
                <h4 class="center my-4">Signup</h4>
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
                    <input type="tel" name="phone" placeholder="Please enter your phone">
                </div>
                <div class="form-control mt-2">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="Please enter your password">
                </div>
                <div class="form-control mt-2">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="re_password" placeholder="Please re enter your password">
                </div>
                <button type="submit" class="mt-2 btn-login block ml-auto" name="registration">Signup</button>
            </form>
		</div>
		<?php include("inc/footer.php") ?>
	</div>

</body>

</html>