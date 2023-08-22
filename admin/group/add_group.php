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
					<div class="row">
							<div class="col-12 text-center lalezar" style="color: #007bff">
							<br>
							<br>
							<h1>
افزودن گروه
							</h1>
							</div>
					</div>
					<div class="row">
							<div class="col-12">
							<br><br><br>
							</div>
					</div>
						<form class="former" method="post" action="add_group_result.php">
						<div style="margin-right: 10px" class="row">
							<div class="col-12 col-md-1 col-lg-1">

							</div>
							<div class="col-12 col-md-4 col-lg-4">
								<span class="errorM">*</span>
								<label for="name_fa">نام فارسی</label>
								<input id="name_fa" class="form-control" required type="text" name="name_fa" >
							</div>
							<div class="col-12 col-md-4 col-lg-4">
								<span class="errorM">*</span>
								<label for="name_en">نام انگلیسی</label>
								<input id="name_en" class="form-control" required type="text" name="name_en" >
							</div>
							<div class="col-12 col-md-2 col-lg-2 text-center" style="position: relative;top: 45px;bottom: 1px;">
								<input type="submit" class="btn btn-outline-primary" value="افزودن">
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseThree").addClass("show");
	$("#side32").addClass("nav-link");
	$("#side32").addClass("disabled");
</script>
