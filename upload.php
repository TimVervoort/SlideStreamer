<?php

    print_r($_FILES);
    move_uploaded_file($_FILES["slide"]["tmp_name"], $_FILES["slide"]["name"]);

    die();
    
    move_uploaded_file($_FILES["slide"]["tmp_name"], "img/".microtime(true).".jpg");

    // Remove old slides
    $imgs = scandir("img"); // Ascending order
    for ($i = 0; $i < count($imgs) - 100; $i++) {
        unlink($imgs[$i]);
    }
    
?>