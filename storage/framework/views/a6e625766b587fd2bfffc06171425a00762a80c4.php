<!DOCTYPE HTML>
<html lang="en">
<head>
<title>FoodChilli- Admin Login</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Classic Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->

<!-- css files -->
<link rel="stylesheet" href="<?php echo e(url('Backend/css/style-login.css')); ?>" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="<?php echo e(url('Backend/css/font-awesome-login.css')); ?>"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->

<!-- js -->
<script type="text/javascript" src="<?php echo e(url('Backend/js/jquery-2.1.4.min.js')); ?>"></script>
<!-- //js -->

<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Oleo+Script:400,700&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->
</head>
<body>
<script src="<?php echo e(url('Backend/js/jquery.vide.min.js')); ?>"></script>
	<!-- main -->
	<div data-vide-bg="Backend/video/Ipad">
		<div class="center-container">
			<!--header-->
			<div class="header-w3l">
				<h1>Admin Login</h1>
			</div>
			<?php if(session()->has('error')): ?>
			<div class="alert alert-danger" role="alert"><strong><?php echo e(session()->get('error')); ?></strong></div>
			<?php endif; ?>
			<!--//header-->
			<div class="main-content-agile">
				<div class="sub-main-w3">	
					<div class="wthree-pro">
						<h2>Login Here</h2>
					</div>
					<form action="/admin-login" method="post">
					<?php echo csrf_field(); ?>
						<input placeholder="E-mail" name="email" class="user" type="email" required="">
						<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span><br><br>
						<input  placeholder="Password" name="password" class="pass" type="password" required="">
						<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span><br>
						<div class="sub-w3l">
							<h6><a href="#">Forgot Password?</a></h6>
							<div class="right-w3l">
								<input type="submit" value="Login">
							</div>
						</div>
					</form>
				</div>
			</div>
			<!--//main-->

			<!--footer-->
			<div class="footer">
				<p>&copy; FoodChilli - All rights reserved | Website - www.foodchilli.com</a></p>
			</div>
			<!--//footer-->
		</div>
	</div>

</body>
</html><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/admin-login/index.blade.php ENDPATH**/ ?>