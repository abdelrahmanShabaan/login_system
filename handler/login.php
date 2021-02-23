<?php

session_start();
require '../inc/db.php';


if(isset($_POST['submit']))
{
	//make sanitize for all commen data
	$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

	 	// check if this email is exesits or not

	 	$sql = "SELECT * FROM users WHERE email =?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$email]);


			// fetch say if found data or not
			$data = $stmt->fetchobject();

				if($data)
				{
					$check = password_verify($password, $data->password);
					if($check)
					{
						$_SESSION['user_id']= $data->id;
						$_SESSION['user_name']= $data->name;
						$_SESSION['user_email']= $data->email;
						$_SESSION['user_mobile']= $data->mobile;
							header("location:../register.php");
							die();					}
					else
					{
					$_SESSION['error'] = "Email or password not correct";
					}
				
				}
				else
					{
					$_SESSION['error'] = "Data not correct";
					}
		//success message
		$_SESSION['success'] = "data inserted";
}
// go at the end to register.php as public page

 header("location:../login.php");