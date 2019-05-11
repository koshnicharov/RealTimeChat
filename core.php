<?php
    $database = "mysql";
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "chatbox";
    
    try{
        $db = new PDO($database . ':host=' . $dbHost . ';dbname=' . $dbName, $dbUser, $dbPassword);
        
    }catch(PDOException $e){
        die($e->getMessage());
    }
    
    function validate($input = "It's me, \"<b>The Error</b>\".<script>alert('XSS');</script>"){
        $input = trim($input);
        $input = htmlentities($input); /* Предпазва от Cross-site scripting */
        
        return $input;
    }
    
    function submitMessage($input = "It's me, \"<b>The Error</b>\".<script>alert('XSS');</script>"){
        global $db;
        $input = validate($input);
        
        if(!empty($input)){
            $sql = "INSERT INTO messages (message, timestamp) VALUES (?, now())";
            $query = $db->prepare($sql);
            $query->bindParam(1, $input); /* Предпазва от SQL Injection */
            $query->execute();
        }
    }
    
    function fetchMessages($page = false){
        global $db;
        $page = abs(intval($page));
        
        if($page == 0){
            $sql = "SELECT * FROM messages ORDER BY id DESC";
        }else{
            $page = $page - 1;
            $limit = 3;
            $start = $page * $limit;
            
            $sql = "SELECT * FROM messages ORDER BY id DESC LIMIT " . $start . ", " . $limit;
        }
        
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        
        return($result);
    }
    
    function nlToBr($input){
        $input = nl2br($input);
        $input = str_replace("\n", "\n        ", $input);
        
        return $input;
    }
    
    function displayMessages($array = false, $page = false){
        if(!is_array($array)){
            $array = fetchMessages($page);
        }
        
        $messages = $array;
        if(!empty($messages)){
            echo "\n        ";
            echo '<div class="left clearfix">Моля спазвайте правилата</div>';
            echo "\n        ";
            echo '<hr style="margin-bottom: 10px">';
            echo "\n        ";
            foreach($messages as $message){
                echo '<div id="msg' .
                    $message['id'] . '" class="msg">' .
                    nlToBr($message['message']) . ' (<i>'.
                    $message['timestamp'] . '</i>)</div>';
                echo "\n        ";
            }
            
        }else{
            print("Няма публикувани съобщения.");
        }
    }
    
    
    