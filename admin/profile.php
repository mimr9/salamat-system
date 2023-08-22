<?php include '../core/functions.php'; ?>
<?php include '../include/head_ui.html'; ?>
<?php include '../session.php' ?>
<?php include '../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row" style="height: 100%;">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set" style="background-image: url('/salamat/assets/image/salamat-back.jpg'); background-size: cover;">
<?php	
					if (!empty($_GET['request'])) {
						$id = user_id($_SESSION['login_user']);
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
						$query = 'select avatar, id, username, firstname, lastname, address, birthday, mobile, phone, email , bio, password, national from users
							where id = :id';

						if ($_GET['request'] == 'profile') {
						
							$statement = $db->prepare($query);
							$statement->bindValue('id', $id);
							if($statement->execute()) {
								$rows = $statement->fetchAll();

							foreach ($rows as $row) {
							$test_birthday = strtotime($row['birthday']);
							$birthday_year = date('Y', $test_birthday);
							$birthday_month = date('m', $test_birthday);
							$birthday_day = date('d', $test_birthday);
							$test_birthday = gregorian_to_jalali($birthday_year, $birthday_month, $birthday_day, '/');
							echo '
							<div class="former" method="post" action="update_user_change_result.php">
								<div style="margin-right: 10px; margin-bottom: 30px;" class="row vazir">
									<div class="col-12 col-md-5 col-lg-5">
										<div class="profile-img text-center">
											<div class="avatar-profile">
												<img src="'. $row['avatar'] .'">
											</div>
										</div>

										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">نام کاربری</h5>
										    <p class="card-text">' . $row['username'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">نام</h5>
										    <p class="card-text">' . $row['firstname'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">نام خانوادگی</h5>
										    <p class="card-text">' . $row['lastname'] . '</p>
										  </div>
										</div>
										<br>
										
										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">ایمیل</h5>
										    <p class="card-text">' . $row['email'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">گذرواژه</h5>
										    <p class="card-text">' . $row['password'] . '</p>
										  </div>
										</div>
									</div>
									<div class="col-12 col-md-5 col-lg-5">

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">آدرس محل سکونت</h5>
										    <p class="card-text">' . $row['address'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">تلفن ثابت</h5>
										    <p class="card-text">' . $row['phone'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">تلفن همراه</h5>
										    <p class="card-text">' . $row['mobile'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">کد‌ملی</h5>
										    <p class="card-text">' . $row['national'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">تاریخ تولد</h5>
										    <p class="card-text">' . $test_birthday . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">درباره من</h5>
										    <p class="card-text">' . $row['bio'] . '</p>
										  </div>
										<div class="col-12 col-md-1 col-lg-1">

										</div>
											<br><br>
										</div>
									</div>
								</div>
								</div>
							';
								
							
							}
							}
							} elseif ($_GET['request'] == 'change') {

							$statement = $db->prepare($query);
							$statement->bindValue('id', $id);
							if($statement->execute()) {
								$rows = $statement->fetchAll();

							foreach ($rows as $row) {
						$test_birthday = strtotime($row['birthday']);
							$birthday_year = date('Y', $test_birthday);
							$birthday_month = date('m', $test_birthday);
							$birthday_day = date('d', $test_birthday);
							$test_birthday = gregorian_to_jalali($birthday_year, $birthday_month, $birthday_day, '/');
							echo '
							<form class="former vazir" method="post" action="update_user_change_result.php" enctype="multipart/form-data" style="background: rgba(255,255,255,0.15);margin-left: 20px;padding-top: 20px;padding-bottom: 20px;border-radius: 10px;">
							<input type="hidden" name="id" value="' . $row['id'] .'">
								<div style="margin-right: 10px;" class="row text-light">
									<div class="col-12 col-md-5 col-lg-5">
										<span class="errorM">*</span>
										<label for="username">نام کاربری</label>
										<input id="username" class="form-control" required type="text" value="' . $row['username'] . '" name="username" readonly >
										<span class="errorM">*</span>
										
										<label for="firstname">نام</label>
										<input id="firstname" class="form-control" required type="text" value="' . $row['firstname'] . '" name="firstname" >
										<span class="errorM">*</span>

										<label for="lastname">نام خانوادگی</label>
										<input id="lastname" class="form-control" required type="text" value="' . $row['lastname'] . '" name="lastname" >

										<label for="email">ایمیل</label>
										<input id="email" class="form-control" type="text" value="' . $row['email'] . '" name="email" >
										<span class="errorM">*</span>

										<label for="password">گذرواژه</label>
										<input id="password" class="form-control" required type="text" value="' . $row['password'] . '" name="password">
										<label>عکس پروفایل</label>
										<div class="custom-file">
										<input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile">
										    <label class="custom-file-label text-center" for="validatedCustomFile">انتخاب عکس</label>
										</div>
										<div class="profile-img text-right">
											<div class="avatar-profile">
												<img style="width: 64px; border-radius: 5%;margin-top: 5px;" src="'. $row['avatar'] .'">
											</div>
										</div>
									</div>
									<div class="col-12 col-md-1 col-lg-1">

									</div>
									<div class="col-12 col-md-5 col-lg-5">
										<label for="address">آدرس محل سکونت</label>
										<textarea id="address" class="form-control"  name="address">' . $row['address'] . '</textarea>

										<label for="phone">تلفن ثابت</label>
										<input id="phone" class="form-control" type="text" value="' . $row['phone'] . '" name="phone" >

										<label for="mobile">تلفن همراه</label>
										<input id="mobile" class="form-control" required type="text" value="' . $row['mobile'] . '" name="mobile" >
										<span class="errorM">*</span>

										<label for="national">کد‌ملی</label>
										<input id="national" class="form-control" required type="text" value="' . $row['national'] . '" name="national" >
										<span class="errorM">*</span>

										<label for="date1">تاریخ تولد</label>
										<input id="date1" class="form-control" required type="text" value="' . $test_birthday . '" name="birthday" >

										<label for="bio">درباره من</label>
										<textarea id="bio" style="height: 100px;" class="form-control"  name="bio" >' . $row['bio'] . '</textarea>
									</div>
								</div>
								<div class="row text-center">
									<input style="margin: 30px auto;" class="btn btn-primary" type="submit" value="تغییر مشخصات">
								</div>
								</form>';

						}
						}
						}
						} else {
						echo '<script>window.location.href="/salamat/admin.php";</script>';
					}

?>
					</div>
				</div>
			</div>

<?php include '../include/footer.html'; ?>
<?php include '../include/script_ui.html'; ?>
