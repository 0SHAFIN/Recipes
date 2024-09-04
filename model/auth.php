<?php
    require_once 'dbCon.php';
    function signup($name,$phone,$gender,$username,$password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $conn=dbConnection();
        $sql = "INSERT INTO `userinfo` (`name`, `phone`, `gender`, `username`, `password`) VALUES ('$name', '$phone', '$gender', '$username', '$password')";
        $result = $conn->query($sql) ;
        return $result;
    }
    function signin($username, $password) {
        $conn = dbConnection();
        $sql = "SELECT password FROM `userinfo` WHERE `username` = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            if(password_verify($password, $result['password'])) {
                return true;
            } else {
                return false;
            }
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
    function addRecipes($userId,$reName,$ingredients,$description,$category,$authorName,$time)
    {
        $conn = dbConnection();
        $sql = "INSERT INTO `urecipe` (`userId`, `reName`, `ingredients`, `descriptions`, `category`, `authorName`, `upTime`) VALUES ('$userId', '$reName', '$ingredients', '$description', '$category', '$authorName', '$time')";
        $result = $conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } function getRecipes($reId)
    {
        $conn = dbConnection();
        $sql = "SELECT * FROM `urecipe` WHERE `reId` = '$reId'";
        $result = $conn->query($sql);
        return $result;
    }
    function getRecipeImg($reId)
    {
        $conn = dbConnection();
        $sql = "SELECT * FROM `reimages` WHERE `recipe_id` = '$reId'";
        $result = $conn->query($sql);
        return $result;
    }
    function getAllRecipes()
    {
        $conn = dbConnection();
        $sql = "SELECT * FROM `urecipe`";
        $result = $conn->query($sql);
        return $result;
    }
    function recipeBytCT($category)
    {
        $conn = dbConnection();
        $sql = "SELECT * FROM `urecipe` WHERE `category` = '$category'";
        $result = $conn->query($sql);
        return $result;
    }
    function getRecipeById($userId)
    {
        $conn = dbConnection();
        $sql = "SELECT * FROM `urecipe` WHERE `userId` = '$userId'";
        $result = $conn->query($sql);
        return $result;
    }
    
  
    
    
    
?>