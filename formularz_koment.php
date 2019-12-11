<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'menu.php'; ?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div>
    <form action="koment.php" method="post">
        <input type="text" placeholder="Nick" name="commentNick" /> 
        <select name="commentName">
              <?php
		$nazwa = "";
		if (isset($_GET['nazwa'])) {
			$nazwa =$_GET['nazwa'];
		}
      if ($nazwa == "") {
		 foreach (new DirectoryIterator("./Blogi2/") as $ib) {//ib iterator po blogach
			//czy dirb jest folderem (isDir strzalka tutaj bo dirb jest iteratorem) albo czy jest kropka (unix)
		     if ($ib->isDir() && !$ib->isDot()) {
			 foreach (new DirectoryIterator($ib->getPathName()) as $plik) {
			     if (strpos($plik, ".") === false && $plik != "info") {
				echo "<option>" . $ib."/". basename($plik) . "</option>";
			     }
			 }
		     }
		 }
}
else{
				echo "<option>" . $nazwa . "</option>";

}
             ?>
          </select>
      <br> Rodzaj komentarza 
        <select  name="commentType">
            <option>Pozytywny</option>
            <option>Neutralny</option>
            <option>Negatywny</option>
        </select> <br/>
        <textarea name="commentText" rows="5" cols="28">Miejsce na Twój komentarz.</textarea>

        <br/> <input  type="submit" value="Dodaj komentarz!"/>
        <input type="reset" value="Wyczyść formularz">
    </form>
</div>

</body>
</html>
