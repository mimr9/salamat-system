<?php include 'core/functions.php'; ?>

<?php
	session_start();
	$user_id = user_id($_SESSION['login_user']);
	end_session($user_id);
	if(session_destroy()) {
		header("Location: /salamat"); 
	}
?>
