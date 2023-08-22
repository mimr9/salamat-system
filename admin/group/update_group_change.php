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
							<div class="col-12 text-center lalezar" style="color: #007bff">
							<br>
							<br>
							<h1>
تغییر نام گروه
							</h1>
							</div>
					</div>
					<div class="row">
							<div class="col-12">
							<br><br><br>
							</div>
					</div>
<?php
					$id = (int) $_POST['id'];
					if(!empty($_POST['id']) && $id !== 0) {
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$query ='select id, name_en, name_fa from all_group where id = :id';
						$statement = $db->prepare($query);
						$statement->bindValue('id', $_POST['id']);
						if ($statement->execute()){
							$rows = $statement->fetchAll();
							foreach ($rows as $row) {
								echo '	
								<form class="former vazir" method="post" action="update_group_result.php">
								<input type="hidden" name="id" value="' . $row['id'] .'">
								<div style="margin-right: 10px" class="row">
									<div class="col-12 col-md-1 col-lg-1">

									</div>
									<div class="col-12 col-md-4 col-lg-4">
										<span class="errorM">*</span>
										<label for="name_fa">نام فارسی</label>
										<input id="name_fa" class="form-control" required type="text" value="' . $row['name_fa'] . '" name="name_fa" >
									</div>
									<div class="col-12 col-md-4 col-lg-4">
										<span class="errorM">*</span>
										<label>نام انگلیسی</label>
										<input class="form-control" required readonly type="text" value="' . $row['name_en'] . '" name="name_en" >
									</div>
									<div class="col-12 col-md-2 col-lg-2 text-center" style="position: relative;top: 45px;bottom: 1px;">
										<input type="submit" class="btn btn-outline-primary" value="تغییر نام">
									</div>
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

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseThree").addClass("show");
	$("#side33").addClass("nav-link");
	$("#side33").addClass("disabled");
</script>
