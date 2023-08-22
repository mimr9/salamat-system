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
					if (!empty($_POST['search'])) {
						$search = test_input($_POST['search']);
						$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
						$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

						$query = 'select  name_fa, name_en from all_group '.
						'where name_fa like ? '.
						'or name_en like ? '.
						'order by id';

						$statement = $db->prepare($query);
						$params = array ("%$search%", "%$search%");
						if($statement->execute($params)) {
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
								$stat = $db->prepare($quary);
								$stat->execute();
								$statistic2 = $stat->fetchAll();
								foreach ($statistic2 as $stat2)
									$statistic = $stat2['count(*)'];
								
								echo '
									<form method="post" action="list_group_enter.php">
									<input type="hidden" name="name_en" value="' . $row['name_en'] .'">
									<input type="hidden" name="name_fa" value="' . $row['name_fa'] .'">
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
										<input type="submit" class="btn btn-success" value="ورود">
										</td>
									</tr>	
									</form>
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
					} else {
						echo '<br>';
						echo '<div class="text-center">';
						echo '<h4 class="errorM">' . "لطفا در قسمت جستجو عبارت مورد نظر را" . '</h4>';
						echo '<h5 class="errorM">' . "وارد نمایید" . '</h5>';
						echo '<br>';
						echo '<br>';
						echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">بازگشت</a>';
						echo '</div>';
					}
?>

<?php include '../../include/footer.html' ?>
<?php include '../../include/script_ui.html'; ?>
<script>
	$("#collapseThree").addClass("show");
	$("#side37").addClass("nav-link");
	$("#side37").addClass("disabled");
</script>
