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
    <form action="nowy.php" method="post">
        
        <input type="text" placeholder="Nazwa bloga" name="blogName" /> <br/>
        
        <input type="text" placeholder="Nazwa użytkownika" name="userName" /> <br/>
        <input type="password" placeholder="Hasło" name="password" /> <br/>
        <textarea name="blogDescription" rows="5" cols="28">Opis Twojego bloga.</textarea>
        <br/> <input  type="submit" value="Załóż blog!"/>
        <input type="reset" value="Wyczyść formularz">
    </form>
</div>

</body>
</html>
