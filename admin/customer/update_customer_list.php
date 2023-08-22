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

					$query = 'select id, firstname, lastname, address, birthday, joinday, mobile, national from customer ';
						$statement = $db->prepare($query);

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
						      <th scope="col">عملیات</th>
						    </tr>
						  </thead>
						  <tbody>
						';
						$counter = 1;
						foreach ($rows as $row) {
							$test_birthday = strtotime($row['birthday']);
							$birthday_year = date('Y', $test_birthday);
							$birthday_month = date('m', $test_birthday);
							$birthday_day = date('d', $test_birthday);
							$test_birthday = gregorian_to_jalali($birthday_year, $birthday_month, $birthday_day, '/');
							echo '
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
									<td>
									<form style="display: inline-block;" method="post" action="list_customers_detail.php">
									<input type="hidden" name="id" value="' . $row['id'] .'">
										<input type="submit" class="btn btn-info" value="جزئیات">
									</form>
									<form style="display: inline-block;" method="post" action="update_customer_change.php">
									<input type="hidden" name="id" value="' . $row['id'] .'">
										<input type="submit" class="btn btn-success" value="تغییر">
									</form>
									</td>
								</tr>	
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
	$("#side23").addClass("nav-link");
	$("#side23").addClass("disabled");
</script>
