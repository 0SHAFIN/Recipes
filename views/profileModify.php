<?php
session_start();
$action = $_SESSION['action'] ?? 'profile'; // Fallback if action is not set
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #reSearch {
            margin-left: 90px;
            background-color: #E0E5E5;
            width: 300px;
        }
        #carD {
            margin-top: 20%;
            border-radius: 5px;
        }
        #title {
            text-align: center;
        }
    </style>
</head>
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
            <ul class="navbar-nav p-2">
                <li class="nav-item"><a class="nav-link text-white" href="#" id="home">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Category</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Add Recipes</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
            </ul>
        </div>

        <div class="m-2 active" id="profile">Name</div>
        <div class="vr"></div>
        <div class="m-2" id="logout">Logout</div>
    </nav>

    <div id="carD" class="container p-3" style="background-color:#d7c7d1;width:400px">
        <div class="">
            <div class="p-2">
                <h4 id="title" style="font-size:30px;font-family: 'Copperplate', Papyrus, fantasy">
                    Update your <span class="fw-bold"><?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?></span>
                </h4>
            </div>
            <div class="mb-3">
                <hr>
            </div>
            <div class="p-2">
                <input id="udValue" type="text" class="form-control" placeholder="Enter your <?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>" style="background-color:#e4dae0">
            </div>
            <div class="p-2">
                <div class="container p-2 border rounded" style="background-color:#784464" id="updateBtn">
                    <div class="text-center text-white">Update Changes</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var homeBtn = document.getElementById("home");
            if (homeBtn) {
                homeBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    window.location.href = "home.php";
                });
            }

            var updateBtn = document.getElementById("updateBtn");
            if (updateBtn) {
                updateBtn.addEventListener('click', function(event) {
                    event.preventDefault();

                    var xml = new XMLHttpRequest();
                    xml.onload = function() {
                        try {
                            var response = JSON.parse(this.responseText);
                            if (response.status === 'success') {
                                alert("Profile Updated Successfully");
                                window.location.href = "profile.php";
                            } else {
                                alert("Failed to update profile");
                            }
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                        }
                    };

                    xml.onerror = function() {
                        alert("An error occurred during the transaction");
                    };

                    xml.open("POST", "../controler/controller.php", true);
                    xml.setRequestHeader("Content-type", "application/json;charset=UTF-8");

                    var body = JSON.stringify({
                        "action": "update",
                        "field": "<?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>",
                        "value": document.getElementById("udValue").value
                    });

                    console.log("Sending request with body:", body); // Debugging line
                    xml.send(body);
                });
            }
        });
    </script>
</body>
</html>
