<?php include '../../core/functions.php'; ?>
<?php include '../../include/head_ui.html'; ?>
<?php include '../../session.php' ?>
<?php include '../../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../../include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set vazir">
						<form class="former" method="post" action="add_customer_result.php" enctype="multipart/form-data">
						<div style="margin-right: 10px" class="row">
							<div class="col-12 col-md-5 col-lg-5">
								<span class="errorM">*</span>
								
								<label for="firstname">نام</label>
								<input id="firstname" class="form-control" required type="text" name="firstname" >
								<span class="errorM">*</span>

								<label for="lastname">نام خانوادگی</label>
								<input id="lastname" class="form-control" required type="text" name="lastname" >

								<label for="email">ایمیل</label>
								<input id="email" class="form-control" type="text" name="email" >

								<label style="display: block; margin-bottom: 15px; margin-top: 25px;">انتخاب گروه</label>
<?php
								//query for the all groups available	
								$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
								$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

								$query = 'select name_fa, name_en from all_group';
								$statement = $db->prepare($query);
								if($statement->execute()) {
									$rows = $statement->fetchAll();
									foreach ($rows as $row) {
										echo '<div class="form-group form-check" style="display: inline-block; margin-left: 15px;">';
										echo '<input class="form-check-input" type="checkbox" name="checkbox['. $row['name_en'] .']" >
										<label class="form-check-label" style="margin-top: unset;" for="exampleCheck1">'. $row['name_fa'] .'</label>'	;
										echo '</div>';
									}

								} else {
									echo '<p>گروهی وجود ندارد</p>';
								}

								echo '
								<br>	
								<label for="password">عکس پروفایل</label>
								<div class="custom-file">
									<input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile">
									<label class="custom-file-label text-center" for="validatedCustomFile">انتخاب عکس</label>
								</div>
							</div>
							<div class="col-12 col-md-1 col-lg-1">

							</div>
							<div class="col-12 col-md-5 col-lg-5">
								<br><label for="address">آدرس محل سکونت</label>
								<textarea id="address" class="form-control"  name="address" ></textarea>

								<label for="phone">تلفن ثابت</label>
								<input id="phone" class="form-control" type="text" name="phone" >
								<span class="errorM">*</span>

								<label for="mobile">تلفن همراه</label>
								<input id="mobile" class="form-control" required type="text" name="mobile" >
								<span class="errorM">*</span>

								<label for="national">کد ملی</label>
								<input id="national" class="form-control" required type="text" name="national" >
								<span class="errorM">*</span>

								<label for="date1">تاریخ تولد</label>
								<input id="date1" class="form-control" required type="text" name="birthday" >

								<label for="bio">توضیحات</label>
								<textarea id="bio" class="form-control"  name="bio" ></textarea>
							</div>
						</div>
						<div class="row text-center">
							<input style="margin: 30px auto;" class="btn btn-primary" type="submit" value="ثبت نام">
						</div>
						</form>
					</div>
				</div>
			</div>';
?>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseTwo").addClass("show");
	$("#side22").addClass("nav-link");
	$("#side22").addClass("disabled");
</script>
