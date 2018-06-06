<?php
require 'conn.php';
print_r($_POST);
print_r($_FILES);

echo "string";

//  ***********  Posting Images ********************* //

$time=time();

if (isset($_POST['imgtopostTitle']) ){

	if (!empty($_FILES['imgtopost']) ) {

		$location = "./../imageUploads/";
		$locationDB = "imageUploads/";
		$file_ext = strtolower(end(explode('.', $_FILES['imgtopost']['name']) ));
		$upload_name =$_FILES['imgtopost']['name'];
		$target = $upload_name;
		$file_tmp = $_FILES['imgtopost']['tmp_name'];
		$uploaded_size = $_FILES['imgtopost']['size'];
		$uploaded_type = $_FILES['imgtopost']['type'];
		$error = $_FILES['imgtopost']['error'];
		$name = $_POST['imgtopostTitle'];
		$ok = 1;


			// place some value if $about is empty
		if (empty($name)) {
			$link = $_FILES['imgtopost']['name'];
		}
		$expensions = array("gif", "jpeg", "jpg", "png");
			// check the file type and set $ok var
		if (in_array($file_ext, $expensions) === false ){
			echo "please Upload images Only".'<br>';
			$ok = 0;
		}
			//check the size of file and set $ok var
		if ($uploaded_size < 10 ){
			echo "The file is too small.".'<br>';
			echo "uploaded size is : ".$uploaded_size.'<br>';
			$ok = 0;
		}

		if (file_exists($target)){
			echo "Sorry, file already exists".'<br>';
			$ok = 0;
		}else {

			//use $ok var to submit data
			if (!empty($upload_name) ) {
				if ($ok == 0 ){
					echo "The file couldn't be uploaded ".'<br>';

				 }
					//store the file to server

				 else if(move_uploaded_file($file_tmp,$location.$time)){


					 $uploadnamex2=$locationDB.$time;
					 //store the filename and about to the database

							 $query = $conn->query("INSERT INTO `images` (link, name) VALUES ('$uploadnamex2', '$name')") or die($db_error);

							 // LOADING IMAGES DIV
								 echo "<div class='' style='display: inline-block;
																		   bottom: 0;
																			 margin-left: 30%;
																		 border-radius: 5px;
																		 margin-top: 6%;
																		 background-color: #09f5a6;'>
								 					<div class='panel-group'>
														<div style='padding: 15px; font-size: 25px; text-align: center;'>Your image is being uploaded</div>
														<div class='panel panel-content'>
																<img src='./../../img/giphy-downsized.gif' width='400' height='400'/>
														</div>
													</div>

								 			</div>";

								//  redirecting
								// sleep php process
										// sleep(5);
										// // redirect
										// header("location: ./../pages/pictures.html");

				// Downloading file
					}
			}else {
					$ok = 0;
					echo "This file couldn't be uploaded ".'<br>';
					echo $error;
					}
			}
		} else {
		echo "Nothing To Post".'<br>';
	}
} else {
	echo "Nothing";
}

//  ***********  End of Posting Images ********************* //


 ?>
