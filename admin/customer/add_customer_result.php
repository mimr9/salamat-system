<?php include '../../core/functions.php'; ?>
<?php include '../../include/head_ui.html'; ?>
<?php include '../../session.php' ?>
<?php include '../../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../../include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set">
<?php	
						$test_firstname = test_input($_POST['firstname']);
						$test_lastname = test_input($_POST['lastname']);
						$test_email = test_input($_POST['email']);
						$test_address = test_input($_POST['address']);
						$test_phone = test_input($_POST['phone']);
						$test_mobile = test_input($_POST['mobile']);
						$test_national = test_input($_POST['national']);
						$test_birthday = test_input($_POST['birthday']);
						$test_bio = test_input($_POST['bio']);
						$user_id = user_id($_SESSION['login_user']);

						if(empty($test_firstname) || empty($test_lastname) || empty($test_national) || empty($test_mobile) || empty($test_birthday)) {
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

							//check if is avatar uploaded
							if(empty($_FILES['avatar']['name'])) {
								$avatar = avatar_default();
							} elseif (check_file_extension($_FILES, 'avatar') && check_file_size($_FILES, 'avatar')) {
								$avatar = upload_file($_FILES, 'avatar');
								if(!$avatar) {
									echo "فایل شما معتبر نیست";

								}
							}

							$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
							$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

							$query = 'insert into customer (avatar, user_id, firstname, lastname, email, address, phone, mobile, birthday, bio, joinday, national) values
								(:avatar, :user_id, :firstname, :lastname, :email, :address, :phone, :mobile, :birthday, :bio, NOW(), :national)';

							$statement = $db->prepare($query);
							$params = [
								'avatar' => $avatar,
								'user_id' => $user_id,
								'firstname' => $test_firstname,
								'lastname' => $test_lastname,
								'email' => $test_email,
								'address' => $test_address,
								'phone' => $test_phone,
								'mobile' => $test_mobile,
								'birthday' => $test_birthday,
								'bio' => $test_bio,
								'national' => $test_national
							];
							$result = $statement->execute($params);
							$customer_id = $db->lastInsertId();

								
							if(isset($_POST['checkbox'])){
								foreach($_POST['checkbox'] as $name_en => $keyt) {
									if($keyt) {
										$query = 'insert into '. $name_en .' (user_id, customer_id) values ( '. $user_id .', ' . $customer_id . ' )';
										$statement = $db->prepare($query);
										$statement->execute();
									}

								}
							}

							if($result) {
								$message = '<div class="jumbotron jumbotron-fluid">
								  <div class="container" style="font-family: vazir, serif; text-align: right;">
								    <h1 class="display-4">تبریک</h1>
								    <p class="lead">شما با موفقیت ثبت نام کردید!</p>
									<a href="/salamat/admin/customer/list_customers.php">بازگشت</a>
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
				</div>
			</div>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseTwo").addClass("show");
	$("#side22").addClass("nav-link");
	$("#side22").addClass("disabled");
</script>
