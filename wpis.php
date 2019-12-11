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
$date = $_POST['date'];
$date = str_replace(".", "", $date);
$hour = $_POST['hour'];
$hour = str_replace(":", "", $hour);
$postText = $_POST['postText'];
$dir = new DirectoryIterator("Blogi2");
$znaleziono = False;
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $myfile = fopen("Blogi2/".$fileinfo->getFileName()."/info", "r" );
         $fileUserName = fgets($myfile);
         $filePassword = fgets($myfile);
        if (rtrim($fileUserName, "\r\n") == $userName && rtrim($filePassword, "\r\n") == md5($password)) {
            $znaleziono = true; 
            fclose($myfile);
             $myFile2;
             $id = 0;
             $id = str_pad($id, 2, '0', STR_PAD_LEFT);
             do
             {
              $id = $id + 1;  
              $id = str_pad($id, 2, '0', STR_PAD_LEFT);
             }while(file_exists("Blogi2/".$fileinfo->getFileName()."/".$date.$hour.date("s").$id));
             $myFile2 = fopen("Blogi2/".$fileinfo->getFileName()."/".$date.$hour.date("s").$id, "w" );
             fwrite($myFile2, $postText."\n");
             fclose($myFile2);
		     for ($i = 1 ; $i <= sizeof($_FILES) ; $i++) {
			$noa = 'file' . $i;//name of attachment
			$ca = $_FILES[$noa];//current attachement
            $ext = pathinfo($ca['name'], PATHINFO_EXTENSION);
            $uid = str_pad($i, 2, '0', STR_PAD_LEFT);
            move_uploaded_file($ca["tmp_name"], "Blogi2/".$fileinfo->getFileName()."/".$date.$hour.date("s").$uid.$i.".".$ext);
        }
             echo "Pomyślnie dodano wpis!";

            
          }
        
         
       
}
}
if(!$znaleziono)
{
    echo "Podany użytkownik nie istnieje, bądź hasło niepoprawne ! ";
}

?>
</body>
</html>
