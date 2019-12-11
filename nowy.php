<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include 'menu.php';
$userName = $_POST['userName'];
$password = $_POST['password'];
$blogName = $_POST['blogName'];
$blogDescription = $_POST['blogDescription'];
if(is_dir("Blogi2/".$blogName)) {
    echo "Blog o podanej nazwie istnieje !!!";
}
else if (empty($userName) || empty($password) || empty($blogName)) {
    echo "Pola nazwa bloga, nazwa użytkownika i hasło nie mogą być puste !!!";
}
else {
    $oldmask = umask(0);
    mkdir("Blogi2/".$blogName, 0777);
    umask($oldmask);
    $file = fopen("Blogi2/".$blogName."/info","w");
    fwrite($file, $userName."\n");
    fwrite($file, md5($password)."\n");
    fwrite($file, $blogDescription."\n");
    fclose($file);
    echo "Pomyślnie utworzono blog o nazwie: ".$blogName;
}
?>
</body>
</html>