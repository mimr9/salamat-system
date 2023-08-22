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

						if(empty($test_name_fa) || empty($test_name_en)) {
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
							$db->beginTransaction();
							$user_id = (int) user_id($_SESSION['login_user']);
							try {
							$query = 'insert into all_group (user_id, name_fa, name_en) values (:user_id, :name_fa, :name_en)';
							$statement = $db->prepare($query);
							$params = [
								'user_id' => $user_id,
								'name_fa' => $test_name_fa,
								'name_en' => $test_name_en
							];

							if(!$statement->execute($params)) {
								$message = '<div class="jumbotron jumbotron-fluid" style="font-family: vazir, serif; text-align: right;">
								  <div class="container">
								    <h1 class="display-4">توجه1</h1>
								    <p class="lead">متاسفانه عملیات ناموفق بود، لطفا دوباره امتحان فرمایید!</p>
								  </div>
								</div>';
								echo $message;
								throw new Exception($statement->errorInfo()[2]);
							} else {
								$query = 'create table '. $test_name_en . ' ('.
									'id bigint(20) unsigned not null auto_increment primary key, '.
									'user_id bigint(20) unsigned not null, '.
									'customer_id bigint(20) unsigned not null unique key, '.
									'foreign key (user_id) references users (id) '.
									'on delete cascade on update cascade, '.
									'foreign key (customer_id) references customer (id) '.
									'on delete cascade on update cascade'.
									') engine=InnoDB';

								$statement = $db->prepare($query);

								if($statement->execute()) {
									$message = '<div class="jumbotron jumbotron-fluid">
									  <div class="container" style="font-family: vazir, serif; text-align: right;">
									    <h1 class="display-4">تبریک</h1>
									    <p class="lead">شما با موفقیت ثبت نام کردید!</p>
										<a href="/salamat/admin/group/list_groups.php">بازگشت</a>
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
									throw new Exception($statement->errorInfo()[2]);
								}
							}
							$db->commit();

							} catch (Exception $e){
								$db->rollBack();
								throw $e;
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
	$("#side32").addClass("nav-link");
	$("#side32").addClass("disabled");
</script>
