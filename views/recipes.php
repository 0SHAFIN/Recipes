<?php
    session_start();
    require_once '../model/auth.php';
    $name=$_SESSION['name'];
    $userId=$_SESSION['uId'];
    $recipesDetails = getRecipes($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Recipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #title {
            font-family: "Copperplate", Papyrus, fantasy;
            margin-top: 30px;
            margin-bottom: 50px;
        }
        #text {
            font-family: 'Trebuchet MS', sans-serif;
            color: #784464;
        }
        #text-2 {
            font-family: 'Trebuchet MS', sans-serif;
            color: #784464;
            margin-left: 5px;
        }
        #details {
            margin-top: 20px;
            transform: translateX(-10px); /* Move the element 10 pixels to the left */
            transition: transform 0.3s ease-in-out; /* Smooth transition */
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
        #vR {
            border-left: 1px solid #784464;
            height: 150px;
            margin-left: 20px;
        }
        #reName {
            margin-right: 5px;
        }
       
        body {
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm text-white" style="background-color:#784464">
        <h3 class="mx-4">Healthy Food</h3>
        <div class="container" style="width:400px">
            <div class="input-group">
                <span class="input-group-text text-white" style="background-color: #180e14;">Search</span>
                <input type="text" class="form-control" placeholder="Search our recipes">
            </div>
        </div>
        <div class="mx-auto">
            <ul class="navbar-nav p-2">
                <li class="nav-item"><a class="nav-link text-white" href="#" id="home">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Category</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#" id="addRecipe">Add Recipes</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Recipes</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
            </ul>
        </div>
        <div class="m-2 fw-bold" id="profile"><?php echo htmlspecialchars($name); ?></div>
        <div class="vr"></div>
        <div class="m-2" id="logout">Logout</div>
    </nav>

    <div class="d-flex justify-content-center mt-4">
        <h3 id="title">Your Recipes</h3>
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
                            <div class="d-flex bd-highlight mt-4">
                                <p class="ratingS" data-rating="1"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="2"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="3"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="4"> <i class="fa-regular fa-star"></i> </p>
                                <p class="ratingS" data-rating="5"> <i class="fa-regular fa-star"></i> </p>
                                <p class="text-muted" id="text-2">(0)</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var homeBtn = document.getElementById("home");
        if (homeBtn) {
            homeBtn.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "home.php";
            });
        }

        var recipeDetails = document.querySelectorAll("#card");
        recipeDetails.forEach(function(card) {
            card.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "recipesDetails.php";
            });
        });

        // Handle star rating hover and click
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
