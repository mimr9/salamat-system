<?php

ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include 'jdf.php';

define('DB_NAME', 'salamat');
define('DB_USER', 'mimr9');
define('DB_PASSWORD', '225588');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_unicode_ci');

$DSN = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET . ';collate=' . DB_COLLATE;

define('DSN_CC', $DSN);

//Clean up the input values
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = htmlspecialchars($data);
	return $data;
}

//check is username correct or not
function check_username($data) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'select * from users where username = :username';
	$statement = $db->prepare($query);
	$statement->bindValue('username', $data);
	$statement->execute();
	$rows = $statement->fetchAll();
	if (empty($rows))
		return false;
	else
		return true;
}

//check is password correct or not
function check_password($data) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'select * from users where password = :password';
	$statement = $db->prepare($query);
	$statement->bindValue('password', $data);
	$statement->execute();
	$rows = $statement->fetchAll();
	if (empty($rows))
		return false;
	else
		return true;

}

//take users coockie and give back users id
function user_id($username) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'select id from users
		where username = :username';
	$statement = $db->prepare($query);
	$statement->bindValue('username', $username);
	$statement->execute();
	$rows = $statement->fetchAll();
	foreach ($rows as $row) {
		$user_id = $row['id'];
	}
	return $user_id;

}

//take customer id based on national code 
function customer_id($national) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'select id from customer
		where national = :national';
	$statement = $db->prepare($query);
	$statement->bindValue('national', $national);
	$statement->execute();
	$rows = $statement->fetchAll();
	foreach ($rows as $row) {
		$user_id = $row['id'];
	}
	return $user_id;

}

//start a session and register the enterance time
function start_session($id) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'insert into sessions (user_id, start, ip) values
		(:user_id, NOW(), :ip)';
	$statement = $db->prepare($query);
	$statement->bindValue('user_id', $id);
	$statement->bindValue('ip', $_SERVER['REMOTE_ADDR']);
	$statement->execute();
}

//finish a session and register the enterance time
function end_session($id) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'update sessions set end = NOW() where user_id = '. $id;
	$statement = $db->prepare($query);
	$statement->execute();
}

function show_user_name($username) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'select concat(firstname, " ", lastname) as name from users where username = :username';
	$statement = $db->prepare($query);
	$statement->bindValue('username', $username);
	$statement->execute();
	$rows = $statement->fetchAll();
	foreach ($rows as $row) {
		return  $row['name'];
	}
}

function show_user_avatar($username) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'select avatar from users where username = :username';
	$statement = $db->prepare($query);
	$statement->bindValue('username', $username);
	$statement->execute();
	$rows = $statement->fetchAll();
	foreach ($rows as $row) {
		return  $row['avatar'];
	}
}

//This checks is this id valid or not
function is_session_id($id) {
	
}

//Inserting a new user into users table
function add_user($avatar, $username, $firstname, $lastname, $email, $password, $address, $phone, $mobile, $birthday, $bio, $national) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'insert into users (avatar, username, firstname, lastname, email, password, address, phone, mobile, birthday, bio, joinday, national) values
		(:avatar, :username, :firstname, :lastname, :email, :password, :address, :phone, :mobile, :birthday, :bio, NOW(), :national)';

	$statement = $db->prepare($query);
	$params = [
		'avatar' => $avatar,
		'username' => $username,
		'firstname' => $firstname,
		'lastname' => $lastname,
		'email' => $email,
		'password' => $password,
		'address' => $address,
		'phone' => $phone,
		'mobile' => $mobile,
		'birthday' => $birthday,
		'bio' => $bio,
		'national' => $national
	];
	return	$statement->execute($params);

}

//Inserting a new customer into users table
function add_customer($firstname, $lastname, $email, $address, $phone, $mobile, $birthday, $bio, $national) {
	$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$query = 'insert into customer (firstname, lastname, email, address, phone, mobile, birthday, bio, joinday, national) values
		(:firstname, :lastname, :email, :address, :phone, :mobile, :birthday, :bio, NOW(), :national)';

	$statement = $db->prepare($query);
	$params = [
		'firstname' => $firstname,
		'lastname' => $lastname,
		'email' => $email,
		'address' => $address,
		'phone' => $phone,
		'mobile' => $mobile,
		'birthday' => $birthday,
		'bio' => $bio,
		'national' => $national
	];
	return	$statement->execute($params);
}

function login ($username) {
}

function logined ($post, $cookie) {
	if ((!empty($post['username']) && check_username($post['username'])) || (!empty($cookie['username']) && check_username($cookie['username']))) {
		return true;
	} else {
		return false;

	}
}

function logined_not () {
	echo '<br>';
	echo '<div class="text-center">';
	echo '<h4 class="errorM">' . "شما وارد نشدید، لطفا از طریق لینک زیر وارد شوید" . '</h4>';
	echo '<br>';
	echo '<a href="/salamat/login.php">بازگشت</a>';
	echo '</div>';
}

function login_not () {
	echo '<br>';
	echo '<div class="text-center">';
	echo '<h4 class="errorM">' . "اطلاعات وارد شده صحیح نمی‌باشد" . '</h4>';
	echo '<br>';
	echo '</div>';
}

