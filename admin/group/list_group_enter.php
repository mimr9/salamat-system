<?php include '../../core/functions.php'; ?>
<?php include '../../include/head_ui.html'; ?>
<?php include '../../session.php' ?>
<?php include '../../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../../include/sidebar.php'; ?>
<?php
					echo '</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set">
						<div class="row">
								<div class="col-12 text-center lalezar" style="color: #007bff">
								<br>
								<br>
								<h1>' .
$_POST['name_fa'] .
								'</h1>
								</div>
						</div>
						<div class="row">
								<div class="col-12">
								<br><br>
								</div>
						</div>
						<div class="row">
							<div class="col-12">';
								$test_name_en = test_input($_POST['name_en']);

								$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
								$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

								$query = 'select g.customer_id, concat(c.firstname, " ", c.lastname) as name, '.
									'c.national, c.mobile, c.birthday, c.address ' .
									'from '. $test_name_en .' g left join customer c on g.customer_id = c.id';
								$statement = $db->prepare($query);
								if($statement->execute()) {
									$rows = $statement->fetchAll();
									//start table head
									echo '
									<table class="table table-striped table-bordered vazir centerize">
									  <thead>
									    <tr>
									      <th scope="col">شماره</th>
									      <th scope="col">نام مراجعه‌کننده</th>
									      <th class="text-success" scope="col">کد‌ملی</th>
									      <th scope="col">موبایل</th>
									      <th scope="col">آدرس</th>
									      <th scope="col">عملیات</th>
									    </tr>
									  </thead>
									  <tbody>
									';
									$counter = 1;
									foreach ($rows as $row) {
										echo '
											<form method="post" action="../customer/list_customers_detail.php">
											<input type="hidden" name="id" value="' . $row['customer_id'] .'">
											<tr>
												<td>'.
												$counter++ .
												'</td>
												<td>'.
												$row['name'] .	
												'</td>
												<td>'.
												$row['national'] .	
												'</td>
												<td>'.
												$row['mobile'] .	
												'</td>
												<td>'.
												$row['address'] .	
												'</td>
												<td>
												<input type="submit" class="btn btn-info" value="جزئیات">	
												</td>
											</tr>	
											</form>
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
						</div>
						</div>
					</div>
				</div>
			</div>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseThree").addClass("show");
	$("#side31").addClass("nav-link");
	$("#side31").addClass("disabled");
</script>
