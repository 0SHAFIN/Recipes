<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<style>
    #logIn, #signUpBtn {
        text-decoration: none;
        color: #784464;
    }

    #logIn:hover, #signUpBtn:hover {
        opacity: 50%;
    }

    .container {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .error-message {
        color: red;
        font-size: 0.9em;
    }
    .errorBorder{
    
        border: 1px solid red;
    }
</style>

<body class="d-flex flex-column vh-100">
    <nav class="navbar navbar-expand-sm text-white" style="background-color:#784464">
        <h3 class="mx-4">Healthy Food</h3>
        <div class="mx-auto">
            <ul class="navbar-nav p-2">
                <li class="nav-item"><a class="nav-link text-white" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Category</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
            </ul>
        </div>
        <div class="m-2 text-white" id="login">Login</div>
        <div class="vr"></div>
        <div class="m-2">Signup</div>
    </nav>

    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="container border rounded p-3" style="height:550px;width:400px">
            <form id="signupForm">
                <h3>Welcome to</h3>
                <p>Signup Page</p>
                <hr>
                <div class="input-group">
                    <span class="input-group-text" style="background-color:#784464;color:white;"><i class="fa-solid fa-user"></i></span>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="error-message" id="nameError"></div>

                <div class="input-group mt-3">
                    <span class="input-group-text" style="background-color:#784464;color:white;"><i class="fa-solid fa-mobile-screen-button"></i></span>
                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone">
                </div>
                <div class="error-message" id="phoneError"></div>

                <div class="mt-2">
                    <h5 class="mx-2">Gender:</h5>
                    <label class="mx-2">Male</label>
                    <input id="genderMale" type="radio" name="gender" value="Male">
                    <label class="mx-2">Female</label>
                    <input id="genderFemale" type="radio" name="gender" value="Female">
                    <label class="mx-2">Others</label>
                    <input id="genderOthers" type="radio" name="gender" value="Others">
                </div>
                <div class="error-message" id="genderError"></div>

                <div class="input-group mt-3">
                    <span class="input-group-text" style="background-color:#784464;color:white;"><i class="fa-solid fa-user"></i></span>
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="error-message" id="usernameError"></div>

                <div class="input-group mt-3">
                    <span class="input-group-text" style="background-color:#784464;color:white;"><i class="fa-solid fa-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="*****">
                </div>
                <div class="error-message" id="passwordError"></div>

                <div class="ckBox mt-2">
                    <input type="checkbox" id="ckbox"> Show Password
                </div>

                <input id="signUpBtn" type="submit" class="container-fluid text-center p-2 border rounded mt-2" style="background-color:#784464;color:white;" value="Signup">
                <div class="nvSignup d-flex justify-content-center">
                    Already have an account? <a class="mx-2" id="logIn" href="#">Login</a>
                </div>
            </form>
        </div>
    </div>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var logInBtn = document.getElementById("logIn");
        if (logInBtn) {
            logInBtn.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "login.php";
            });
        }

        var loginLink = document.getElementById("login");
        if (loginLink) {
            loginLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = "login.php";
            });
        }

        var passwordField = document.getElementById("password");
        var showPasswordCheckbox = document.getElementById("ckbox");
        showPasswordCheckbox.addEventListener('change', function() {
            passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
        });

        var signupForm = document.getElementById("signupForm");
        signupForm.addEventListener("submit", function(event) {
            event.preventDefault();

            // Get form fields
            var name = document.getElementById("name").value.trim();
            var phone = document.getElementById("phone").value.trim();
            var gender = document.querySelector('input[name="gender"]:checked');
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();

            // Get error fields
            var nameError = document.getElementById("nameError");
            var phoneError = document.getElementById("phoneError");
            var genderError = document.getElementById("genderError");
            var usernameError = document.getElementById("usernameError");
            var passwordError = document.getElementById("passwordError");

            // Reset error messages
            nameError.textContent = "";
            phoneError.textContent = "";
            genderError.textContent = "";
            usernameError.textContent = "";
            passwordError.textContent = "";

            var isValid = true;

            // Validation
            if (name === "") {
                nameError.textContent = "Name is required";
                var name = document.getElementById("name");
                name.classList.add("errorBorder");
                isValid = false;
            }
            if (phone === "") {
                phoneError.textContent = "Phone is required";
                var phone = document.getElementById("phone");
                phone.classList.add("errorBorder");
                isValid = false;
            }
            if (!gender) {
                genderError.textContent = "Choose your gender";
                
                isValid = false;
            }
            if (username === "") {
                usernameError.textContent = "Username is required";
                var username = document.getElementById("username");
                username.classList.add("errorBorder");
                isValid = false;
            }
            if (password === "") {
                passwordError.textContent = "Password is required";
                var password = document.getElementById("password");
                password.classList.add("errorBorder");
                isValid = false;
            }

            // If form is valid, submit via AJAX
            if (isValid) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../controler/controller.php", true);
                xhr.setRequestHeader("Content-type", "application/json;charset=UTF-8");

                xhr.onload = function() {
                    if (xhr.status == 200) {
                        var res = JSON.parse(xhr.responseText);
                        if (res.status === 'success') {
                            window.location.href = 'login.php';
                        } else {
                            alert('Signup failed. Please try again.');
                        }
                    }
                };

                var data = JSON.stringify({
                    name: name,
                    phone: phone,
                    gender: gender.value,
                    username: username,
                    password: password,
                    action: 'signup'
                });
                console.log(data);
                xhr.send(data);
            }
            else
            {
                
            }
        });
    });
</script>

</html>
