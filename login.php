<?php include('inc/head.php') ?>


<body>

	<?php include("inc/header.php") ?>
	<div id="wrap">
		<div id="" class="w-1/3 mx-auto py-8">
			<form action="inc/controller/auth_controller.php" method="POST">
				<h3 class="login-circle"><i class="fa fa-user"></i></h3>
				<h4 class="center mt-2">Login</h4>
				<div class="form-control mt-2">
					<i class="fa fa-envelope"></i>
					<input type="text" name="email" placeholder="Please enter your email">
				</div>
				<div class="form-control mt-2">
					<i class="fa fa-lock"></i>
					<input type="password" name="password" placeholder="Please enter your password">
				</div>
				<div class="">
					<input type="checkbox" name="remember_me">
					<span class="ml-1 text-xss text-gray-500">Remember me</span>
				</div>
				<div class="flex space-between items-center mt-2">
					<button type="submit" name="login" class="btn-login">Login</button>
					<a href="">
						<h5>Forgot password?</h5>
					</a>
				</div>
			</form>
		</div>
		<?php include("inc/footer.php") ?>
	</div>

</body>

</html>