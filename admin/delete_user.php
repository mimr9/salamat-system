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
							<div class="col-12 col-md-3 col-lg-3">
							<br><br><br><br><br><br>
							</div>
					</div>
					<div class="row">
							<div class="col-12 col-md-3 col-lg-3">
							</div>
							<div style="color: #459eff;" class="col-12 col-md-6 col-lg-6">
								<h4 class="text-center vazir">
برای حذف کاربر مورد نظر انتخاب کنید:
								</h4>
							</div>
							<div class="col-12 col-md-3 col-lg-3">
							</div>
					</div>
					<div class="row">
							<div class="col-12 col-md-3 col-lg-3">
							<br><br>
							</div>
					</div>
					<div class="row vazir">
						<div class="col-12 col-md-3 col-lg-3 padding-set">
						</div>
						<div class="col-12 col-md-3 col-lg-3">
						<form method="post" action="delete_user_search.php">
							<input type="submit"  class="btn btn-primary btn-lg" value="جستجو">
						</form>
						</div>
						<div class="col-12 col-md-1 col-lg-1">
						<form method="post" action="delete_user_list.php">
							<input type="submit" class="btn btn-primary btn-lg" value="لیست">
						</form>
						</div>
						<div class="col-12 col-md-3 col-lg-3 padding-set">
						</div>
					</div>
					</div>
				</div>
			</div>

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseOne").addClass("show");
	$("#side14").addClass("nav-link");
	$("#side14").addClass("disabled");
</script>
