<?php
session_start();
require_once '../model/auth.php';
require_once '../model/dbCon.php';
$email = $_SESSION['email'] ?? '';
$name = $_SESSION['name'] ?? '';
$phone = $_SESSION['phone'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$username = $_SESSION['username'] ?? '';
$password = $_SESSION['password'] ?? '';
$alert = empty($email);
$errorMsg = "";
$conn = dbConnection();

// Check if there is an AJAX request for profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $data['action'] ?? '';

    if ($action) {
        $_SESSION['action'] = $action;
        $response = ['status' => 'success'];
        echo json_encode($response);
    } else {
        $response = ['status' => 'failed'];
        echo json_encode($response);
    }
    exit;
}

// Handle file upload separately
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $folder = '../images/' . $fileName;

    if (addProfilePic($username, $fileName)) {
        if (move_uploaded_file($fileTmpName, $folder)) {
            header("Location: profile.php");
        } else {
            // echo "Failed to upload image";
        }
    } else {
        echo "Failed to update profile picture in database";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #reSearch {
            margin-left: 90px;
            background-color: #E0E5E5;
            width: 300px;
        }

        #imageS {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            border: 1px solid #784464;
        }

        #icons1 {
            background-color: #784464;
            border-radius: 50%;
            scale: .9;
            color: white;
        }

        #icons2 {
            color: #784464;
            margin-top: 10px;
        }

        #btn {
            border: none;
            background-color: transparent;
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
                <li class="nav-item"></li>
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

    <div class="d-flex justify-content-center mt-4">
        <div class="position-relative" style="background-color:#784464;border-radius:10px">
            <form action="profile.php" method="POST" enctype="multipart/form-data">
                <?php
                $res = mysqli_query($conn, "select * from userinfo where username='$username'");
                $row = mysqli_fetch_assoc($res);
                $profilePic = $row['profilePic'];
                ?>
                <img src="../images/<?php echo $profilePic; ?>" id="imageS">
                <?php ?>
                <div class="">
                    <span class="text-center text-white p-2" style="font-size:13px" id="cngProfile">
                        Change Photo
                    </span>
                    <span class="text-white" style="font-size:15px"><input type="submit" name="submit" value="Save" style="background-color:transparent;border:none;color:white;"></span>
                </div>
                <input type="file" id="file" style="display:none" name="file">
            </form>
        </div>
    </div>

    <div class="container mt-4" style="background-color:#d7c7d1;width:400px">
        <div class="d-flex justify-content-between" id="carD">
            <div class="p-2">Name:</div>
            <div class="p-2"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></div>
            <button id="btn" onclick="openEmailModal('name')"><i id="icons2" class="fa-solid fa-pen-to-square"></i></button>
        </div>
    </div>
    <div class="container mt-2" style="background-color:#d7c7d1;width:400px">
        <div class="d-flex justify-content-between">
            <div class="p-2">Phone:</div>
            <div class="p-2"><?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></div>
            <button id="btn" onclick="openEmailModal('phone')"><i id="icons2" class="fa-solid fa-pen-to-square"></i></button>
        </div>
    </div>
    <div class="container mt-2" style="background-color:#d7c7d1;width:400px">
        <div class="d-flex justify-content-between">
            <div class="p-2">Email:</div>
            <div class="p-2" id="email"><?php echo empty($email) ? "You don't have any email" : htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></div>
            <button id="btn" onclick="openEmailModal('email')"><i id="icons2" class="fa-solid fa-pen-to-square"></i></button>
        </div>
    </div>
    <div class="container mt-2" style="background-color:#d7c7d1;width:400px">
        <div class="d-flex justify-content-between">
            <div class="p-2">Gender:</div>
            <div class="p-2"><?php echo htmlspecialchars($gender, ENT_QUOTES, 'UTF-8'); ?></div>
            <button id="btn" onclick="openEmailModal('gender')"><i id="icons2" class="fa-solid fa-pen-to-square"></i></button>
        </div>
    </div>
    <div class="container mt-2" style="background-color:#d7c7d1;width:400px">
        <div class="d-flex justify-content-between">
            <div class="p-2">Username:</div>
            <div class="p-2"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></div>
            <button id="btn" onclick="openEmailModal('username')"><i id="icons2" class="fa-solid fa-pen-to-square"></i></button>
        </div>
    </div>
    <div class="container mt-2" style="background-color:#d7c7d1;width:400px">
        <div class="d-flex justify-content-between">
            <div class="p-2">Password:</div>
            <div class="p-2"><?php echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8'); ?></div>
            <button id="btn" onclick="openEmailModal('password')"><i id="icons2" class="fa-solid fa-pen-to-square"></i></button>
        </div>
    </div>

    <!-- Edit Information Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="udValue" class="form-control" placeholder="Enter new value">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="p-2 border rounded" onclick="submitUpdate()" style="background-color:#784464;color:white">Save changes</button>
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

            var logoutBtn = document.getElementById("logout");
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    window.location.href = "login.php";
                });
            }

            // Show the alert modal if $alert is true
            <?php if ($alert): ?>
                var alertModalElement = document.getElementById('alertModal');
                if (alertModalElement) {
                    var myAlert = new bootstrap.Modal(alertModalElement);
                    myAlert.show();
                }
            <?php endif; ?>

            var cngProfile = document.getElementById("cngProfile");
            if (cngProfile) {
                cngProfile.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById("file").click();
                });
            }
        });

        function openEmailModal(action) {
            console.log("Opening modal for action:", action); // Debugging line

            // Set the action to the modal's data attribute
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            document.getElementById('editModal').setAttribute('data-action', action);

            // Show the modal
            editModal.show();
        }

        function submitUpdate() {
            var action = document.getElementById('editModal').getAttribute('data-action');
            var newValue = document.getElementById('udValue').value;
            console.log("Submitting update for action:", action, "with value:", newValue); // Debugging line
            var xml = new XMLHttpRequest();
            xml.onload = function() {
                try {
                    var response = JSON.parse(this.responseText);
                    if (response.status === 'success') {
                        alert("Profile Updated Successfully");
                        window.location.href = "profile.php";
                    } else {
                        alert("Failed to update profile: " + response.message);
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
            xml.setRequestHeader("X-Requested-With", "XMLHttpRequest");

            var body = JSON.stringify({
                "action": "update",
                "field": action,
                "value": newValue
            });

            console.log("Sending request with body:", body); // Debugging line
            xml.send(body);
        }
    </script>

</body>

</html>