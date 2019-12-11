<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'menu.php';
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$date = $_POST['date'];
$date = str_replace(".", "", $date);
$hour = $_POST['hour'];
$hour = str_replace(":", "", $hour);
$post_text = $_POST['post_text'];
$dir = new DirectoryIterator("Blogi2");
$znaleziono = False;
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $myfile = fopen("Blogi2/".$fileinfo->getFileName()."/info", "r" );
         $fileUserName = fgets($myfile);
         $filePassword = fgets($myfile);
        if (rtrim($fileUserName, "\r\n") == $user_name && rtrim($filePassword, "\r\n") == md5($password)) {
             fclose($myfile);
             $myFile2;
             $id = 0;
             $id = str_pad($id, 2, '0', STR_PAD_LEFT);
             echo $id;
             do
             {
              $id = $id + 1;  
              $id = str_pad($id, 2, '0', STR_PAD_LEFT);
             }while(file_exists("Blogi2/".$fileinfo->getFileName()."/".$date.$hour.date("s").$id));
             $myFile2 = fopen("Blogi2/".$fileinfo->getFileName()."/".$date.$hour.date("s").$id, "w" );
             fwrite($myFile2, $post_text."\n");
             fclose($myFile2);
		     for ($i = 1 ; $i <= sizeof($_FILES) ; $i++) {
			$noa = 'file' . $i;//name of attachment
			$ca = $_FILES[$noa];//current attachement
            $ext = pathinfo($ca['name'], PATHINFO_EXTENSION);
            $uid = str_pad($i, 2, '0', STR_PAD_LEFT);
            move_uploaded_file($ca["tmp_name"], "Blogi2/".$fileinfo->getFileName()."/".$date.$hour.date("s").$uid.$i.".".$ext);
        }
             $znaleziono = True;
            
          }
         
       
}
}

?>
