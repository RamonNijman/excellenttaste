<?php
define('DB_USER', 'root');
define('DB_PASS', 'R@mon2000');
//Een try catch block probeert verbinding te maken en vangt die anders op
//Er wordt hier verbinding gemaakt met de database
try{
    $db = new PDO(
        'mysql:host=localhost;dbname=excellenttaste',
        DB_USER,DB_PASS);
    $db->setAttribute(
        PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>