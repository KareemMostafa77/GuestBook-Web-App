<?php

    
    $message = $_POST['messages'];
    
    
    $connect=mysqli_connect('localhost','root','','guest_book');
    $query="DELETE FROM `messages` WHERE `message`= '$message'";
    
    mysqli_query($connect,$query);

?>