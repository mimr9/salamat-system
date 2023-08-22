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
						$test_name_fa = test_input($_POST['name_fa']);
						$test_name_en = test_input($_POST['name_en']);

						echo '
						<div class="row">
								<div class="col-12 col-md-6 col-lg-7 text-left lalezar" style="color: #007bff">
								<br>
								<br>
								<h1>'.
									$test_name_fa .
								'</h1>
								</div>
								<div class="col-12 col-md-5 col-lg-4 text-center vazir">
								<br>
								<br>
								</div>
						</div>
						<br>	
						';

						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$query = 'select id, concat(firstname, " ", lastname) as name, national, mobile, address from customer where id in ( select customer_id from '. $test_name_en .' )';
						$statement = $db->prepare($query);
						if($statement->execute()) {
							$rows = $statement->fetchAll();
								//start table head
								echo '
							<form method="post" action="/salamat/admin/group/delete_group_customer_result.php">
								<input type="hidden" name="name_en" value="' . $test_name_en .'">
								
								<table class="table table-striped table-bordered vazir centerize">
								  <thead>
								    <tr>
								      <th scope="col">شماره</th>
								      <th scope="col">نام مراجعه‌کننده</th>
								      <th class="text-success" scope="col">کد‌ملی</th>
								      <th scope="col">موبایل</th>
								      <th scope="col">آدرس</th>
								      <th scope="col"><input type="submit" class="btn btn-danger" value="حذف"></th>
								    </tr>
								  </thead>
								  <tbody>
								';
								$counter = 1;
								foreach ($rows as $row) {
									echo '
										<input type="hidden" name="id" value="' . $row['id'] .'">
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
											<input type="checkbox" name="checkbox['. $row['id'] .']" >
											</td>
										</tr>	
									';
								}

								echo ' </tbody>
								</table>
								</form>';
							} else {
								echo '<br>';
								echo '<div class="text-center vazir">';
								echo '<h4 class="errorM">' . "عملیات با مشکل روبه‌رو شد!" . '</h4>';
								echo '<br>';
								echo '<a href="/salamat/admin/group/add_group_customer_list.php">بازگشت</a>';
								echo '</div>';
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
