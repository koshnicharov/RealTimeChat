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
</body>
</html>