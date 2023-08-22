<?php
echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #436FB6 !important; box-shadow: 2px 2px 2px #dbdee3;">
	<a href="/salamat/admin.php"><img style="position: relative;bottom: 3px;" src="/salamat/assets/image/salamat-logo-64.png"></a>
	<a class="navbar-brand" style="font-family: vazir,serif; color: white;" href="/salamat/admin.php">سامانه سلامت</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto">
	</ul>
		<div class="nav-item dropdown vazir">
			<a class="nav-link vazir" style="color: white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			if (!empty($_SESSION['login_user'])) {
				echo '<img style="width: 40px; border-radius: 50%;margin-left: 7px;border: 2px solid white;" src="' . show_user_avatar($_SESSION['login_user']) . '">';
				echo '<span>' . show_user_name($_SESSION['login_user']) . '</span>';
			} elseif (!empty($_POST['username'])) {
				echo '<img style="width: 32px; border-radius: 50%;margin-left: 7px;" src="' . show_user_avatar($_POST['username']) . '">';
				echo show_user_name($_POST['username']);
			}
			echo '
			<i style="position: relative; top:5px; right: 3px;" class="fas fa-caret-down"></i>
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item text-center" href="/salamat/admin/profile.php?request=profile">پروفایل</a>
				<a class="dropdown-item text-center" href="/salamat/admin/profile.php?request=change">تغییر مشخصات</a>
			</div>
		</div>
	<form action="/salamat/exit.php" class="form-inline my-2 my-lg-0">
	      <button class="btn btn-outline-light my-2 my-sm-0" style="font-family: vazir, serif;" type="submit">خروج</button>
	</form>
	</div>
</nav>';
?>
