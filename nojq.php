<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/png" href="favicon.png">
<?php require('core.php'); ?>
<link rel="stylesheet" type="text/css" href="MKBGv2.1.css">
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="">
<title>Чат в реално време</title>
</head>
<body>
<div class="container">
<div class="column3">
    <form method="POST" action="submitMessage.php" onsubmit="">
        <h2>Съобщение</h2>
        <textarea name="chatarea" id="chatarea"></textarea>
        <input id="chatbutton" name="chatbutton" type="submit" value="Изпрати">
    </form>
</div><!-- .column3 -->
<div class="column7">
    <h2>Чат, базиран на jQuery</h2>
    <div id="chatbox" class="chatbox"><?php include('chatbox.php'); ?></div>
</div><!-- .column7 -->
</div><!-- .container -->
<div class="footer">
    <h6>&copy;2018 Марио Генчев Кошничаров</h6>
</div><!-- .footer -->

<script type="text/javascript" src="NO_jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var chatbox = $('#chatbox');
    var chatarea = $('#chatarea');
    var chatbutton = $('#chatbutton');
    
    chatbutton.prop("type", "button");
    chatbutton.on('click', submitMessage);
    
    setInterval(function(){
        updateChatbox();
        
    }, 2000);
    
/*
    Премахването на тази функция ще позволи изпращането на съобщения,
    които ще се състоят от няколко реда. JQuery успешно се справя с
    кодирането на подобни символи. Тя се поддържа и от старите браузери
*/
    chatarea.on('keydown', function(event){
        // Клавиш Enter
        
        if(event.keyCode == 13){
            event.preventDefault();
            submitMessage();
        }
    });
    
    function updateChatbox(){
        chatbox.load("chatbox.php", function(){
            /* Действия, които ще се извършат след презареждането на чата */
            
        });
    }
    
    function submitMessage(){
        message = chatarea.val();
        
        if(message.length > 0){
            $.ajax({
                url: "submitMessage.php",
                method: "POST",
                data: {chatarea: message},
                success: function(){
                    updateChatbox();
                }
            });
            
            chatarea.val("");
            chatarea.focus();
        }
    }
    
});
</script>

</body>
</html>