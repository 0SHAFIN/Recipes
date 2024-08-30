<?php
session_start();
$name = $_SESSION['name'];

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
    #title{
        font-family:  "Copperplate", Papyrus, fantasy;
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
                    <li class="nav-item"><a class="nav-link text-white" href="#">Recipes </a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Contract</a></li>
                </ul>
                
            </div>
            
            <div class="m-2 fw-bold" id="profile"><?php echo $name ?></div>
            <div class="vr"></div>
            <div class="m-2" id="logout">Logout</div>
        </nav>
        <div class="d-flex justify-content-center mt-4">
            <h3 id="title">Your Recipes</h3>
        </div>
        <div class="container-fluid bg bg-light">
            
        </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
                var signupBtn = document.getElementById("home");
                if (signupBtn) { // Check if the element exists
                    signupBtn.addEventListener('click', function(event) {
                        event.preventDefault();
                        window.location.href = "home.php";
                    });
                }
    });
</script>
</html>