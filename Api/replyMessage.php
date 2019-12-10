<?php

    
    $message = $_POST['messages'];
    $reply=$_POST['reply'];
    
    $connect=mysqli_connect('localhost','root','','guest_book');
    $query="UPDATE `messages` SET `reply`='$reply' WHERE `message`= '$message'";
    
    mysqli_query($connect,$query);

?>