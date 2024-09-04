<?php
session_start();
require_once '../model/dbCon.php';  
require_once '../model/auth.php';

$userId = (int)$_SESSION['uId'];
$conn = dbConnection(); 
$errorMsg = "";
$recipeId = 0;

if (isset($_POST['submit'])) {
       // Close image statement
       $reName = $_POST['reName'];
       $reCat = $_POST['reCat'];
       $reIng = $_POST['reIng'];
       $reDes = $_POST['reDes'];
       $authorName = $_SESSION['name'];
       $time = date("j M y g:i A");; 
       if(addRecipes($userId, $reName, $reIng, $reDes, $reCat, $authorName, $time) ) {
           $errorMsg = "Recipe added successfully";
           $sql="SELECT reId from urecipe where userId='$userId'";
              $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $recipeId = $row['reId'];
                    }
                }
                echo $recipeId;
          // header("Location: home.php");
       } else {
           $errorMsg = "Failed to add recipe";
       }
    $imageCnt = count($_FILES['file']['name']);
    $imageUploaded = false;
    $stmtImage = $conn->prepare("INSERT INTO reimages (userId, recipe_id, reImages) VALUES (?, ?, ?)");
    if ($stmtImage === false) {
        die("Prepare statement for image upload failed: " . $conn->error);
    }

    for ($i = 0; $i < $imageCnt; $i++) {
        $fileName = $_FILES['file']['name'][$i];
        $fileTmpName = $_FILES['file']['tmp_name'][$i];
        $path = "../recipesImages/" . $fileName;

        if (move_uploaded_file($fileTmpName, $path)) {
            $stmtImage->bind_param("iis", $userId, $recipeId, $fileName);
            if ($stmtImage->execute()) {
                $errorMsg = "Image uploaded successfully";
                $imageUploaded = true;
                echo $errorMsg;
                //header("location: home.php");
            } else {
                $errorMsg = "Failed to upload image";
            }
        } else {
           $errorMsg = "Failed to move image";
        }
    }

 
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    #title {
        font-family: "Copperplate", Papyrus, fantasy
    }

    #reDes {
        padding: 12px 20px;
        width: 100%;
        height: 300px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    #reIng {
        padding: 12px 20px;
        width: 100%;
        height: 150px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .card {
        border: none;
        background-color: #f2ecf0;
    }

    label {
        font-family: "Geneva", Verdana, sans-serif;
    }
    #submitBTN{
        background-color: #784464;
        width: 100%;
        color: white;
        padding: 10px;
        margin: 8px 0;
        border: none;
        border-radius:7px;
        cursor: pointer;
    }
</style>

<body>
    <nav class="navbar navbar-expand-sm text-white" style="background-color:#784464">
        <h3 class="mx-4">Healthy Food</h3>
        <div class="mx-auto">
            <ul class=" navbar-nav p-2 ">
                <li class="nav-item "><a class="nav-link text-white" href="#" id="home">Home</a></li>
                <li class="nav-item "><a class="nav-link text-white" href="#">Category</a> </li>
                <li class="nav-item "><a class="nav-link text-white fw-bold" href="#" id="addRecipe">Add Recipes</a> </li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Contract</a></li>
            </ul>
        </div>
        <div class="m-2 active">Login</div>
        <div class="vr"></div>
        <div class="m-2" id="signup">Signup</div>
    </nav>

    <form action="addRecipes.php" method="POST" enctype="multipart/form-data">
    <div class="d-flex justify-content-center mt-4">
        <h3 id="title">Add your own Recipes</h3>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card m-3 w-50 d-flex justify-content-center mb-4 p-3">
            <div class="card-body p-3">
                <label class="mb-2" for="reName">Recipe name</label>
                <input type="text" class="form-control mb-2" id="reName" name="reName" placeholder="Enter your recipe name">
                <label class="mb-2" for="file">Recipe Image</label>
                <input type="file" class="form-control mb-2" id="file" name="file[]" placeholder="Enter your recipe image" multiple>
                <label class="pb-2" for="reCat">Recipe Category</label>
                <section class="form-group pb-2">
                    <select class="form-select" id="reCat" name="reCat" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="First Food">First Food</option>
                        <option value="Set Menu">Set Menu</option>
                        <option value="Thai Food">Thai Food</option>
                        <option value="Shakes">Shakes</option>
                        <option value="Drinks">Drinks</option>
                    </select>
                </section>
                <label class="mb-2" for="reIng">Recipe Ingredients</label>
                <div>
                    <textarea class="mb-2" id="reIng" name="reIng" rows="10" cols="50" placeholder="Enter your recipe ingredients"></textarea>
                </div>
                <label class="mb-2" for="reDes">Recipe Details</label>
                <div>
                    <textarea class="mb-2" id="reDes" name="reDes" rows="40" cols="50" placeholder="Enter your recipe details"></textarea>
                </div>
                <input type="submit" class="" name="submit" value="Submit" id="submitBTN">
            </div>
        </div>
    </div>
</form>


</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var errorMsg = "<?php echo addslashes($errorMsg); ?>";
            if (errorMsg) {
                alert(errorMsg);
            }
        var homeBtn = document.getElementById('home');
        homeBtn.addEventListener("click", function(event) {
            if (homeBtn) {
                event.preventDefault();
                window.location.href = "home.php";
            }
        })
    })
</script>

</html>