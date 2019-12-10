<?php

    $sender = $_POST['user'];
    $receiver = $_POST['receiver'];
    $message = $_POST['messages'];
    
    $connect=mysqli_connect('localhost','root','','guest_book');
    $query="INSERT INTO `messages`(`sender`,`receiver`,`message`) VALUES ('$sender','$receiver','$message')";
    
    mysqli_query($connect,$query);

?>