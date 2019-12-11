<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
   $commentName = $_POST['commentName'];// to comment
   $commentNick = $_POST['commentNick'];
   $commentText = $_POST['commentText'];//comment
   $commentType = $_POST['commentType'];
   $password = $_POST['pass'];
   include 'menu.php';

//ustawienie lokalizacji pliku z wpisem do skomentowania
   $dirb = "./Blogi2/".$commentName;//sciezka do pliku z komentarzem
   // tworzenie folderu z komentarzami
if(file_exists($dirb)){
   if (!file_exists($dirb . ".k")) {
      mkdir($dirb . ".k", 0755, true);
   }

   $dirc = $dirb . ".k/";//directory comment

   // wyszukiwanie nazwy pliku - najmniejsza mozliwa liczba
   $idc = 0;//id comment
   while (file_exists($dirc . "/" . $idc)) {
      $idc = $idc + 1;
   }

   // tworzenie komentarza
   $pc = $dirc . "/" . $idc;//path to comment
   $cf = fopen($pc, "w"); //comment file
   if (flock($cf, LOCK_EX)){
   fputs($cf, $commentType . "\n");
   $ts = date("Y-m-d H:i:s");//timestamp
   fputs($cf, $ts . "\n");
   fputs($cf, $commentNick . "\n");
   fputs($cf, $commentText);
   echo "Komentarz dodany <br />";
   flock($cf, LOCK_UN);
   }
   fclose($cf);
}
else{
   echo "Nie udało się dodać komentarza plik nie istnieje <br />";
}

?>
</body>
</html>