class quote {
	public $writer;
	public $content;

	public function __construct() {

		$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'select writer, content from quotes order by RAND() limit 1';
		$statement = $db->prepare($query);
		$statement->execute();
		$rows = $statement->fetchAll();
		foreach ($rows as $row)	{
			$this->writer = $row['writer'];
			$this->content = $row['content'];
		}
	}

	public function writer () {
		return  $this->writer;
	}

	public function content () {
		return $this->content;
	}
}

class notify_public {

	public function all () {

		$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'select title, content, register from notify_public order by register desc';
		$statement = $db->prepare($query);
		$statement->execute();
		$rows = $statement->fetchAll();
		if(!empty($rows)) {
			foreach ($rows as $row)	{
				$expired_time = strtotime($row['register']);
				$current_time = time();
				$diff = (int) ($current_time - $expired_time) / 86400;
				$diff = floor($diff);
				
				 echo '<div class="card text-center vazir shadow mt-4 bg-warning text-dark">
					  <div class="card-header text-right" style="border-bottom: 1px solid rgb(255, 255, 255, 0.3);">'.
						'<i class="fas fa-bell ml-1"></i>'.
						$row['title'] .
					  '</div>
					  <div class="card-body text-right">
					    <p class="card-text">' .
						$row['content']	.
						'</p>
					  </div>
					  <div class="card-footer text-light bg-dark">';
						if ($diff > 0) {
							echo $diff . ' روز پیش';
						} else {
							echo 'امروز';
						}
				echo '</div>
					</div>
				';
			}
		} else {
			echo '
				<div class="text-center vazir text-success">
					اعلانی وجود ندارد
				</div>
			';
		}

	}
}

class notify_users {

	public function all () {

		$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'select title, content, register from notify_users order by register desc';
		$statement = $db->prepare($query);
		$statement->execute();
		$rows = $statement->fetchAll();
		if(!empty($rows)) {
			foreach ($rows as $row)	{
				$expired_time = strtotime($row['register']);
				$current_time = time();
				$diff = (int) ($current_time - $expired_time) / 86400;
				$diff = floor($diff);
				
				 echo '<div class="card text-center vazir shadow mt-4 bg-primary text-light">
					  <div class="card-header text-right" style="border-bottom: 1px solid rgb(255, 255, 255, 0.3);">'.
						'<i class="fas fa-phone ml-1"></i>'.
						$row['title'] .
					  '</div>
					  <div class="card-body text-right">
					    <p class="card-text">' .
						$row['content']	.
						'</p>
					  </div>
					  <div class="card-footer text-light bg-primary">';
						if ($diff > 0) {
							echo $diff . ' روز پیش';
						} else {
							echo 'امروز';
						}
				echo '</div>
					</div>
				';
			}

		} else {
			echo '
				<div class="text-center vazir text-primary">
اعلانی وجود ندارد
				</div>
			';
		}
	}
}

function avatar_user($path, $id) {
	
		$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'update users set avatar = "'. $path .'" where id = '. $id;
		$statement = $db->prepare($query);
		if($statement->execute())
			return true;
		else
			return false;
}

function avatar_customer($path, $id) {
		$db = new PDO(DSN_CC, DB_USER, DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'update customer set avatar = "'. $path .'" where id = '. $id;
		$statement = $db->prepare($query);
		if($statement->execute())
			return true;
		else
			return false;

}

function upload_file($file, $name) {
	$file_tmp_path = $file[$name]['tmp_name'];
	$file_name = $file[$name]['name'];
	$file_size = $file[$name]['size'];
	$file_type = $file[$name]['type'];
	$file_tipo = explode('.', $file_name);
	$file_extension = strtolower(end($file_tipo));
	$salamat_dir="/var/www/html/salamat/";
	$directory_path = "media/". date("Y-m-d") ."/";
	$directory_new_path = $salamat_dir . "media/". date("Y-m-d") ."/";
	$file_new_name = md5(time()) . '.' . $file_extension;
	$dest_path = $salamat_dir . $directory_path . $file_new_name;
	$file_path = "/salamat/" . $directory_path . $file_new_name;
	
	if(!file_exists($directory_path)) {
		mkdir($directory_new_path, 0755, true);
		if (move_uploaded_file($file_tmp_path, $dest_path))
			return $file_path;
		else
			return false;
	} else {
		if (move_uploaded_file($file_tmp_path, $dest_path))
			return $file_path;
		else
			return false;
	}
}

function check_file_extension($file, $name) {

	$allowed_extensions = array('jpg', 'png', 'jpeg');
	$file_name = $file[$name]['name'];
	$file_tipo = explode('.', $file_name);
	$file_extension = strtolower(end($file_tipo));

	if(in_array($file_extension, $allowed_extensions))
		return true;
	else
		return false;
}

function check_file_size($file, $name) {
	
	$file_size = $file[$name]['size'];
	if($file_size > 2000000)
		return false;
	else
		return true;
}

function avatar_default(){
	return "/salamat/assets/image/salamat-user.png";
}

?>
