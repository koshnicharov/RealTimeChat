<?php
    require_once('core.php');
    
    if(isset($_POST['chatarea'])){
        $input = $_POST['chatarea'];
        submitMessage($input);
    }
    
    header("Location: nojs.php?submitted");
    
    