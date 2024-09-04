<?php 
    $username="";
    $password="";
    if(isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $password=$_POST['password'];

    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    #signUp {
        text-decoration: none;
        color: #784464;
    }
    #signUp:hover{
        opacity: 50%;
    }

    #signup:hover {
        opacity: 50%;
    }

    .container {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .error-message {
        color: red;
        font-size: 0.9em;
    }
    .error{
        border: red 1px solid;
    }
    #logIn:hover{
        opacity: 50%;
    }
    
</style>

<body class="d-flex flex-column vh-100">
    <nav class="navbar navbar-expand-sm text-white" style="background-color:#784464">
        <h3 class="mx-4">Healthy Food</h3>
        <div class="mx-auto">
            <ul class="navbar-nav p-2 ">
            <ul class=" navbar-nav p-2 ">
                <li class="nav-item "><a class="nav-link text-white" href="#">Home</a></li>
                <li class="nav-item "><a class="nav-link text-white" href="#">Category</a> </li>
                <li class="nav-item"><a class="nav-link text-white" href="#"id="recipes">Recipes </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Contract</a></li>
            </ul>
            </ul>
        </div>
        <div class="m-2 fw-bold" id="login">Login</div>
        <div class="vr"></div>
        <div class="m-2" id="signup" name="signup">Signup</div>
    </nav>

    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="container border rounded p-3" style="height:400px;width:400px">
            <form id="loginForm" action="login.php" method="POST">
                <h3>Welcome to</h3>
                <p>Login Page</p>
                <hr>
                <div class="input-group">
                    <span class="input-group-text" style="background-color:#784464;color:white;"><i class="fa-solid fa-user"></i></span>
                    <input id="username" type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="error-message" id="error-username"></div>
                <div class="input-group mt-3">
                    <span class="input-group-text " style="background-color:#784464;color:white;"> <i class="fa-solid fa-lock"></i> </span>
                    <input id="password" type="password" name="password" class="form-control" placeholder="*****">
                </div>
                <div class="error-message" id="error-password"></div>
                <div class="ckBox mt-2">
                    <input type="checkbox" id="showPassword"> Show Password
                </div>
                
                <input type="submit" name="login" class="container-fluid text-center p-2 border rounded mt-4" style="background-color:#784464;color:white;" id="logIn" value="Login">

                <div class="nvSignup d-flex justify-content-center">
                    Don't have an account?
                    <a class="mx-2" id="signUp" href="#"> Signup</a>
                </div>
            </form>
        </div>
    </div>

</body>

<script>
        document.addEventListener("DOMContentLoaded", function() {
    // Handle signup button redirection
        var signupBtn = document.getElementById("signup");
        if (signupBtn) {
            signupBtn.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "signup.php";
            });
        }
        var signupBtn2 = document.getElementById("signUp");
        if (signupBtn2) {
            signupBtn2.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "signup.php";
            });
        }
        

    var loginForm = document.getElementById("loginForm");
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var errorUsername = document.getElementById("error-username");
    var errorPassword = document.getElementById("error-password");
    var showPassword = document.getElementById("showPassword");

    // Show/hide password functionality
    showPassword.addEventListener('change', function() {
        if (showPassword.checked) {
            password.type = "text";
        } else {
            password.type = "password";
        }
    });

    // Form validation and AJAX submission on submit
    loginForm.addEventListener('submit', function(event) {
        // Clear any previous error messages
        errorUsername.textContent = "";
        errorPassword.textContent = "";
        username.classList.remove("error");
        password.classList.remove("error");

        let isValid = true;

        // Validate username and password
        if (username.value.trim() === "") {
            event.preventDefault();
            username.classList.add("error");
            errorUsername.textContent = "Please enter your username.";
            isValid = false;
        }

        if (password.value.trim() === "") {
            event.preventDefault();
            password.classList.add("error");
            errorPassword.textContent = "Please enter your password.";
            isValid = false;
        }

        // If both fields are valid, proceed with AJAX request
        if (isValid) {
            event.preventDefault(); // Prevent default form submission
           console.log(username.value);
           console.log(password.value);
            var xml = new XMLHttpRequest();
            xml.onload = function() {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    console.log(response);
                    if (response.status == 'success') {
                        window.location.href = "home.php";
                    } else {
                        alert("Invalid username or password");
                    }
                }
            };
            xml.open("POST", "../controler/controller.php", true);
            xml.setRequestHeader("Content-type", "application/json;charset=UTF-8");

            var data = {
                'username': username.value,
                'password': password.value,
                "action": "login"
            };
           console.log(data);
            xml.send(JSON.stringify(data));

           
        }
    });
});

</script>

</html>
