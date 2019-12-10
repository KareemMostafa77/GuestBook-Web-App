<?php

    $old=$_POST['old'];
    $message = $_POST['messages'];
    
    
    $connect=mysqli_connect('localhost','root','','guest_book');
    $query="UPDATE `messages` SET `message`='$message' WHERE `message`= '$old'";
    
    mysqli_query($connect,$query);

?>