<?php
    require_once 'dbCon.php';
    function signup($name,$phone,$gender,$username,$password)
    {
        $conn=dbConnection();
        $sql = "INSERT INTO `userinfo` (`name`, `phone`, `gender`, `username`, `password`) VALUES ('$name', '$phone', '$gender', '$username', '$password')";
        $result = $conn->query($sql) ;
        return $result;
    }
    function signin($username, $password) {
        $conn = dbConnection();
        $sql = "SELECT * FROM `userinfo` WHERE `username` = '$username'and `password` = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    
    }
    function getData($username)
    {
        $conn = dbConnection();
        $sql = "SELECT * FROM `userinfo` WHERE `username` = '$username'";
        $result = $conn->query($sql);
        return $result;
    }

    function updateData($udType,$udValue,$username)
    {
        $conn = dbConnection();
        $sql = "UPDATE `userinfo` SET `$udType` = '$udValue' WHERE `username` = '$username'";
        $result = $conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function addProfilePic($username,$profilePic)
    {
        $conn = dbConnection();
        $sql = "UPDATE `userinfo` SET `profilePic` = '$profilePic' WHERE `username` = '$username'";
        $result = $conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
?>