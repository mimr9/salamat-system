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
					//if user enter something it gonna search
					if (!empty($_POST['search'])) {
						$search = test_input($_POST['search']);
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$query = 'select id, username, firstname, lastname, address, birthday, joinday, mobile, email, national
							from users where username like ?
							or firstname like ?
							or lastname like ?
							or address like ?
							or mobile like ?
							or phone like ?
							or email like ?
							or national like ?
							order by id
							';
						$statement = $db->prepare($query);
						$params = array ("%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%");

						//check how seccessful was the query in action
						if($statement->execute($params)) {
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
										<form method="post" action="update_user_change.php">
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
											<td>'.
											'<input type="submit" class="btn btn-success" value="تغییر">' .
											'</td>
										</tr>	
										</form>
									';
							}

							echo ' </tbody>
							</table>';
						} else {
							echo '<br>';
							echo '<div class="text-center">';
							echo '<h4 class="errorM">' . "عبارت مورد نظر یافت نشد!" . '</h4>';
							echo '<h5 class="errorM">' . "لطفا دوباره امتحان کنید" . '</h5>';
							echo '<br>';
							echo '<br>';
							echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
							echo '</div>';
						}

					// if the query was no seccessful
					} else {
						echo '<br>';
						echo '<div class="text-center">';
						echo '<h4 class="errorM">' . "عملیات با مشکل روبه‌رو شد!" . '</h4>';
						echo '<br>';
						echo '<a href="/salamat/admin.php">بازگشت</a>';
						echo '</div>';
					}

						echo ' </tbody>
						</table>';

					} else {
						echo '<br>';
						echo '<div class="text-center">';
						echo '<h4 class="errorM">' . "لطفا در قسمت جستجو عبارت مورد نظر را" . '</h4>';
						echo '<h5 class="errorM">' . "وارد نمایید" . '</h5>';
						echo '<br>';
						echo '<br>';
						echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
						echo '</div>';
					}
?>
				</div>
				</div>
			</div>

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseOne").addClass("show");
	$("#side13").addClass("nav-link");
	$("#side13").addClass("disabled");
</script>
