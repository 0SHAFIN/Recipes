<?php
require_once '../model/auth.php';
session_start();
$name = $_SESSION['name'];
$userId=$_SESSION['uId'];
$recipesDetails = getAllRecipes();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    #image {
        width: 300px;
        height: 200px;
    }

    .container1 {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    #cateGory:hover{
        opacity: 50%;
    }
    .imG{
        width: 100px;
        height: 70px;
        border-radius: 100%;
        scale: 1;
        
    }
    #caTegory{
        margin-left: 50px;
        margin-top: 50px;
        justify-content: center;
        align-items: center;
    }
    #reSearch{
        margin-left: 90px;
        background-color: #E0E5E5  ;
    }
    #cIcons{
        scale: 2;
        margin-left: 10px;
        color: #784464;
    }
    footer{
        position: relative;
        bottom: 0;
        left: 0;
        width: 100%;
        margin-top: 70px;
 
    }
    #categorY:hover{
        opacity: 50%;
    }
    #text{
        color: #784464;
    }
    .ratingS{
        color:#784464;
    }
    #reTitle{
        margin-left: 220px;
        margin-top:70px ;
    }
    #card:hover {
            opacity: 50%;
        }
        #cardS {
            justify-content: start;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            border: none;
        }
    .ratingS {
         margin-right: 4px;
         cursor: pointer;
    }
    .fa-star {
        color:#784464;
    }
    hr{
        margin-bottom: 40px;
    }
</style>

