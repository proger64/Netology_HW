<?php
require_once 'functions.php';

if ($_SESSION['guest']) {
	header('HTTP/1.0 403 Forbidden');
	echo 'Вы не авторизованны!';
	echo "<a href= 'index.php'> На главную </a>";
	die();
}

$uploaddir = 'tests/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	
	header('Location: list.php');
}
?>


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Тест</title>
</head>
<body>
	<form enctype="multipart/form-data" action="admin.php" method="POST">
		<input type="file" name="userfile">
		<input type="submit" value="Отправить">
	</form>
</body>
</html>

