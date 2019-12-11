<?php include 'menu.php'; ?>
<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div>
    <form action="wpis.php" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="Nazwa użytkownika" name="userName" /> <br/>
        <input type="password" placeholder="Hasło" name="password" /> <br/>
        <textarea name="postText" rows="5" cols="28">Miejsce na Twój wpis.</textarea> <br/>
        Data <br/>
        <input type="text" name="date" value="<?php echo date("Y.m.d"); ?>" /> <br/>
        Godzina <br/>
        <input type="text" name="hour" value="<?php echo date("H:i"); ?>" /> <br/>
        <input type="file" name="file1" /> <br/>
        <input type="file" name="file2" /> <br/>
        <input type="file" name="file3" /> <br/>
        <br/> <input  type="submit" value="Dodaj post" />
        <input type="reset" value="Wyczyść formularz">
    </form>
</div>
</body>
</html>
