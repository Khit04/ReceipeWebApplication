<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('imgs/login4.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .transparent-bg {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 1px 1px 2px black;
        }

        #login-error {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="imgs/logo3.png" width="50" height="50" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#trend-container">Latest</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#chef-section">Chefs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#services">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-end mt-5 align-items-center p-3">
            <div class="col-md-7 col-xl-6 mt-3 mr-4 mb-4 mb-sm-4 transparent-bg">
                <form class="g-3 p-3">
                    <div class="row text-center mb-4">
                        <h3 class="fw-bold">Sign In to Marco's Kitchen</h3><br>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email address or Username</label>
                            <input type="email" class="form-control p2" id="email" aria-describedby="emailHelp" placeholder="Email" required>
                            <div class="text-danger" id="email-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                            <div class="text-danger" id="password-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="userType" class="form-label fw-bold">Select User Type</label>
                            <select class="form-select" name="role" id="role">
                                <option selected>Select user type</option>
                                <option value="chef">chef</option>
                                <option value="customer">customer</option>
                            </select>
                        </div>
                        <div class="text-danger" id="role-error"></div>
                        <div class="text-danger" id="login-error"></div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark" id="login-btn">Login</button>
                        </div>
                        
                    </div>

                    <div class="row mt-2">
                        <div class="col text-center">
                            <p class="mb-0 fw-bold">New here?</p>
                            <p class="mt-0 fw-bold"><a href="registration.php">Create an account !</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#login-btn').click(function(e) {
                e.preventDefault();

                var emailOrUsername = $('#email').val();
                var password = $('#password').val();
                var role = $('#role').val();

             
                if (emailOrUsername.trim() === '') {
                    $('#email-error').html('Please enter your email address or username');
                    return;
                }

                if (password.trim() === '') {
                    $('#password-error').html('Please enter your password');
                    return;
                }

                if (role === "Select user type") {
                    $('#role-error').html("Please select a user type.");
                    return; 
                } else {
                    $('#role-error').html(""); 
                }

                $.ajax({
                    method: "POST",
                    url: "api/loginAPI.php",
                    data: {
                        usernameOrEmail: emailOrUsername,
                        password: password,
                        role: role
                    },
                    success: function(response) {
                        var result = JSON.parse(response);

                        if (result.success) {
                            if (result.role === 'chef') {
                                window.location.href = "index.php";
                            } else if (result.role === 'customer') {
                                window.location.href = "index.php";
                            }
                        } else {
                            if (result.error === 'not_found') {
                                $('#login-error').html("User not found. Please check your email or username.");
                            } else if (result.error === 'incorrect_password') {
                                $('#login-error').html("Incorrect password. Please try again.");
                            } else if (result.error === 'incorrect_role') {
                                $('#login-error').html("This account is not registered");
                            } else {
                                $('#login-error').html("An error occurred during login.");
                            }
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("Error:", errorThrown);
                        alert("An error occurred during the login request.");
                    }
                });
            });
        });

        document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var toggleButton = document.getElementById('togglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
        } else {
            passwordInput.type = 'password';
            toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>