<?php
    
    $id=$_POST['id'];
    
    $connect=mysqli_connect('localhost','root','','guest_book');
    $query="SELECT`id`,`firstName`,`lastName` from users where `id` != '$id' ";

    $table=mysqli_query($connect,$query);

    while($row = mysqli_fetch_assoc($table)){
        $rows [] = $row;
    }
    
    print json_encode($rows);



?>