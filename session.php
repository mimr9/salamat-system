<?php
	session_start();
	$username = $_SESSION['login_user'];
	$username = test_input($username);
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'select username from users where username = "'. $username .'"';
	$statement = $db->prepare($query);
	$statement->execute();
	$rows = $statement->fetchAll();
	if (empty($rows)) {
		header('Location: /salamat'); 
	}
?>
