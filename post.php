<?php
session_start();    
if(isset($_SESSION['user'])){
    $name = $_SESSION['user']['name'];
    $text = $_POST['text'];
    $chat = $_POST['chat'];
    
    $fp = fopen("log".$chat.".html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>". $name."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
