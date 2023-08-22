<?php include 'include/head_ui.html'; ?>
<?php include 'core/functions.php'; ?>

<div class="container">
	<div id="logo-inner" class="row">
	<a href="./index.php">
		<div class="logo-inner">
				<img  src="assets/image/logo.png" alt="لوگوی کانون سلامت">
				<h2>
سنگتاب
				</h2>
		</div>
	</a>
	</div>
<?php

	$test_username = test_input($_POST['username']);
	$test_firstname = test_input($_POST['firstname']);
	$test_lastname = test_input($_POST['lastname']);
	$test_password = test_input($_POST['password']);
	$test_email = test_input($_POST['email']);
	$test_address = test_input($_POST['address']);
	$test_phone = test_input($_POST['phone']);
	$test_mobile = test_input($_POST['mobile']);
	$test_national = test_input($_POST['national']);
	$test_birthday = test_input($_POST['birthday']);
	$test_bio = test_input($_POST['bio']);

	if(empty($test_username) || empty($test_firstname) || empty($test_lastname) || empty($test_password) || empty($national) || empty($test_mobile) || check_username($test_username)) {
		echo '<br>';
		echo '<div class="text-center">';
		if (check_username($test_username)) {
		echo '<h4 class="errorM">' . "نام کاربری وارد شده تکراری است" . '</h4>';
		echo '<h5 class="errorM">' . "موارد ضروری را چک کنید!" . '</54>';
		echo '<br>';
		echo '<br>';
		echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
		echo '</div>';
		} else {
		echo '<h4 class="errorM">' . "اطلاعات وارد شده صحیح نمی‌باشد" . '</h4>';
		echo '<h5 class="errorM">' . "موارد ضروری را چک کنید!" . '</54>';
		echo '<br>';
		echo '<br>';
		echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
		echo '</div>';
		}
	} else {
		//check email for emptiness and validation
		if(empty($test_email)){
			$test_email = " ";	
		} elseif (!filter_var($test_email, FILTER_VALIDATE_EMAIL)) {
			echo '<h4 class="errorM">' . "ایمیل وارد شده صحیح نمی‌باشد" . '</h4>';
			echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
		}

		if(empty($test_address))
			$test_address = " ";
		if(empty($test_phone))
			$test_phone = " ";
		if(empty($test_mobile))
			$test_mobile = " ";
		if(empty($test_birthday))
			$test_birthday = " ";
		else {
			$test_birthday = strtotime($test_birthday);
			$birthday_year = date('Y', $test_birthday);
			$birthday_month = date('m', $test_birthday);
			$birthday_day = date('d', $test_birthday);
			$test_birthday = jalali_to_gregorian($birthday_year, $birthday_month, $birthday_day, '-');
		}
		if(empty($test_bio))
			$test_bio = " ";

			
		$result = add_user($test_username, $test_firstname, $test_lastname, $test_email, $test_password, $test_address, $test_phone, $test_mobile, $test_birthday, $test_bio, $test_national);

		if ($result) {
			$message = '<div class="jumbotron jumbotron-fluid">
			  <div class="container" style="font-family: vazir, serif; text-align: right;">
			    <h1 class="display-4">تبریک</h1>
			    <p class="lead">شما با موفقیت ثبت نام کردید!</p>
			    <p class="lead">حال به صفحه‌ی اصلی بازگردید و وارد شوید</p>
				<a href="./index.php">بازگشت</a>
			  </div>
			</div>';
			echo $message;
		} else {
			$message = '<div class="jumbotron jumbotron-fluid" style="font-family: vazir, serif; text-align: right;">
			  <div class="container">
			    <h1 class="display-4">توجه</h1>
			    <p class="lead">متاسفانه عملیات ناموفق بود، لطفا دوباره امتحان فرمایید!</p>
			  </div>
			</div>';
			echo $message;
		}
	}


?>
</div>

<?php include 'include/footer.html' ?>
<?php include 'include/script_ui.html'; ?>
