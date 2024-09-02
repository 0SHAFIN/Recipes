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
    function addRecipes($userId,$reName,$ingredients,$description,$category,$authorName,$time)
    {
        $conn = dbConnection();
        $sql = "INSERT INTO `urecipe` (`userId`, `reName`, `ingredients`, `descriptions`, `category`, `authorName`, `uptime`) VALUES ('$userId', '$reName', '$ingredients', '$description', '$category', '$authorName', '$time')";
        $result = $conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } function getRecipes($userId)
    {
        $conn = dbConnection();
        $sql = "SELECT * FROM `urecipe` WHERE `userId` = '$userId'";
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
    function getRecipeIdsByUserId($reId) {
        $conn = dbConnection();
        $sql = "SELECT recipe_id FROM urecipe WHERE recipe_id = '$reId'";
        $result = $conn->query($sql);
        $recipeIds = [];
        while ($row = $result->fetch_assoc()) {
            $recipeIds[] = $row['recipe_id'];
        }
        $conn->close();
        return $recipeIds;
    }
    
    function getFirstImageForUserRecipes($userId) {
        $recipeIds = getRecipeIdsByUserId($userId);
        
        // If there are no recipe IDs, return an empty array
        if (empty($recipeIds)) {
            return [];
        }
    
        $conn = dbConnection();
        $ids = implode(',', array_map('intval', $recipeIds));
        $sql = "SELECT recipe_id, reImage FROM reImages WHERE recipe_id IN ($ids) ORDER BY uid ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $images = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $conn->close();
    
        // Map recipe ID to the first image URL
        $imageMap = [];
        foreach ($images as $image) {
            if (!isset($imageMap[$image['recipe_id']])) {
                $imageMap[$image['recipe_id']] = $image['reImage'];
            }
        }
        return $imageMap;
    }
    
    
    
?>