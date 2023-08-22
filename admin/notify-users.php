<?php include '../core/functions.php'; ?>
<?php include '../include/head_ui.html'; ?>
<?php include '../session.php' ?>
<?php include '../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../include/sidebar.php'; ?>
<?php
		$user_id = user_id($_SESSION['login_user']);
					echo '</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set">
						<div class="row">
								<div class="col-12 col-md-6 col-lg-7 text-left lalezar" style="color: #007bff">
								<br>
								<br>
								<h1>
<i class="fas fa-fax"></i>
اعلانات کاربری
								</h1>
								</div>
								<div class="col-12 col-md-5 col-lg-4 text-center vazir">
								<br>
								<br>
									<form style="display: inline-block;" method="post" action="notify-users_add.php">
										<input type="hidden" name="id" value="' . $user_id .'">
										<input type="submit" class="btn btn-primary" value="افزودن">
									</form>
								</div>
						</div>
						<div class="row">
								<div class="col-12">
								<br><br>
								</div>
						</div>
						<div class="row">
							<div class="col-12">';
								$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
								$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

								$query = 'select id, title, content from notify_users order by id desc';
								$statement = $db->prepare($query);
								if($statement->execute()) {
									$rows = $statement->fetchAll();
									//start table head
									echo '
									<table class="table table-striped table-bordered vazir centerize">
									  <thead>
									    <tr>
									      <th scope="col">شماره</th>
									      <th class="text-success" scope="col">عنوان</th>
									      <th scope="col">متن</th>
									      <th scope="col">عملیات</th>
									    </tr>
									  </thead>
									  <tbody>
									';
									$counter = 1;
									foreach ($rows as $row) {
										echo '
											<tr>
												<td>'.
												$counter++ .
												'</td>
												<td>'.
												$row['title'] .	
												'</td>
												<td>'.
												$row['content'] .	
												'</td>
												<td>
												<form style="display: inline-block;" method="post" action="notify-users_update.php">
												<input type="hidden" name="id" value="' . $row['id'] .'">
													<input style="margin-bottom: 5px;" type="submit" class="btn btn-success" value="تغییر">
												</form>
												<form style="display: inline-block;" method="post" action="notify-users_delete_result.php">
												<input type="hidden" name="id" value="' . $row['id'] .'">
													<input style="margin-bottom: 5px;" type="submit" class="btn btn-danger" value="حذف">
												</form>
												</td>
											</tr>	
										';
									}

									echo ' </tbody>
									</table>';
								} else {
									echo '<br>';
									echo '<div class="text-center vazir">';
									echo '<h4 class="errorM">' . "عملیات با مشکل روبه‌رو شد!" . '</h4>';
									echo '<br>';
									echo '<a href="/salamat/admin.php">بازگشت</a>';
									echo '</div>';
								}
?>
					<div class="col-12 col-md-9 col-lg-10 padding-set">
						
					</div>
				</div>
			</div>

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseFive").addClass("show");
	$("#side53").addClass("nav-link");
	$("#side53").addClass("disabled");
</script>
