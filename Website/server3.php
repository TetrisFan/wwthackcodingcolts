<?php
    $host = 'localhost';
    $dbname = 'clubapp';
    $user = 'root';
    $pass = 'PASSWORD';
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>