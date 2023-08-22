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
<?php	
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$dba = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$dba->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$query = 'select  id, name_fa, name_en from all_group 
						';
						$statement = $db->prepare($query);
						if($statement->execute()) {
							$rows = $statement->fetchAll();
							//start table head
							echo '
							<table class="table table-striped table-bordered vazir centerize">
							  <thead>
							    <tr>
							      <th scope="col">شماره</th>
							      <th class="text-success" scope="col"><h5>نام گروه</h5></th>
							      <th class="text-information" scope="col"><h5>تعداد اعضا</h5></th>
							      <th scope="col">عملیات</th>
							    </tr>
							  </thead>
							  <tbody>
							';
							$counter = 1;
							foreach ($rows as $row) {
								$quary = 'select count(*) from '. $row['name_en'];
								$stat = $dba->prepare($quary);
								$stat->execute();
								$statistic2 = $stat->fetchAll();
								foreach ($statistic2 as $stat2)
									$statistic = $stat2['count(*)'];
								
								echo '
									<tr>
										<td>'.
										$counter++ .
										'</td>
										<td><h5>'.
										$row['name_fa'] .	
										'</h5></td>
										<td><h5>'.
										$statistic .	
										'</h5></td>
										<td>
										<form style="display: inline-block;" method="post" action="list_group_enter.php">
										<input type="hidden" name="name_en" value="' . $row['name_en'] .'">
										<input type="hidden" name="name_fa" value="' . $row['name_fa'] .'">
											<input type="submit" class="btn btn-info" value="ورود">
										</form>
										<form style="display: inline-block;" method="post" action="delete_group_customer_change.php">
										<input type="hidden" name="name_en" value="' . $row['name_en'] .'">
										<input type="hidden" name="name_fa" value="' . $row['name_fa'] .'">
											<input type="submit" class="btn btn-success" value="انتخاب">
										</form>
										</td>
									</tr>	
								';
							}

							echo ' </tbody>
							</table>';
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
	$("#side35").addClass("nav-link");
	$("#side35").addClass("disabled");
</script>
