<?php include 'menu.php'; ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div>
    <form action="nowy.php" method="post">
        
        <input type="text" placeholder="Nazwa bloga" name="blog_name" /> <br/>
        
        <input type="text" placeholder="Nazwa użytkownika" name="user_name" /> <br/>
        <input type="password" placeholder="Hasło" name="password" /> <br/>
        <textarea name="blog_description" rows="5" cols="28">Opis Twojego bloga.</textarea>
        <br/> <input  type="submit" value="Załóż blog!"/>
        <input type="reset" value="Wyczyść formularz">
    </form>
</div>

</body>
</html>
