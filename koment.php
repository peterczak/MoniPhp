<?php
   $tc = $_POST['tc'];// to comment
   $user = $_POST['comment_nick'];
   $com = $_POST['comment_text'];//comment
   $tcom = $_POST['comment_type'];
   $pass = $_POST['pass'];
   include 'menu.php';

   // Komentarze umieszczane są w katalogu o nazwie: RRRRMMDDGGmmSSUU.k (w razie potrzeby skrypt musi tworzyć katalog automatycznie)
	$pasv = False;
	$usrf = False;//user found?
         foreach (new DirectoryIterator("./Blogi2/") as $ib) {//ib iterator po blogach
		//czy dirb jest folderem (isDir strzalka tutaj bo dirb jest iteratorem) albo czy jest kropka (unix)
             if ($ib->isDir() && !$ib->isDot()) {
		 foreach (new DirectoryIterator($ib->getPathName()) as $info) {
		     if ($info->getFileName()=="info") {
				$opis = fopen($info->getPathname(), 'r');
				if ($user == rtrim(fgets($opis),"\r\n")) {
					$usrf=True;
					if (md5($pass) == rtrim(fgets($opis),"\r\n")) {
						$pasv = True;
						break;
					}
				}
		     }
		 }
             }
         }



	if (!$usrf) {
		echo "Nie znaleziono uzytkownika! <br/>";
	}
	if (!$pasv&&$usrf) {
		echo "Niepoprawne hasło! <br/>";
	}
else{
//ustawienie lokalizacji pliku z wpisem do skomentowania
   $dirb = "./Blogi2/".$tc;//sciezka do pliku z komentarzem
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
   fputs($cf, $tcom . "\n");
   $ts = date("Y-m-d H:i:s");//timestamp
   fputs($cf, $ts . "\n");
   fputs($cf, $user . "\n");
   fputs($cf, $com);
   echo "Komentarz dodany <br />";
   flock($cf, LOCK_UN);
   }
   fclose($cf);
}
else{
   echo "Nie udało się dodać komentarza plik nie istnieje <br />";
}
}
?>
