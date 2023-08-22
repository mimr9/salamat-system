<?php include '../../core/functions.php'; ?>
<?php include '../../include/head_ui.html'; ?>
<?php include '../../session.php' ?>
<?php include '../../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row" style="height: 100%;">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../../include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set" style="background-image: url('/salamat/assets/image/salamat-back.jpg'); background-size: cover;">
<?php
						$id = $_POST['id'];
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
						$query = 'select id, avatar, firstname, lastname, address, birthday, mobile, phone, email , bio, national from customer'.
							' where id = '. $id;
						$statement = $db->prepare($query);
						//query for the all groups available	
						$dba = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$dba->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
						$query1 = 'select name_en, name_fa from all_group';
						$statement1 = $dba->prepare($query1);
						
						$dbb = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$dbb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						if($statement->execute()) {
							$rows = $statement->fetchAll();
							foreach ($rows as $row) {
								$test_birthday = strtotime($row['birthday']);
								$birthday_year = date('Y', $test_birthday);
								$birthday_month = date('m', $test_birthday);
								$birthday_day = date('d', $test_birthday);
								$test_birthday = gregorian_to_jalali($birthday_year, $birthday_month, $birthday_day, '/');
								echo '
							<div class="former" method="post" action="update_user_change_result.php">
								<div style="margin-right: 10px; margin-bottom: 30px;" class="row vazir">
									<div class="col-12 col-md-5 col-lg-5">
										<div class="profile-img text-center">
											<div class="avatar-profile">
												<img src="'. $row['avatar'] .'">
											</div>
										</div>

										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">نام</h5>
										    <p class="card-text">' . $row['firstname'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">نام خانوادگی</h5>
										    <p class="card-text">' . $row['lastname'] . '</p>
										  </div>
										</div>
										<br>
										
										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">ایمیل</h5>
										    <p class="card-text">' . $row['email'] . '</p>
										  </div>
										</div>
										<br>


										<div class="card text-center" style="margin-right: 50px;margin-left: 50px;">
										  <div class="card-body">
										    <h5 class="card-title">گروه‌ها</h5>';
											if ($statement1->execute()){
												$rows1 = $statement1->fetchAll();
												foreach ($rows1 as $row1){
												//query for the each groups table for the same customer	
													$query2 = 'select id from '. $row1['name_en'] .' where customer_id = '. $row['id'];
													$statement2 = $dbb->prepare($query2);
													if($statement2->execute()){
														$rows2 = $statement2->fetchAll();
														foreach ($rows2 as $row2){
															if(isset($row2)){
																echo '<div class="rext-right form-group form-check" style="display: inline-block; margin-left: 15px;">';
																echo '<input class="form-check-input" type="checkbox" checked disabled readonly name="checkbox['. $row1['name_en'] .'] " >
																<label class="form-check-label" style="margin-top: unset;" for="exampleCheck1">'. $row1['name_fa'] .'</label>'	;
																echo '</div>';
															}
														}
													}
												}
											}
									echo'
										  </div>
										</div>
										<br>

									</div>
									<div class="col-12 col-md-5 col-lg-5">

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">آدرس محل سکونت</h5>
										    <p class="card-text">' . $row['address'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">تلفن ثابت</h5>
										    <p class="card-text">' . $row['phone'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">تلفن همراه</h5>
										    <p class="card-text">' . $row['mobile'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">کد‌ملی</h5>
										    <p class="card-text">' . $row['national'] . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">تاریخ تولد</h5>
										    <p class="card-text">' . $test_birthday . '</p>
										  </div>
										</div>
										<br>

										<div class="card text-center" >
										  <div class="card-body">
										    <h5 class="card-title">توضیحات</h5>
										    <p class="card-text">' . $row['bio'] . '</p>
										  </div>
										<div class="col-12 col-md-1 col-lg-1">

										</div>
											<br><br>
										</div>
									</div>
								</div>
								</div>
								';
							}
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
