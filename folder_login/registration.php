
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<!-- <link rel="stylesheet" href="css/style.css" /> -->
<!-- Bootstrap Core CSS -->
<link href="./../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="./../the_dashboard/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style media="screen">
	body{
		/* background: url(../img/laptop_3-wallpaper-1920x1080.jpg); */
	}
	#form_img{
		/* border-radius: 25%; */
		display: none;
	}#label_img{
		background: aqua;
		border: 1px solid black;
		height: 120px;
		width: 150px;
		border-radius: 45%;
		text-align: center;
		padding-top: 50px;
	}
</style>
</head>
<body>
	<div class="" style="position:fixed;height:100%;width:100%;background-image:url(../img/laptop_3-wallpaper-1920x1080.jpg);z-index:-1;filter:blur(5px)">

	</div>
<?php
require('./../php/conn.php');

    // If form submitted, insert values into the database.
		function validateStudent($name){
			$name = trim($name);
			$name = stripslashes($name);
			$name = htmlspecialchars($name);
			return $name;
		}
    if (isset($_POST['username'])){
		$username = validateStudent($_POST['username']); // removes backslashes
		$email = validateStudent($_POST['email']);
		$trn_date = date("Y-m-d H:i:s");
		$password = validateStudent($_POST['password']);
		$password_hash = md5($password);
		if (isset($_FILES['file']) && !empty($_FILES['file'])) {
			# code...

		$file_ext = strtolower(end(explode('.', $_FILES['file']['name']) ));
		$ok = 1;
		$time=time();
		$location = "./../the_dashboard/userImg/";
		$locationDb = "userImg/";
		$expensions = array("gif", "jpeg", "jpg", "png");
			// check the file type and set $ok var
		if (in_array($file_ext, $expensions) === false ){
			echo "please Upload images Only".'<br>';
			$ok = 0;
		}
		move_uploaded_file($_FILES['file']['tmp_name'],$location.$time);
		$db_img_link = $locationDb.$time;

			$query = "INSERT into `users` (username, password, email, date_created, imageTitle) VALUES ('$username', '$password_hash', '$email', '$trn_date','$db_img_link')";
			$result = $conn->query($query);
		}else {
			$query = "INSERT into `users` (username, password, email, date_created, imageTitle) VALUES ('$username', '$password_hash', '$email', '$trn_date','userImg/img_default.png')";
			$result = $conn->query($query);
		}
			if($result){
				 echo '
				<div class="container" >
						<div class="row"  style="margin-top: 15% !important;" >
						<div class="col-md-4 col-md-offset-4">
								<div class="well"  style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:25%">
								<h1 class="text-center">Succesfully Regestered</h1> <br><br>
								<h3 style="color:blue;" class="text-center">Enter Your Credentials? </h3>
								<a href="login.php" class="btn btn-lg btn-danger btn-block">Log In.</a>
								</div>
							</div>
							</div>
					</div>';
			}

	}else{

		?>




<div class="container" >
		<div class="row"  style="margin-top: 15% !important;" >
				<div class="col-md-4 col-md-offset-4">
						<div class="login-panel panel panel-default" id="changeDiv" style=' box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);'>
								<div class="panel-heading">
										<h3 class="panel-title text-center" style="font-weight:bold"> Registration</h3>
								</div>
								<div class="panel-body">
										<form role="form" method="post" enctype="multipart/form-data">
												<div class="form-group">
													add an image <br>
													<label id="label_img">Upload Img
														<input class="form-control " id="form_img" name="file" type="file" />
													</label>
												</div>
														<div class="form-group">
																<input class="form-control " placeholder="Username" name="username" type="text" autofocus required/>
														</div>
														<div class="form-group">
																<input class="form-control " placeholder="E-Mail" name="email" type="email" autofocus required/>
														</div>
														<div class="form-group">
																<input class="form-control" placeholder="Password" name="password" type="password" value="">
														</div>
														<div class="checkbox">
																<label>
																		<!-- <input name="remember" type="checkbox" value="Remember Me"> Remember Me -->
																</label>
														</div>
														<!-- Change this to a button or input when using this as a form -->
														<button type="submit" name="regester"  class="btn btn-lg btn-success btn-block">Register</button><br>
												<!-- </fieldset> -->
										</form> <br>
										<div class="well">
											<h3 style="color:blue;" class="text-center">Already Registered? </h3>
											<a href="login.php" class="btn btn-lg btn-danger btn-block">LOG IN</a>

										</div>
								</div>
						</div>
				</div>
		</div>
</div>

<!-- jQuery -->
<script src="./../js/jquery.1.11.1.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="./../js/bootstrap.min.js"></script>

<?php } ?>
</body>
</html>
