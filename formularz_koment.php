<?php include 'menu.php'; ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div>
    <form action="koment.php" method="post">
        <input type="text" placeholder="Nick" name="comment_nick" /> 
        <select name="tc">
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
          </select
       Rodzaj komentarza <br>
        <select  name="comment_type">
            <option>Pozytywny</option>
            <option>Neutralny</option>
            <option>Negatywny</option>
        </select> <br/>
        <textarea name="comment_text" rows="5" cols="28">Miejsce na Twój komentarz.</textarea>

        <br/> <input  type="submit" value="Dodaj komentarz!"/>
        <input type="reset" value="Wyczyść formularz">
    </form>
</div>

</body>
</html>
