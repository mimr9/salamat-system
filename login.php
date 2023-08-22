<?php include 'include/head_ui_ix.html'; ?>
<?php include 'include/header.php'; ?>
<?php include 'core/functions.php'; ?>

<?php
	session_start();
	if(!empty($_SESSION['login_user'])) {
		$username = $_SESSION['login_user'];
		$username = test_input($username);
		$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'select username from users where username = "'. $username .'"';
		$statement = $db->prepare($query);
		$statement->execute();
		$rows = $statement->fetchAll();
		if (!empty($rows)) {
			header('Location: /salamat/admin.php'); 
		}
	}
?>
<div class="container" >
	<div id="logo-inner" class="row">
	<a href="/salamat">
		<div class="logo-inner">
				<img  src="assets/image/logo.png" alt="لوگوی کانون سلامت">
				<h2>
سنگتاب
				</h2>
		</div>
	</a>
	</div>
	<div class="row">
		<div class="col-12 col-md-3 col-lg-4">
		</div>
		<div class="col-12 col-md-6 col-lg-4">
			<div class="login-form">
				<form class="" method="post" action="authenticate.php">
					<label>نام کاربری</label>
					<input required class="form-control" type="text" name="username">
					
					<label>گذرواژه</label>
					<input required class="form-control" type="password" name="password">
					<br>
					<input class="btn btn-primary" type="submit" name="submit" value="ورود">
				</form>
			</div>
		</div>
		<div class="col-12 col-md-3 col-lg-4">
		</div>
	</div>
</div>

<?php include 'include/footer.html' ?>
<?php include 'include/script_ui.html'; ?>
