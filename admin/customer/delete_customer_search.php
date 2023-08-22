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
					
					<div class="row">
							<div class="col-12">
							<br><br><br><br><br><br><br><br>
							</div>
					</div>
					<div class="row">

							<div class="col-12 col-md-2 col-lg-2 padding-set">
							</div>
							<div style="color: #459eff;" class="col-12 col-md-6 col-lg-6">
								<h4 class="text-center vazir">
							مراجعه‌کننده مورد نظر را جستجو کنید
								</h4>
							</div>
							<div class="col-12 col-md-2 col-lg-2">
							</div>
							<div class="col-12 col-md-2 col-lg-2 padding-set">
							</div>

							<br>
					</div>
					<form class="former row vazir" method="post" action="delete_customer_search_result.php">
						<div class="col-12 col-md-2 col-lg-2 padding-set">
						</div>
						<div class="col-12 col-md-6 col-lg-6">
							<input class="form-control text-center" type="text" name="search" >
						</div>
						<div class="col-12 col-md-2 col-lg-2">
							<input type="submit" class="btn btn-outline-primary" value="جستجو">
						</div>
						<div class="col-12 col-md-2 col-lg-2 padding-set">
						</div>
					</form>
					</div>
				</div>
			</div>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseTwo").addClass("show");
	$("#side24").addClass("nav-link");
	$("#side24").addClass("disabled");
</script>
