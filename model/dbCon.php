<?php
    function dbConnection(){
        $serverName = "localhost";
        $username="root";
        $password="";
        $dbname="recipes";
        $conn = new mysqli($serverName, $username, $password, $dbname);
        return $conn;
    }
?>