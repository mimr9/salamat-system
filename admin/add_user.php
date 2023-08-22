<?php include '../core/functions.php'; ?>
<?php include '../include/head_ui.html'; ?>
<?php include '../session.php' ?>
<?php include '../include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include '../include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set vazir">
						<form class="former" method="post" action="add_user_result.php" enctype="multipart/form-data">
						<div style="margin-right: 10px" class="row">
							<div class="col-12 col-md-5 col-lg-5">
								<span class="errorM">*</span>
								<label for="username">نام کاربری</label>
								<input id="username" class="form-control" required type="text" name="username" >
								<span class="errorM">*</span>
								
								<label for="firstname">نام</label>
								<input id="firstname" class="form-control" required type="text" name="firstname" >
								<span class="errorM">*</span>

								<label for="lastname">نام خانوادگی</label>
								<input id="lastname" class="form-control" required type="text" name="lastname" >

								<label for="email">ایمیل</label>
								<input id="email" class="form-control" type="text" name="email" >
								<span class="errorM">*</span>

								<label for="password">گذرواژه</label>
								<input id="password" class="form-control" required type="password" name="password">

								
								<label for="password">عکس پروفایل</label>
								<div class="custom-file">
									<input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile">
									<label class="custom-file-label text-center" for="validatedCustomFile">انتخاب عکس</label>
								</div>
							</div>
							<div class="col-12 col-md-1 col-lg-1">

							</div>
							<div class="col-12 col-md-5 col-lg-5">
								<label for="address" >آدرس محل سکونت</label>
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

								<label for="about">درباره من</label>
								<textarea id="about" class="form-control"  name="bio" ></textarea>
							</div>
						</div>
						<div class="row text-center">
							<input style="margin: 30px auto;" class="btn btn-primary" type="submit" value="ثبت نام">
						</div>
						</form>
					</div>
				</div>
			</div>

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseOne").addClass("show");
	$("#side12").addClass("nav-link");
	$("#side12").addClass("disabled");
</script>
