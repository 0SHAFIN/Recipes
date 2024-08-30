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
    #title{
        font-family:  "Copperplate", Papyrus, fantasy
    }
    #reDes{
        padding: 12px 20px;
        width: 100%;
        height: 300px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    #reIng{
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
    label{
        font-family: "Geneva", Verdana, sans-serif;
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
        <div class="d-flex justify-content-center mt-4">
            <h3 id="title">Add your own Recipes</h3>
        </div>
       <div class="d-flex justify-content-center">
       <div class="card m-3 w-50 d-flex justify-content-center mb-4 p-3">
    <div class="card-body p-3">
        <label class="mb-2" for="reName">Recipe name</label>
        <input type="text" class="form-control mb-2" id="reName" placeholder="Enter your recipe name">
        <label class="mb-2" for="reImg">Recipe Image</label>
        <input type="file" class="form-control mb-2" id="reImg" placeholder="Enter your recipe image">
        <label class="pb-2" for="reCat">Recipe Category</label>
        <section class="form-group pb-2">
            <select class="form-select" id="reCat" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">Breakfast</option>
                <option value="2">Lunch</option>
                <option value="3">Dinner</option>
                <option value="4">Snacks</option>
            </select>
        </section>
        <label class="mb-2" for="reIng">Recipe Ingredients</label>
        <div>
            <textarea class="mb-2" id="reIng" rows="10" cols="50" placeholder="Enter your recipe ingredients"></textarea>
        </div>
        <label class="mb-2" for="reDes">Recipe Details</label>
        <div>
            <textarea class="mb-2" id="reDes" rows="40" cols="50" placeholder="Enter your recipe details"></textarea>
        </div>
        <div class="container mb-2 p-2 border rounded" style="background-color:#784464;color:white">
            <div class="text-center">Submit</div>
        </div>
    </div>
</div>
       </div>
    
</body>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        var homeBtn=document.getElementById('home');
        homeBtn.addEventListener("click",function(event){
            if(homeBtn)
            {
                event.preventDefault();
                window.location.href="home.php";
            }
        })
    })
</script>
</html>