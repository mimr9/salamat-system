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
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

					$query = 'select id, firstname, lastname, address, mobile, phone, national from customer';
					$statement = $db->prepare($query);
					if($statement->execute()) {
						$rows = $statement->fetchAll();
						//start table head
						echo '
						<table class="table table-striped table-bordered vazir centerize">
						  <thead>
						    <tr>
						      <th scope="col">شماره</th>
						      <th scope="col">نام</th>
						      <th scope="col">نام‌خانوادگی</th>
						      <th scope="col">کد‌ملی</th>
						      <th scope="col">آدرس</th>
						      <th scope="col">موبایل</th>
						      <th scope="col">تلفن</th>
						      <th scope="col">عملیات</th>
						    </tr>
						  </thead>
						  <tbody>
						';
						$counter = 1;
						foreach ($rows as $row) {
							echo '
								<form method="post" action="list_customers_detail.php">
								<input type="hidden" name="id" value="' . $row['id'] .'">
								<tr>
									<td>'.
									$counter++ .	
									'</td>
									<td>'.
									$row['firstname'] .	
									'</td>
									<td>'.
									$row['lastname'] .	
									'</td>
									<td>'.
									$row['national'] .	
									'</td>
									<td>'.
									$row['address'] .	
									'</td>
									<td>'.
									$row['mobile'] .	
									'</td>
									<td>'.
									$row['phone'] .	
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
							echo '<div class="text-center">';
							echo '<h4 class="errorM">' . "عملیات با مشکل روبه‌رو شد!" . '</h4>';
							echo '<br>';
							echo '<a href="/salamat/admin.php">بازگشت</a>';
							echo '</div>';
						}
?>
				</div>
				</div>
			</div>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseTwo").addClass("show");
	$("#side21").addClass("nav-link");
	$("#side21").addClass("disabled");
</script>
