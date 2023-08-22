<?php include '../../core/functions.php'; ?>
<?php include '../../include/head_ui.html'; ?>
<?php include '../../session.php' ?>
<?php include '../../include/header_ui.php' ?>
			<div class="container-fluid vazir">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../../include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set">
						
<?php	
					$id = (int) $_POST['id'];
					if (!empty($_POST['id']) && gettype($id) !== 0) {
						//get the all users query back
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$query = 'select avatar, id, firstname, lastname, address, birthday, mobile, phone, email , bio, national from customer where id = :id';
						//query for the all groups available	
						$dba = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$dba->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
						$query1 = 'select name_en, name_fa from all_group';
						$statement1 = $dba->prepare($query1);
						
						$dbb = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$dbb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$statement = $db->prepare($query);
						$statement->bindValue('id', $_POST['id']);
						if($statement->execute()) {
							$rows = $statement->fetchAll();

							foreach ($rows as $row) {
							$test_birthday = strtotime($row['birthday']);
							$birthday_year = date('Y', $test_birthday);
							$birthday_month = date('m', $test_birthday);
							$birthday_day = date('d', $test_birthday);
							$test_birthday = gregorian_to_jalali($birthday_year, $birthday_month, $birthday_day, '/');
							echo '
							<form class="former" method="post" action="update_customer_result.php" enctype="multipart/form-data">
							<input type="hidden" name="id" value="' . $row['id'] .'">
								<div style="margin-right: 10px" class="row">
									<div class="col-12 col-md-5 col-lg-5">
										<span class="errorM">*</span>
										
										<label for="firstname">نام</label>
										<input id="firstname" class="form-control" required type="text" value="' . $row['firstname'] . '" name="firstname" >
										<span class="errorM">*</span>

										<label for="lastname">نام خانوادگی</label>
										<input id="lastname" class="form-control" required type="text" value="' . $row['lastname'] . '" name="lastname" >

										<label for="email">ایمیل</label>
										<input id="email" class="form-control" type="text" value="' . $row['email'] . '" name="email" >

										<label>گروه‌ها</label> <br>';
										if ($statement1->execute()){
											$rows1 = $statement1->fetchAll();
											foreach ($rows1 as $row1){
											//query for the each groups table for the same customer	
												$query2 = 'select customer_id from '. $row1['name_en'] .' where customer_id = '. $row['id'];
												$statement2 = $dbb->prepare($query2);
												if($statement2->execute()){
													$rows2 = $statement2->fetchAll();
													if (empty($rows2)) {

														echo '<div class="form-group form-check" style="display: inline-block; margin-left: 15px;">';
														echo '<input class="form-check-input" type="checkbox" name="checkbox['. $row1['name_en'] .'] " >
														<label class="form-check-label" style="margin-top: unset;" for="exampleCheck1">'. $row1['name_fa'] .'</label>'	;
														echo '</div>';
													} else {
													foreach ($rows2 as $row2){
															echo '<div class="form-group form-check" style="display: inline-block; margin-left: 15px;">';
															echo '<input class="form-check-input" type="checkbox" checked name="checkbox['. $row1['name_en'] .'] " >
															<label class="form-check-label" style="margin-top: unset;" for="exampleCheck1">'. $row1['name_fa'] .'</label>'	;
															echo '</div>';
													}
													}
												}
											}
										}
									echo '

										<label>عکس پروفایل</label>
										<div class="custom-file">
										<input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile">
										    <label class="custom-file-label text-center" for="validatedCustomFile">انتخاب عکس</label>
										</div>

										<div class="profile-img text-right">
											<div class="avatar-profile">
												<img style="width: 64px; border-radius: 5%;margin-top: 5px;" src="'. $row['avatar'] .'">
											</div>
										</div>
										<br>
										<br>
									</div>
									<div class="col-12 col-md-1 col-lg-1">

									</div>
									<div class="col-12 col-md-5 col-lg-5">

										<br><label for="address">آدرس محل سکونت</label>
										<textarea id="address" class="form-control"  name="address" >' . $row['address'] . '</textarea>

										<label for="phone">تلفن ثابت</label>
										<input id="phone" class="form-control" type="text" value="' . $row['phone'] . '" name="phone" >
										<span class="errorM">*</span>

										<label for="mobile">تلفن همراه</label>
										<input id="mobile" class="form-control" required type="text" value="' . $row['mobile'] . '" name="mobile" >
										<span class="errorM">*</span>

										<label for="national">کد ملی</label>
										<input id="national" class="form-control" required type="text" value="' . $row['national'] . '" name="national" >
										<span class="errorM">*</span>

										<label for="date1">تاریخ تولد</label>
										<input id="date1" class="form-control" required type="text" value="' . $test_birthday . '" name="birthday" >

										<label for="about">درباره من</label>
										<textarea id="about" class="form-control"  name="bio" >' . $row['bio'] . '</textarea>
									</div>
								</div>
								<div class="row text-center">
									<input style="margin: 30px auto;" class="btn btn-primary" type="submit" value="تغییر مشخصات">
								</div>
								</form>';
							}
							
						} else {
							echo '<br>';
							echo '<div class="text-center">';
							echo '<h4 class="errorM">' . "عملیات با مشکل روبه‌رو شد!" . '</h4>';
							echo '<br>';
							echo '<a href="/salamat/admin.php">بازگشت</a>';
							echo '</div>';
						}
					} else {
							//redirect to the admin page
							echo '<script>window.location.href="/salamat/admin.php";</script>';
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
