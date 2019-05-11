<?php
    require_once('../core.php');
    
    $sql = "DROP TABLE messages";
    $query = $db->prepare($sql);
    $query->execute();
    
    $sql = "
    CREATE TABLE messages (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    message TEXT,
    timestamp DATETIME
    )";
    $query = $db->prepare($sql);
    $query->execute();
    
    header("Location: ../index.php");
    
    