<body class="d-flex flex-column vh-100">
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
                <li class="nav-item "><a class="nav-link text-white" href="#">Home</a></li>
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

    <div class="d-flex justify-content-center mt-3">
        <h4 style="color:#784464">Category:</h4>
    </div>
    <div class="d-flex bd-highlight mb-3 justify-content-center align-items-center">
        <div class="p-3">
            <div class="">
                <div class="position-relative" id="cateGory">
                    <img id="image" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/3b/4d/f7/manny-s-spread.jpg?w=600&h=400&s=1" alt="">
                    <div class="text-center rounded position-absolute top-100 start-50 translate-middle" style="background-color:#F6BE00;color:white;width:100px">
                        First Food
                    </div>
                </div>

            </div>
        </div>
        <div class="position-relative" id="cateGory">
            <div class="p-3 ">
                <img id="image" src="https://media-cdn.tripadvisor.com/media/photo-s/18/0c/6e/48/set-menu.jpg" alt="">
                <div class="text-center rounded position-absolute top-800 start-50 translate-middle" style="background-color:#F6BE00;color:white;width:100px">
                    Set Menu
                </div>
            </div>
        </div>
        <div class="position-relative" id="cateGory">
            <div class="p-3">
                <img id="image" src="https://speedy.uenicdn.com/1d644ed5-b758-4229-b8ba-736fa89e3df2/c1725_a/image/upload/v1684866693/business/015a869d-d333-4348-aa40-fa3fc741e9a8.jpg" alt="">
                <div class="text-center rounded position-absolute top-800 start-50 translate-middle" style="background-color:#F6BE00;color:white;width:100px">
                    Thai Food
                </div>
            </div>
        </div>
        <div class="position-relative" id="cateGory">
            <div class="p-3">
                <img id="image" src="https://dairyfarmersofcanada.ca/sites/default/files/image_file_browser/conso_recipe/summer-of-shakes.jpg" alt="">
                <div class="text-center rounded position-absolute top-800 start-50 translate-middle" style="background-color:#F6BE00;color:white;width:100px">
                    Shakes
                </div>
            </div>
        </div>
        <div class="position-relative" id="cateGory">
            <div class="p-3">
                <img id="image" src="https://preview.redd.it/fizzy-drinks-v0-yyr6vtruhzbb1.jpg?width=640&crop=smart&auto=webp&s=ee3dafd94f6c3efc6a6d79e08285bc9e237601a5" alt="">
                <div class="text-center rounded position-absolute top-800 start-50 translate-middle" style="background-color:#F6BE00;color:white;width:100px">
                    Drinks
                </div>
            </div>
        </div>

    </div>


    
    <div class="d-flex bd-highlight" id="caTegory">
        <div class="p-3" id="categorY">
            <img class="imG" src="https://i0.wp.com/post.healthline.com/wp-content/uploads/2020/07/1296x728-header.jpg?w=1155&h=1528">
            <div class="text-center mt-2 fw-bold">
                Quick and Easy
            </div>
        </div>
        <div class="p-3" id="categorY">
            <img class="imG" src="https://media.cnn.com/api/v1/images/stellar/prod/160929101749-essential-spanish-dish-paella-phaidon.jpg?q=w_1900,h_1069,x_0,y_0,c_fill">
            <div class="text-center mt-2 fw-bold">
                Dinner
            </div>
        </div>
        <div class="p-3 " id="categorY">
            <img class="imG" src="https://assets.telegraphindia.com/telegraph/2023/Jul/1690269945_1-68.jpg">
            <div class="text-center mt-2 fw-bold">
                Vegetarian
            </div>
        </div>
        <div class="p-3 " id="categorY">
            <img class="imG" src="https://cdn.prod.website-files.com/63ed08484c069d0492f5b0bc/642c5de2f6aa2bd4c9abbe86_6406876a4676d1734a14a9a3_Bowl-of-vegetables-and-fruits-for-a-vegetarian-diet-vegetarian-weight-loss-plan.jpeg">
            <div class="text-center mt-2 fw-bold">
                Healthy
            </div>
        </div>
        <div class="p-3 " id="categorY">
            <img class="imG" src="https://www.shape.com/thmb/pjFshgRlqrO5Lg3uopS3bZY43HE=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/vegetarian-recipes-weight-loss-4e73a962d5f843e6a515f5a33c02c163.jpg">
            <div class="text-center mt-2 fw-bold">
                Instant Pot
            </div>
        </div>
        <div class="p-3 " id="categorY">
            <img class="imG" src="https://www.allrecipes.com/thmb/pTGS0SZsSQK85sV_RQE_K6ZfoN4=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/26460-quick-and-easy-chicken-noodle-soup-allrecipes-1x1-1-b88125437574471db3e114c40bc6928e.jpg">
            <div class="text-center mt-2 fw-bold">
                Soups
            </div>
        </div>
        <div class="p-3 " id="categorY">
            <img class="imG" src="https://static01.nyt.com/images/2022/07/15/dining/MC-Chopped-Salad-15SALADREX/merlin_209652387_1b5eee4c-9da5-443c-90e0-db20ee51a246-threeByTwoMediumAt2X.jpg">
            <div class="text-center mt-2 fw-bold">
                Salads
            </div>
        </div>
        
    </div>

    <div class="d-flex bd-highlight mt-3">
        <div class="p-2 text-center">
            <h4>Our Services</h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim quam fuga aut alias sed est eos sint nam, excepturi animi, neque vitae nostrum iusto ipsum autem dignissimos, hic officiis omnis?
        </div>
        <div class="p-2 text-center">
        <h4>Our Services</h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim quam fuga aut alias sed est eos sint nam, excepturi animi, neque vitae nostrum iusto ipsum autem dignissimos, hic officiis omnis?
        </div>
        <div class="p-2 text-center">
        <h4>Our Services</h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim quam fuga aut alias sed est eos sint nam, excepturi animi, neque vitae nostrum iusto ipsum autem dignissimos, hic officiis omnis?
        </div>
        <div class="p-2 text-center">
        <h4>Our Services</h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim quam fuga aut alias sed est eos sint nam, excepturi animi, neque vitae nostrum iusto ipsum autem dignissimos, hic officiis omnis?
        </div>
        <div class="p-2 text-center">
        <h4>Our Services</h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim quam fuga aut alias sed est eos sint nam, excepturi animi, neque vitae nostrum iusto ipsum autem dignissimos, hic officiis omnis?
        </div>
    </div>

    <div class="fw-bold d-flex" style="font-size:25px;color:#784464" id="reTitle">
        Recipes:
    </div>
    <div class="container">
         <hr>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php if($recipesDetails) {
                while($row = $recipesDetails->fetch_assoc()) { ?>
                <div class="col">
                    <div class="card h-100" id="cardS" style="background-color:#f2ecf0">
                        <img id="card" src="../recipesimages/<?php echo htmlspecialchars(getRecipeImg($row['reId'])->fetch_assoc()['reImages']); ?>" class="card-img-top" alt="recipe" style="width:100%; height:200px; object-fit:cover;">
                        <div class="card-body" id="details">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title" id="text"><strong id="reName">Recipe Name:</strong> <?php echo htmlspecialchars($row['reName']); ?></h5>
                                <small class="text-muted" id="text"><?php echo htmlspecialchars($row['upTime']); ?></small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title" id="text" style="font-size:17px"><strong id="reName" >Author Name:</strong> <?php echo htmlspecialchars($row['authorName']); ?></h5>
                            </div>
                            <div class="d-flex bd-highlight mt-4">
                                <p class="ratingS" data-rating="1"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="2"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="3"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="4"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="5"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" id="text-2">(0)</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>

</body>


<footer class="">
    <div class="d-flex bd-highlight justify-content-center align-items-end">
        <div class="p-2" id="cIcons">
            <i class="fa-brands fa-facebook"></i>
        </div>
        <div class="p-2" id="cIcons">
            <i class="fa-brands fa-instagram"></i>
        </div>
        <div class="p-2" id="cIcons">
            <i class="fa-brands fa-twitter"></i>
        </div>
        <div class="p-2"id="cIcons">
            <i class="fa-brands fa-youtube"></i>
        </div>
        <div class="p-2" id="cIcons">
            <i class="fa-brands fa-linkedin"></i>
        </div>
    </div>
    <div class="d-flex bd-highlight justify-content-center  " style="font-size: 10px;">
        <div class="">
        <i class="fa-regular fa-copyright"></i>
        </div>
        <div class="text-center">2024 Healthy Food. All Rights Reserved</div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log(<?php echo $_SESSION['username'] ?>);
    });
    document.addEventListener("DOMContentLoaded",function(){
        var profileBtn = document.getElementById("profile");
        if(profileBtn){
            profileBtn.addEventListener('click',function(event){
                event.preventDefault();
                window.location.href = "profile.php";
            });
        }
    })
    document.addEventListener("DOMContentLoaded", function() {
        var signupBtn = document.getElementById("logout");
        if (signupBtn) { // Check if the element exists
            signupBtn.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "login.php";
            });
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        var signupBtn = document.getElementById("addRecipe");
        if (signupBtn) { // Check if the element exists
            signupBtn.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "addRecipes.php";
            });
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        var signupBtn = document.getElementById("recipes");
        if (signupBtn) { // Check if the element exists
            signupBtn.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "recipes.php";
            });
        }
        var recipeDetails = document.querySelectorAll("#card");
        recipeDetails.forEach(function(card) {
            card.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "recipesDetails.php";
            });
        });
        var ratingStars = document.querySelectorAll(".ratingS");
        var cardContainers = document.querySelectorAll("#card");

        ratingStars.forEach(function(star) {
            star.addEventListener('mouseenter', function(event) {
                event.preventDefault();
                cardContainers.forEach(function(card) {
                    card.classList.add("disabled");
                });
            });

            star.addEventListener('mouseleave', function(event) {
                event.preventDefault();
                cardContainers.forEach(function(card) {
                    card.classList.remove("disabled");
                });
            });

            star.addEventListener('click', function(event) {
                event.preventDefault();
                var rating = star.getAttribute("data-rating");
                highlightStars(rating, star.closest('.card'));
            });
        });

        function highlightStars(rating, card) {
            var stars = card.querySelectorAll(".ratingS");
            stars.forEach(function(star, index) {
                if (index < rating) {
                    star.innerHTML = '<i class="fas fa-star"></i>'; // solid star for selected rating
                } else {
                    star.innerHTML = '<i class="fa-regular fa-star"></i>'; // regular star for unselected
                }
            });
        }

        var disableCardEvents = function(card) {
            card.classList.add("disabled");
            card.style.pointerEvents = 'none';
            card.style.opacity = '1'; // Ensure the card's opacity stays the same
        }

        var enableCardEvents = function(card) {
            card.classList.remove("disabled");
            card.style.pointerEvents = 'auto';
        }
    });
</script>

</html>