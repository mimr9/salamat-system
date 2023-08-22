<?php include 'core/functions.php'; ?>
<?php include 'include/head_ui_ex.html'; ?>

<?php include './session.php' ?>

<?php include 'include/header_ui.php' ?>

			<div class="container-fluid">
				<div class="row" style="height: 100%;">
					<div class="col-12 col-md-3 col-lg-2 sidebar" style="padding-right: unset;">
<?php include 'include/sidebar.php'; ?>
					</div>
					<div class="col-12 col-md-9 col-lg-10">
					<div class="row">
						<div class="col-12 col-md-4 col-lg-4" style="margin-top: 10px;">
							<h2 class="lalezar text-right text-primary">
							<i class="fas fa-fax"></i>
							اعلانات کاربری
							</h2>	
					<?php
						$notify_users = new notify_users();
						$notify_users->all();
					?>

						</div>
						<div class="col-12 col-md-4 col-lg-4" style="margin-top: 10px;">
							<h2 class="lalezar text-right text-success">
							<i class="fas fa-bullhorn"></i>
اعلانات عمومی
							</h2>	
					<?php
						$notify_public = new notify_public();
						$notify_public->all();
					?>

						</div>
						<div class="col-12 col-md-4 col-lg-4" style="margin-top: 10px;">
					<?php
							$quote = new quote();
							echo '
							<div class="card vazir shadow bg-info text-light">
							  <div class="card-header" style="border-bottom: 1px solid rgb(255, 255, 255, 0.3);">
								<i class="fas fa-quote-right" style="color: #436fb6;"></i>
							    سخن بزرگان
							  </div>
							  <div class="card-body">
							    <blockquote class="blockquote mb-0" style="font-size: 1rem;">
								<p>'.
									$quote->content() .
								'</p>
								<footer class="blockquote-footer text-white">'.
									$quote->writer() .
								'</footer>
							    </blockquote>
							  </div>
							</div>';
					?>
						</div>
					</div>
					</div>
				</div>
			</div>

<?php include 'include/footer.html' ?>
<?php include 'include/script_ui.html'; ?>
