<?php
    $connection = new mysqli('localhost', 'root', '', 'blog');
    if(!$connection) {
        echo 'connection was not suucesful';
    }
    