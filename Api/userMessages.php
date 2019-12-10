<?php

    $id=$_POST['id'];
    
    $connect=mysqli_connect('localhost','root','','guest_book');
    $query="SELECT users.firstName , users.lastName , messages.message , messages.reply , messages.sender from users RIGHT JOIN messages ON messages.sender = users.id WHERE messages.receiver = '$id' ";
    
    $table=mysqli_query($connect,$query);

    while($row = mysqli_fetch_assoc($table)){
        $rows [] = $row;
    }
    
    print json_encode($rows);



?>