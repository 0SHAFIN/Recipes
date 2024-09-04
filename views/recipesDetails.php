<?php
require_once '../model/auth.php';
    session_start();
    $name = $_SESSION['name'];
    $reId=isset($_GET['reId'])?$_GET['reId']:0;
    $recipe=getRecipes($reId);
    $result=$recipe->fetch_assoc();
    $recipeImages=getRecipeImg($reId);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
     #reSearch{
        margin-left: 90px;
        background-color: #E0E5E5  ;
    }
    #reName{
        font-size: 30px;
        font-weight: bold;
        color: #784464;
    }
    #carD{
        display: flex;
        justify-content: center;
    }
    #mainContainer{
        margin-top: 40px;
        margin-bottom: 40px;
    }   
</style>
<body>
    <nav class="navbar navbar-expand-sm text-white" style="background-color:#784464">
            <h3 class="mx-4">Healthy Food</h3>
            <div class="container" style="width:400px">
                <div class="input-group">
                    <span class="input-group-text text-white" style="background-color: #180e14;">Search</span>
                    <input type="text" class="form-control" placeholder="Search our recipes" id="">
                </div>
            </div>
            <div class="mx-auto">
                <ul class=" navbar-nav p-2 ">
                    <li class="nav-item "><a class="nav-link text-white" href="#"id="home">Home</a></li>
                    <li class="nav-item "><a class="nav-link text-white" href="#">Category</a> </li>
                    <li class="nav-item "><a class="nav-link text-white" href="#" id="addRecipe">Add Recipes</a> </li>
                    <li class="nav-item"><a class="nav-link text-white" href="#"id="recipes">Recipes </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Contract</a></li>
                </ul>
                
            </div>
            <div class="m-2 fw-bold" id="profile"><?php echo $name ?></div>
            <div class="vr"></div>
            <div class="m-2" id="logout">Logout</div>
    </nav>
    
    <div class="container border" style="width:100%;height:100%" id="mainContainer">
        <div class="p-3" id="carD">
            <span id="reName">Recipe Name:</span> <span id="reName" class="mx-2"><?php echo $result['reName']?></span>
        </div>
        <div style="width: 100%;">
            <hr>
        </div>
        <div class=""style="color:#784464;font-size:22px">
            <span class="fw-bold">Author Name: </span>
            <span class="fw-bold mx-2"style="color:#784464"><?php echo $result['authorName']?></span>
        </div>
        <div class="mt-3">
            <span class="fw-bold"style="color:#784464">Upload Time:</span>
            <span class="fw-bold mx-2"style="color:#784464"><?php echo $result['upTime']?></span>
        </div>
        <div style="width: 100%;">
            <hr>
        </div>
        <div>
            <p class="fw-bold"style="color:#784464">Recipe Images:</p>
        </div>
        <div>
            <?php 
            if($recipeImages->num_rows>0)
            {
                while($row=$recipeImages->fetch_assoc()){
                    ?>
                    <img class="rounded mx-2" src="../recipesImages/<?php echo $row['reImages']?>" alt="recipe image" style="width: 200px;height:200px">
               <?php }
            }?>
        </div>
        <div style="width: 100%;">
            <hr>
        </div>
        <div style="color:#784464">
            <p class="fw-bold"  >Ingredients:</p>
            <p class="mx-2"><?php echo $result['ingredients']?></p>
        </div>
        <div style="width: 100%;">
            <hr>
        </div>
        <div style="color:#784464">
            <p class="fw-bold">Description:</p>
            <p class="mx-2"><?php echo $result['descriptions']?></p>
        </div>
    </div>
    

</body>
<script>
    document.addEventListener('DOMContentLoaded',()=>{
        document.getElementById('logout').addEventListener('click',()=>{
            window.location.href='logout.php';
        });
        document.getElementById('addRecipe').addEventListener('click',()=>{
            window.location.href='addRecipe.php';
        });
        document.getElementById('recipes').addEventListener('click',()=>{
            window.location.href='recipes.php';
        });
        document.getElementById('profile').addEventListener('click',()=>{
            window.location.href='profile.php';
        });
        document.getElementById('home').addEventListener('click',()=>{
            window.location.href='home.php';
        });
    });
</script>
</html>