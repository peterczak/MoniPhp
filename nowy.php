<?php
include 'menu.php';
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$blog_name = $_POST['blog_name'];
$blog_description = $_POST['blog_description'];
if(is_dir("blogi/".$blog_name)) {
    echo "Blog o podanej nazwie istnieje !!!";
}
else if (empty($user_name) || empty($password) || empty($blog_name)) {
    echo "Pola nazwa bloga, nazwa użytkownika i hasło nie mogą być puste !!!";
}
else {
    $oldmask = umask(0);
    mkdir("Blogi2/".$blog_name, 0777);
    umask($oldmask);
    $file = fopen("Blogi2/".$blog_name."/info","w");
    fwrite($file, $user_name."\n");
    fwrite($file, md5($password)."\n");
    fwrite($file, $blog_description."\n");
    fclose($file);
}
?>