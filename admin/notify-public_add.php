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
						<div class="row">
							<div class="col-12 text-center lalezar" style="color: #007bff">
							<br>
							<br>
							<h1>
افزودن اعلان عمومی
							</h1>
							</div>
						</div>
						<form class="former" method="post" action="notify-public_add_result.php">
							<div style="margin-right: 10px" class="row vazir">
							<div class="col-12 col-md-2 col-lg-4">
							</div>
							<div class="col-12 col-md-4 col-lg-4">
								<span class="errorM">*</span>
								
								<label for="title">عنوان</label>
								<input id="title" class="form-control" type="text" name="title" >
							</div>
							</div>
							<div style="margin-right: 10px" class="row vazir">
							<div class="col-12 col-md-2 col-lg-3">
							</div>
								<div class="col-12 col-md-6 col-lg-6">
									<label for="content">متن اعلان</label>
									<textarea id="content" class="form-control" style="height: 200px;"  name="content" ></textarea>
								</div>
							</div>
							<div style="margin-right: 10px" class="row vazir">
								<div class="col-12 text-center">
									<input style="margin: 30px auto;" class="btn btn-primary" type="submit" value="افزودن">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseFive").addClass("show");
	$("#side52").addClass("nav-link");
	$("#side52").addClass("disabled");
</script>
