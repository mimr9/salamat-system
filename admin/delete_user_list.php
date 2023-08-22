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
					//get the all users query back
					$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
					$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

					$query = 'select id, username, firstname, lastname, address, birthday, mobile, email, national from users';
					$statement = $db->prepare($query);
					if($statement->execute()) {
						$rows = $statement->fetchAll();

						//check there is a result or not
						if (!empty($rows)) {
							//start table head
							echo '
							<table class="table table-striped table-bordered vazir centerize">
							  <thead>
							    <tr>
							      <th scope="col">نام‌کاربری</th>
							      <th scope="col">نام</th>
							      <th scope="col">نام‌خانوادگی</th>
							      <th scope="col">کد‌ملی</th>
							      <th scope="col">ایمیل</th>
							      <th scope="col">آدرس</th>
							      <th scope="col">موبایل</th>
							      <th scope="col">تاریخ تولد</th>
							      <th scope="col">عملیات</th>
							    </tr>
							  </thead>
							  <tbody>
							';
							foreach ($rows as $row) {
								$test_birthday = strtotime($row['birthday']);
								$birthday_year = date('Y', $test_birthday);
								$birthday_month = date('m', $test_birthday);
								$birthday_day = date('d', $test_birthday);
								$test_birthday = gregorian_to_jalali($birthday_year, $birthday_month, $birthday_day, '/');
								echo '
									<form method="post" action="delete_user_result.php">
									<input type="hidden" name="id" value="' . $row['id'] .'">
									<tr>
										<td>'.
										$row['username'] .
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
										$row['email'] .	
										'</td>
										<td>'.
										$row['address'] .	
										'</td>
										<td>'.
										$row['mobile'] .	
										'</td>
										<td>'.
										$test_birthday .	
										'</td>
										<td>';
										if(user_id($_SESSION['login_user']) == $row['id'])
											echo ' ';
										else
											echo '<input type="submit" class="btn btn-danger" value="حذف">';
										echo '
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
							echo '<h4 class="errorM">' . "لیست خالی است" . '</h4>';
							echo '<h5 class="errorM">' . "لطفا کاربر اضافه کنید!" . '</h5>';
							echo '<br>';
							echo '<br>';
							echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
							echo '</div>';
						}


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

<?php include '../include/footer.html'; ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseOne").addClass("show");
	$("#side14").addClass("nav-link");
	$("#side14").addClass("disabled");
</script>
