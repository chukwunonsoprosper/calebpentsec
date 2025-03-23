<?php
    $connection = mysqli_connect('localhost', 'root', '', 'blog');
    if(!$connection) {
        echo 'connection was not suucesful';
    }
    
