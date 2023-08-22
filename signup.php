<?php include 'include/head_ui_ix.html'; ?>
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
				<form class="" method="post" action="signdown.php">
					<span class="errorM">*</span>
					<label>نام کاربری</label>
					<input class="form-control" required type="text" name="username" >
					<span class="errorM">*</span>
					
					<label>نام</label>
					<input class="form-control" required  type="text" name="firstname" >
					<span class="errorM">*</span>

					<label>نام خانوادگی</label>
					<input class="form-control" required type="text" name="lastname" >

					<label>ایمیل</label>
					<input class="form-control" type="text" name="email" >
					<span class="errorM">*</span>

					<label>گذرواژه</label>
					<input class="form-control" required type="password" name="password">

					<label>آدرس محل سکونت</label>
					<textarea class="form-control"  name="address" ></textarea>

					<label>تلفن ثابت</label>
					<input class="form-control" type="text" name="phone" >
					<span class="errorM">*</span>

					<label>تلفن همراه</label>
					<input class="form-control" required type="text" name="mobile" >
					<span class="errorM">*</span>

					<label>کد ملی</label>
					<input class="form-control" required type="text" name="national" >
					<span class="errorM">*</span>

					<label>تاریخ تولد</label>
					<input id="date1" class="form-control" required  type="text" name="birthday" >

					<label>درباره من</label>
					<textarea class="form-control"  name="bio" ></textarea>
					
					<br>

					<input class="btn btn-primary" type="submit" value="ثبت نام">
					<br>
					<br>
					<br>
					<br>
					<br>
				</form>
			</div>
		</div>
		<div class="col-12 col-md-3 col-lg-4">
		</div>
	</div>
</div>

<?php include 'include/footer.html' ?>
<?php include 'include/script_ui_ix.html'; ?>
