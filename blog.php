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

		$nazwa = "";
		if (isset($_GET['nazwa'])) {
			$abc=$_GET['nazwa'];
			$nazwa = "Blogi2/".$abc;
		}


      if ($nazwa == "") {
         foreach (new DirectoryIterator("./Blogi2/") as $dirb) {
		//czy dirb jest folderem (isDir strzalka tutaj bo dirb jest iteratorem) albo czy jest kropka (unix)
             if ($dirb->isDir() && !$dirb->isDot()) {
		//przechwytywanie nazwy bloga
                $blog = $dirb->getFilename();
		//pythonowy drukowanie
                echo sprintf("<a href=\"blog.php?nazwa=%s\">%s</a><br />", $blog, $blog);
             }
         }
        

      } else {
         //szukanie blogow na poczatku przyjmuje ze nie ma takiego w bazie
			$exis = false;//exists?
	//kolejne sciezki do folderow z blogami
			$dirb = "./" . $nazwa . "/";
			if (file_exists($dirb)) {
				$exis = true;
				// Wyświetl podstawowe informacje o blogu otwieranie pliku info
				$opis = fopen($dirb . "info", 'r');
				$ln = 1; //line number
				while (($line = fgets($opis)) !== false) {
					if ($ln == 1) {
						echo "<h1>Blog użytkownika: " . $line . "</h1><h2>Opis bloga:</h2>";
					} else if ($ln > 2) {
						echo "<p>". $line . "</p>";
					}
					$ln = $ln + 1;
				}
				fclose($opis);


				// Wyświetl wpisy i komentarze
				$pat = '^[^.]*$';//pattern
				foreach (new DirectoryIterator($dirb) as $fi) {
					if (!$fi->isDir() && strpos($fi, ".") === false && $fi != "info"){
						$cont = file_get_contents($fi->getPathName());
						echo "<h2>Wpis: " . $fi . "</h2>";
						echo $cont . "<br />";

						// zalaczniki
						$pata = '/' . $fi . '[1-3]/';//pattern of attachement
						foreach (new DirectoryIterator($dirb) as $fia) {
							if (preg_match($pata, $fia)) {
						    		echo sprintf('Dołączony plik: <a href="./%s/%s">%s</a><br />', $nazwa, $fia, $fia);
						 	}
						}
						echo "<br />";

						// Wyświetl komentarze
						if (file_exists($dirb . $fi . ".k")) {
							foreach (new DirectoryIterator($dirb . $fi . ".k") as $plk) {
								if(!$plk->isDot() && !$plk->isDir()){
									//echo $plk->getPathName() . "<br />";

									$fic = fopen($plk->getPathName(), 'r');
									$ln = 1;
									while (($line = fgets($fic)) !== false) {
										if ($ln == 1) {
											echo "<strong>Typ komentarza: </strong>" . $line . "<br />";
										} else if ($ln == 2) {
											echo "<strong>Data komentarza: </strong>" . $line . "<br />";
										} else if ($ln == 3) {
											echo "<strong>Autor komentarza: </strong>" . $line . "<br />";
										} else if ($ln >= 4) {
											echo $line . "<br />";
										}
										$ln = $ln + 1;
									}
									fclose($fic);
									echo "<br />";

								}
							}
						}
						echo sprintf('<a href="./formularz_koment.php?nazwa=%s/%s">Skomentuj wpis</a><br />', $abc, $fi);
					}
				}
      }

		if (!$exis) {
			echo "Nie znaleziono blogu ! <br />";
		}
	}

   ?>
</body>
</html>