<?php 
    try {
        $con = new pdo("mysql:host=127.0.0.1;dbname=web", "guysW", "guysWeb");
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>  