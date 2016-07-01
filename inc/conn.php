<?php
<<<<<<< HEAD
$pdo = new PDO('mysql:dbname=cd2016;host=localhost', 'root', 'admin');
=======
$pdo = new PDO('mysql:dbname=cd2016;host=localhost', 'root','root');
>>>>>>> a24316cb5738f911eacde74f3eb29cb39aeb0ed0
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
