<?php include 'core/functions.php'; ?>
<?php include 'include/head_ui.html'; ?>
<?php include './session.php' ?>
<?php include 'include/header_ui.php' ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include 'include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10 padding-set">
<?php
					//get the all users query back
					$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
					$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

					$query = 'select s.id, u.username, 
						concat(u.firstname, " ", u.lastname) as name, s.start, s.end, s.ip
						from sessions s
						left join users u on  u.id = s.user_id order by id desc
						';
					$statement = $db->prepare($query);
					$statement->execute();
					$rows = $statement->fetchAll();
					//start table head
					echo '
					<table class="table table-striped table-bordered vazir centerize">
					  <thead>
					    <tr>
					      <th scope="col">شماره</th>
					      <th scope="col">نام‌کاربری</th>
					      <th scope="col">اسم</th>
					      <th scope="col">آی‌پی</th>
					      <th scope="col">ورود</th>
					      <th scope="col">خروج</th>
					    </tr>
					  </thead>
					  <tbody>
					';
					foreach ($rows as $row) {
						echo '
						<tr>
							<td>'.
							$row['id'] .
							'</td>
							<td>'.
							$row['username'] .	
							'</td>
							<td>'.
							$row['name'] .	
							'</td>
							<td>'.
							$row['ip'] .	
							'</td>
							<td>'.
							$row['start'] .	
							'</td>
							<td>'.
							$row['end'] .	
							'</td>
						</tr>	
						';
					}
?>
					</tbody>
					</table>
					</div>
				</div>
			</div>

<?php include 'include/footer.html' ?>
<?php include 'include/script_ui.html'; ?>
<script>
	$("#report").addClass("nav-link");
	$("#report").addClass("disabled");
</script>
