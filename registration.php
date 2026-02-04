<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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

        #username-error, #email-error, #password-error, #confirmPassword-error, #role-error {
            color: red;
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
        <div class="row justify-content-end mt-3 p-4">
            <div class="col-md-7 col-xl-6 mr-4 mb-sm-4 transparent-bg">
                <form class="g-3 p-3">
                    <div class="row text-center mb-4">
                        <h3 class="fw-bold">Register Here</h3><br>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control p2" id="username" aria-describedby="emailHelp" placeholder="Username">
                            <div id="username-error"></div>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label fw-bold">Email address</label>
                            <input type="email" class="form-control p2" id="email" aria-describedby="emailHelp" placeholder="Email">
                            <div id="email-error"></div>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i id="passwordIcon" class="fa fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="password-error"></div>
                        </div>
                        <div class="mb-2">
                            <label for="confirmPassword" class="form-label fw-bold">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i id="confirmPasswordIcon" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="confirmPassword-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="userType" class="form-label fw-bold">Select User Type</label>
                            <select class="form-select" name="role" id="role">
                                <option selected>Select user type</option>
                                <option value="chef">chef</option>
                                <option value="customer">customer</option>
                            </select>
                            <div id="role-error"></div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark" id="register-btn">Register</button>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col text-center">
                            <p class="mb-0 fw-bold">Do you have an account?</p>
                            <p class="mt-0 mb-0 fw-bold"><a href="login.php">Login Here!</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#register-btn').click(function(e) {
                e.preventDefault();

                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var cPassword = $('#confirmPassword').val();
                var role = $('#role').val();

                $('#username-error, #email-error, #password-error, #confirmPassword-error, #role-error').html('');

                if (username.trim() === '') {
                    $('#username-error').html('Please enter your username');
                    return;
                }


                if (/\s/.test(username)) {
                    $('#username-error').html('Username cannot contain spaces');
                    return;
                }

                if (!/^[a-zA-Z]+$/.test(username)) {
                    $('#username-error').html('Username must contain only characters');
                    return;
                }


                if (email.trim() === '') {
                    $('#email-error').html('Please enter your email address');
                    return;
                }

                if (!/\S+@\S+\.\S+/.test(email)) {
                    $('#email-error').html('Please enter a valid email address');
                    return;
                }

                if (password.trim() === '') {
                    $('#password-error').html('Please enter your password');
                    return;
                }

                var passV = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;

                if (!passV.test(password)) {
                    $('#password-error').html('Password must contain at least one digit and one special character, and be 7-15 characters long');
                    return;
                }

                if (cPassword.trim() === '') {
                    $('#confirmPassword-error').html('Please confirm your password');
                    return;
                }

                if (cPassword !== password) {
                    $('#confirmPassword-error').html('Passwords do not match');
                    return;
                }

                if (role === 'Select user type') {
                    $('#role-error').html('Please select a user type');
                    return;
                }

                var formData = new FormData();
                formData.append('username', username);
                formData.append('email', email);
                formData.append('pass', password);
                formData.append('role', role);

                $.ajax({
                    method: "POST",
                    url: "api/registerAPI.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(msg) {
                        if (msg === 'Success') {
                            window.location.href = "login.php";
                        } else if (msg === 'Already Registered') {
                            $('#email-error').html('This email is already registered');
                        } else {
                            alert("Unable to register!");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("Error:", errorThrown);
                        alert("An error occurred during the request.");
                    }
                });
            });
        });


        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        }

        function toggleConfirmPasswordVisibility() {
            var confirmPasswordInput = document.getElementById('confirmPassword');
            var confirmPasswordIcon = document.getElementById('confirmPasswordIcon');
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                confirmPasswordIcon.classList.remove('fa-eye-slash');
                confirmPasswordIcon.classList.add('fa-eye');
            } else {
                confirmPasswordInput.type = 'password';
                confirmPasswordIcon.classList.remove('fa-eye');
                confirmPasswordIcon.classList.add('fa-eye-slash');
            }
        }

        document.getElementById('togglePassword').addEventListener('click', function() {
            togglePasswordVisibility();
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            toggleConfirmPasswordVisibility();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


</html>