<?php 
require 'auth.php';
$login = getUserLogin();

if($login !== null && !empty($_FILES['attachment'])){
		
	$file = $_FILES['attachment'];

	$srcFileName = $file['name'];
	$srcFilePath = __DIR__ . '/uploads/' . $srcFileName;

	$allowedExtension = ['img', 'jpg', 'png'];
	$extension = pathinfo($srcFileName, PATHINFO_EXTENSION);
	

	if($file['size'] > 3000){
		$error = 'Файл превышает допустимый размер';
	} elseif(!in_array($extension, $allowedExtension)){
		$error = 'Недопустимый формат файла';
	} elseif($file['error'] !== UPLOAD_ERR_OK){
		$error = 'Файл не загружен';
	} elseif($file['error'] === UPLOAD_ERR_PARTIAL){
		$error = 'Файл загружен не полностью';
	} elseif(file_exists($srcFilePath)){
		$error = 'Файл с таким именем уже существует';
	} elseif(!move_uploaded_file($file['tmp_name'], $srcFilePath)){
		$error = 'Ошибка при загрузке файлов';
	} else {
		$result = 'http://mvc/uploads/' . $srcFileName;
	}
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php if (!empty($error)): ?>
	    <?= $error ?>
	<?php elseif (!empty($result)): ?>
	    <?= $result ?>
	<?php endif; ?>
	<br>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" max-size="35155" name="attachment">
		<input type="submit" value="Отправить">
	</form>
</body>
</html>