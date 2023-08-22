<?php include 'include/head_regular.html'; ?>
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

<div class="container">
	<div class="text-center logo">
	<a class="text-dark" href="/salamat" style="text-decoration: none;">
		<img src="assets/image/logo.png" alt="لوگوی کانون سلامت">
		<h1 style="text-shadow: 2px 2px #fff;">
		محله‌ی سنگتاب	
		</h1>
	</a>
	</div>
	<div class="row">
		<div class="col-12 col-lg-6">
			<div class="login">
				<a href="login.php">
					<div class="text-center">
						<h2>ورود</h2>
					</div>
				</a>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="signup">
				<a href="signup.php">
					<div class="text-center">
						<h2>ثبت‌نام</h2>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
		<?php
				$quote = new quote();
				echo '
				<div class="card vazir text-dark text-center mt-4" style=" background-color: unset !important;">
				  <div class="card-header" style="border-bottom: 1px solid rgb(255, 255, 255, 0.3);">
					<i class="fas fa-quote-right" style="color: #436fb6;"></i>
				    سخن بزرگان
				  </div>
				  <div class="card-body">
				    <blockquote class="blockquote mb-0 text-center" style="font-size: 1.2rem;">
					<p>'.
						$quote->content() .
					'</p>
					<footer class="blockquote-footer text-secondary">'.
						$quote->writer() .
					'</footer>
				    </blockquote>
				  </div>
				</div>';
		?>
		</div>
	</div>
</div>

<?php include 'include/footer.html' ?>
<?php include 'include/script_regular.html'; ?>
