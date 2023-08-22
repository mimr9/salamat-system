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
					$id = (int) $_POST['id'];
					if(!empty($_POST['id']) && $id !== 0) {

						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
						$db->beginTransaction();
						try {	
							$query = 'delete from all_group where id = :id';
							$statement = $db->prepare($query);
							$statement->bindValue('id', $id);

							$test_name_en = test_input($_POST['name_en']);

							if($statement->execute()) {
								$query1 = 'drop table '. $test_name_en;
								$statement1 = $db->prepare($query1);
								if ($statement1->execute()){
									$message = '<div class="jumbotron jumbotron-fluid">
									  <div class="container" style="font-family: vazir, serif; text-align: right;">
									    <h1 class="display-4">حذف شد</h1>
									    <p class="lead">شما با موفقیت کاربر مورد نظر را حذف کردید!</p>
										<a href="/salamat/admin/group/delete_group_list.php">بازگشت</a>
									  </div>
									</div>';
									echo $message;
								} else {
									$message = '<div class="jumbotron jumbotron-fluid" style="font-family: vazir, serif; text-align: right;">
									  <div class="container">
									    <h1 class="display-4">توجه</h1>
									    <p class="lead">متاسفانه عملیات ناموفق بود، لطفا مراحل را دوباره از سر گیرید!</p>
									  </div>
									</div>';
									echo $message;
								}

								$db->commit();
							} else {
								$message = '<div class="jumbotron jumbotron-fluid" style="font-family: vazir, serif; text-align: right;">
								  <div class="container">
								    <h1 class="display-4">توجه</h1>
								    <p class="lead">متاسفانه عملیات ناموفق بود، لطفا مراحل را دوباره از سر گیرید!</p>
								  </div>
								</div>';
								echo $message;
							}
						} catch (Exception $e) {
							$db->rollBack();
						}
					} else {
						echo '<script>window.location.href="/salamat/admin.php";</script>';
					}
?>
					</div>
				</div>
			</div>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseThree").addClass("show");
	$("#side36").addClass("nav-link");
	$("#side36").addClass("disabled");
</script>
