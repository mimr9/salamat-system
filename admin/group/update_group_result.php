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
					$test_name_fa = test_input($_POST['name_fa']);
					$test_name_en = test_input($_POST['name_en']);

					$id = (int) $_POST['id'];
					if ((empty($test_name_fa) || empty($test_name_en)) && $id == 0) {
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

						$query = 'update all_group set name_fa = :name_fa where id = :id';
						$statement = $db->prepare($query);
						$statement->bindValue('name_fa', $test_name_fa);
						$statement->bindValue('id', $id);
						//check was the query successful or not
						if ($statement->execute()) {
							$message = '<div class="jumbotron jumbotron-fluid">
							  <div class="container" style="font-family: vazir, serif; text-align: right;">
							    <h1 class="display-4">تبریک</h1>
							    <p class="lead">شما با موفقیت تغییرات را ایجاد کردید!</p>
								<a href="/salamat/admin/group/list_groups.php">بازگشت</a>
							  </div>
							</div>';
							echo $message;
						} else {
							$message = '<div class="jumbotron jumbotron-fluid" style="font-family: vazir, serif; text-align: right;">
							  <div class="container">
							    <h1 class="display-4">توجه</h1>
							    <p class="lead">متاسفانه عملیات ناموفق بود، لطفا مراحل را دوباره امتحان فرمایید!</p>
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
	$("#collapseThree").addClass("show");
	$("#side33").addClass("nav-link");
	$("#side33").addClass("disabled");
</script>
