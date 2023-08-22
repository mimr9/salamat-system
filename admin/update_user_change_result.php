<?php include '../core/functions.php'; ?>
<?php include '../include/head_ui.html'; ?>
<?php include '../session.php' ?>
<?php include '../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set">
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
						$result;


						$id = (int) $_POST['id'];
						if((empty($test_username) || empty($test_firstname) || empty($test_lastname) || empty($test_national) || empty($test_mobile) || empty($test_password)) && gettype($id) !== 0) {
							echo '<br>';
							echo '<div class="text-center">';
							echo '<h4 class="errorM">' . "اطلاعات وارد شده صحیح نمی‌باشد" . '</h4>';
							echo '<h5 class="errorM">' . "موارد ضروری را چک کنید!" . '</54>';
							echo '<br>';
							echo '<br>';
							echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
							echo '</div>';
						} else {

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

								
							//get the query
							$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
							$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

							$query = 'select id, username, firstname, lastname, address, birthday, mobile, phone, email , bio, password, national from users
								where id = :id';
							$statement = $db->prepare($query);
							$statement->bindValue('id', $_POST['id']);
							//if the query returns
							if($statement->execute()) {
							$rows = $statement->fetchAll();
					
							foreach ($rows as $row) {
							$result = $row;
								if ($result['username'] == $test_username) {
									try {
										if (check_file_extension($_FILES, 'avatar') && check_file_size($_FILES, 'avatar')) {
											$avatar = upload_file($_FILES, 'avatar');
											if(!$avatar) {
												echo "فایل شما معتبر نیست";
												throw new Exception ($statement->errorInfo()[2]);
											} else {
												avatar_user($avatar, $_POST['id']);
											}
										}
										if (!($result['firstname'] === $test_firstname)) {
											$query = 'update users set firstname = :firstname where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('firstname', $test_firstname);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['lastname'] === $test_lastname)) {
											$query = 'update users set lastname = :lastname where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('lastname', $test_lastname);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['address'] === $test_address)) {
											$query = 'update users set address = :address where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('address', $test_address);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['birthday'] === $test_birthday)) {
											$query = 'update users set birthday = :birthday where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('birthday', $test_birthday);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['mobile'] === $test_mobile)) {
											$query = 'update users set mobile = :mobile where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('mobile', $test_mobile);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['national'] === $test_national)) {
											$query = 'update users set national = :national where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('national', $test_national);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['phone'] === $test_phone)) {
											$query = 'update users set phone = :phone where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('phone', $test_phone);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['email'] === $test_email)) {
											$query = 'update users set email = :email where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('email', $test_email);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['bio'] === $test_bio)) {
											$query = 'update users set bio = :bio where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('bio', $test_bio);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}
										if (!($result['password'] === $test_password)) {
											$query = 'update users set password = :password where id = :id';
											$statement = $db->prepare($query);
											$statement->bindValue('password', $test_password);
											$statement->bindValue('id', $_POST['id']);
											if (!$statement->execute())
												throw new Exception ($statement->errorInfo()[2]);
										}

										$message = '<div class="jumbotron jumbotron-fluid">
										  <div class="container" style="font-family: vazir, serif; text-align: right;">
										    <h1 class="display-4">تبریک</h1>
										    <p class="lead">شما با موفقیت تغییرات را ایجاد کردید!</p>
											<a href="/salamat/admin/list_users.php">بازگشت</a>
										  </div>
										</div>';
										echo $message;

									} catch (Exception $e) {
										$message = '<div class="jumbotron jumbotron-fluid" style="font-family: vazir, serif; text-align: right;">
										  <div class="container">
										    <h1 class="display-4">توجه</h1>
										    <p class="lead">متاسفانه عملیات ناموفق بود، لطفا مراحل را دوباره امتحان فرمایید!</p>
										  </div>
										</div>';
										echo $message;
									}
								} else {
									echo '<br>';
									echo '<div class="text-center">';
									echo '<h4 class="errorM">' . "عملیات با مشکل روبه‌رو شد!" . '</h4>';
									echo '<br>';
									echo '<a href="/salamat/admin.php">بازگشت</a>';
									echo '</div>';
								}
							}
							
							//else of the execute() result
							} else {
								echo '<br>';
								echo '<div class="text-center">';
								echo '<h4 class="errorM">' . "عملیات با مشکل روبه‌رو شد!" . '</h4>';
								echo '<br>';
								echo '<a href="/salamat/admin.php">بازگشت</a>';
								echo '</div>';
							}
						}
?>
					</div>
				</div>
			</div>

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseOne").addClass("show");
	$("#side13").addClass("nav-link");
	$("#side13").addClass("disabled");
</script>
