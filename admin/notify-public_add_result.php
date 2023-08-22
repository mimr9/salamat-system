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
						$test_title = test_input($_POST['title']);
						$test_content = test_input($_POST['content']);

						if(empty($test_title)) {
							echo '<br>';
							echo '<div class="text-center">';
							echo '<h4 class="errorM">' . "اطلاعات وارد شده صحیح نمی‌باشد" . '</h4>';
							echo '<h5 class="errorM">' . "موارد ضروری را چک کنید!" . '</54>';
							echo '<br>';
							echo '<br>';
							echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
							echo '</div>';
						} else {
							
							$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
							$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
							$user_id = (int) user_id($_SESSION['login_user']);
							$query = 'insert into notify_public (user_id, title, content, register) values (:user_id, :title, :content, NOW())';
							$statement = $db->prepare($query);
							$params = [
								'user_id' => $user_id,
								'title' => $test_title,
								'content' => $test_content
							];

							if(!$statement->execute($params)) {
								$message = '<div class="jumbotron jumbotron-fluid" style="font-family: vazir, serif; text-align: right;">
								  <div class="container">
								    <h1 class="display-4">توجه</h1>
								    <p class="lead">متاسفانه عملیات ناموفق بود، لطفا دوباره امتحان فرمایید!</p>
								  </div>
								</div>';
								echo $message;
							} else {
								$message = '<div class="jumbotron jumbotron-fluid">
								  <div class="container" style="font-family: vazir, serif; text-align: right;">
								    <h1 class="display-4">تبریک</h1>
								    <p class="lead">شما با موفقیت ثبت نام کردید!</p>
									<a href="/salamat/admin/notify-public.php">بازگشت</a>
								  </div>
								</div>';
								echo $message;
							}
						}
?>
					</div>
				</div>
			</div>

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseFive").addClass("show");
	$("#side52").addClass("nav-link");
	$("#side52").addClass("disabled");
</script>
