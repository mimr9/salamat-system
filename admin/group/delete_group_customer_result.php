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
						$user_id = user_id($_SESSION['login_user']);
						$test_name_en = test_input($_POST['name_en']);

						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						if(!empty($_POST)) {
							if(isset($_POST['checkbox'])){
								foreach($_POST['checkbox'] as $id => $keyt) {
									if ($keyt) {
											$query = 'delete from '. $test_name_en .' where customer_id = '. $id;
											$statement = $db->prepare($query);
											$statement->execute();
									}
								}
								$message = '<div class="jumbotron jumbotron-fluid">
								  <div class="container" style="font-family: vazir, serif; text-align: right;">
								    <h1 class="display-4">حذف شد</h1>
								    <p class="lead">شما با موفقیت مراجعه‌کنندگان را از گروه حذف کردید!</p>
									<a href="/salamat/admin/group/delete_group_customer_list.php">بازگشت</a>
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
						} else {
							echo '<script>window.location.href="/salamat";</script>';
						}
?>		
					</div>
				</div>
			</div>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseThree").addClass("show");
	$("#side35").addClass("nav-link");
	$("#side35").addClass("disabled");
</script>
