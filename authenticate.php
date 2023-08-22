<?php
	include 'core/functions.php';

	session_start(); 
	$error=''; 
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "نام کاربری و گذرواژه شما صحیح نمی‌باشد";
			echo '<div class="errorM">'. $error . '</div>';
		} else {
			$username=test_input($_POST['username']);
			$password=test_input($_POST['password']);

			$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			$query = 'select username, password from users where username = "'. $username .'" and password = "'. $password .'"';
			$statement = $db->prepare($query);
			$statement->execute();
			$rows = $statement->fetchAll();
			if (!empty($rows)) {
				$_SESSION['login_user']=$username; 
				$user_id = user_id($username);
				start_session($user_id);
				header("location: admin.php"); 
			} else {
				$error = "نام کاربری و گذرواژه شما صحیح نمی‌باشد";
				echo '<div class="errorM">'. $error . '</div>';
			}
		}
	}
?>
