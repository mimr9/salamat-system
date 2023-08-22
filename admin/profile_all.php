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
						$test_request = test_input($_GET['request']);
						$id = user_id($test_request);
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
						$query = 'select id, avatar,  username, firstname, lastname, address, birthday, mobile, phone, email , bio, password, national from users
							where id = :id';
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
					} else {
						echo '<script>window.location.href="/salamat/admin.php";</script>';
					}

?>
					</div>
				</div>
			</div>

<?php include '../include/footer.html'; ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseOne").addClass("show");
	$("#side11").addClass("nav-link");
	$("#side11").addClass("disabled");
</script>
