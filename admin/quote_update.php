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
تغییر سخن بزرگان
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

						$query ='select id, writer, content from quotes where id = :id';
						$statement = $db->prepare($query);
						$statement->bindValue('id', $id);
						if ($statement->execute()){
							$rows = $statement->fetchAll();
							foreach ($rows as $row) {
								echo '	
								<form class="former" method="post" action="quote_update_result.php">
								<input type="hidden" name="id" value="' . $row['id'] .'">
									<div style="margin-right: 10px" class="row vazir">
									<div class="col-12 col-md-2 col-lg-4">
									</div>
									<div class="col-12 col-md-4 col-lg-4">
										<span class="errorM">*</span>
										
										<label>نقل شده از</label>
										<input class="form-control" type="text" value="'. $row['writer'] .'"name="writer" >
									</div>
									</div>
									<div style="margin-right: 10px" class="row vazir">
									<div class="col-12 col-md-2 col-lg-3">
									</div>
										<div class="col-12 col-md-6 col-lg-6">
											<label>متن سخن</label>
											<textarea class="form-control" style="height: 200px;"  name="content" >'. $row['content'] .'</textarea>
										</div>
									</div>
									<div style="margin-right: 10px" class="row vazir">
										<div class="col-12 text-center">
											<input style="margin: 30px auto;" class="btn btn-primary" type="submit" value="تغییر">
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

<?php include '../include/footer.html' ?>
<?php include '../include/script_ui.html'; ?>
<script>
	$("#collapseFive").addClass("show");
	$("#side51").addClass("nav-link");
	$("#side51").addClass("disabled");
</script>
