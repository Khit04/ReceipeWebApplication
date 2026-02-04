<?php
session_start();
$userRole = isset($_SESSION['userRole']) ? $_SESSION['userRole'] : '';
$isChef = ($userRole === 'chef');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        body {
            background-image: url(imgs/food/pbg.jpeg);
            font-family: 'Poppins', sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .custom-font {
            font-family: 'Poppins', sans-serif;
        }

        .user-box {
            padding: 10px;
            border-radius: 30px;
            background: linear-gradient(145deg, #ececec, #ffffff);
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
            transition: 0.2s cubic-bezier(0.22, 0.78, 0.45, 1.02);
        }

        .fav-recipe-container {
            padding: 10px;
            border-radius: 30px;
            background: linear-gradient(145deg, #ececec, #ffffff);
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
            transition: 0.2s cubic-bezier(0.22, 0.78, 0.45, 1.02);
        }

        .card {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
            transition: 0.2s cubic-bezier(0.22, 0.78, 0.45, 1.02);
        }

        .navbar-nav .nav-link {
            color: white;
            border-bottom: 2px solid transparent;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
            border-bottom-color: #007bff;
        }

        .navbar-nav .nav-link.active {
            color: #007bff;
            border-bottom-color: #007bff;
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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php#trend-container">Latest</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php#chef-section">Chefs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php#services">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact-us">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile container-fluid p-3">
        <div class="row mx-auto text-center">
            <h2 class="col-md-12 mt-3">Profile</h2>
        </div>

        <div id="profile-container" class="row">
            <div class='col-md-5 my-2'>
                <div class="user-box text-center">
                    <h3 class="h3-user mt-3">Profile Details</h3>
                    <div class="row">
                        <div class="mx-auto mt-3 mb-3" id="profile" style="background-image: url(imgs/chef/user1.jpeg); width:200px; height:200px; border-radius:50% ;background-size:cover"></div>
                    </div>

                    <h3 class="h3-user" id="username"></h3>

                    <div class="d-inline-flex justify-content-center">
                        <i class="fas fa-user mx-2 mt-1"></i>
                        <p id="role"></p>
                    </div><br>

                    <div class="d-inline-flex justify-content-center">
                        <i class="fas fa-envelope mx-2 mt-1"></i>
                        <p class="" id="email"></p>
                    </div>

                    <div class="d-flex justify-content-center mb-2">
                        <a class="btn btn-primary my-4 my-sm-0 mx-2 text-light" id="anotherButton" data-toggle="tooltip" data-placement="top">Edit Profile <i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger my-4 my-sm-0 mx-2 text-light" data-toggle="tooltip" data-placement="top" href="logout.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </div>
            </div>
            <!-- Left Container Ends -->

            <div class="col-md-7 my-2 fav-recipe-container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-user"></i> Profile Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="profile" aria-selected="false"> <i class="fas fa-key"></i> Change Password</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"> <i class="fas fa-heart"></i> Saved Recipes</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <?php if ($isChef) : ?>
                            <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#recipe" type="button" role="tab" aria-controls="recipe" aria-selected="false">
                                <i class="fas fa-plus"></i> Add Recipes
                            </button>
                        <?php endif; ?>
                    </li>
                </ul>

                <!-- Edit User Info -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row p-3">
                            <div class="mb-2">
                                <label for="username" class="form-label fw-bold">Edit Username</label>
                                <input type="text" class="form-control p2" id="name" aria-describedby="emailHelp" placeholder="Enter Username">
                                <div id="username-error" class="text-danger"></div>
                            </div>

                            <div class="mb-2">
                                <label for="email" class="form-label fw-bold">Edit Email address</label>
                                <input type="email" class="form-control p2" id="femail" aria-describedby="emailHelp" placeholder="Enter Email">
                                <div id="email-error" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <label for="userType" class="form-label fw-bold">User Type</label>
                                <select class="form-select" name="user_type" id="user_type">
                                    <option selected>Select user type</option>
                                    <option value="customer">customer</option>
                                    <option value="chef">chef</option>
                                </select>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="button" class="btn btn-dark" id="updateButton">Update</button>
                                <a href="userProfile.php" class="btn btn-danger ms-2">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Info Ends -->
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row p-3">
                            <div class="mb-2">
                                <label for="password" class="form-label fw-bold">Old Password</label>
                                <input type="password" class="form-control" id="oldPassword" placeholder="Enter Old Password">
                                <div id="old-password-error" class="text-danger"></div>
                            </div>
                            <div class="mb-2">
                                <label for="newPassword" class="form-label fw-bold">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="newPassword" placeholder="Enter New Password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                            <i id="newPasswordIcon" class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="new-password-error" class="text-danger"></div>
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
                                <div id="confirm-password-error" class="text-danger"></div>
                            </div>

                            <div class="mb-3 text-center mt-3">
                                <button type="submit" class="btn btn-dark">Update</button>
                                <a href="chefProfile.php" class="btn btn-danger ms-2">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- forgetPassword Ends -->

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div id="favorite-card-container" class="row">
                            <!-- Fav Cards -->
                        </div>
                    </div>


                    <div class="tab-pane fade" id="recipe" role="tabpanel" aria-labelledby="add-tab">
                        <div id="add-recipe-container" class="row">

                            <div class="col-md-12 col-xl-12 mr-4 mb-sm-4 transparent-bg">
                                <form class="g-3 p-3">
                                    <div class="row text-center mb-3">
                                        <h3 class="fw-bold">Create Recipes</h3><br>
                                    </div>

                                    <div class="row">
                                        <div class="mb-2 col-md-6">
                                            <label for="chefname" class="form-label fw-bold">Chefname</label>
                                            <input type="text" class="form-control p-2" id="chefname" aria-describedby="chefname-error" placeholder="Chefname">
                                            <div id="chefname-error"></div>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="recipe-name" class="form-label fw-bold">Recipe Name</label>
                                            <input type="text" class="form-control p-2" id="recipe-name" placeholder="Recipe Name">
                                        </div>

                                        <div class="mb-2 col-md-12">
                                            <label for="description" class="form-label fw-bold">Description</label>
                                            <textarea class="form-control p-2" id="description" rows="4" placeholder="Description"></textarea>
                                        </div>

                                        <div class="mb-2 col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="prepare-time" class="form-label fw-bold">Prepare Time</label>
                                                    <input type="text" class="form-control p-2" id="prepare-time" placeholder="Prepare Time">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cook-time" class="form-label fw-bold">Cook Time</label>
                                                    <input type="text" class="form-control p-2" id="cook-time" placeholder="Cook Time">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="meal-type" class="form-label fw-bold">Meal Type</label>
                                            <select class="form-select p-2" id="meal-type">
                                                <option value="" selected disabled>Select Meal Type</option>
                                                <option value="entry">Entry</option>
                                                <option value="starter">Starter</option>
                                                <option value="main">Main</option>
                                                <option value="breakfast">Breakfast</option>
                                                <option value="lunch">Lunch</option>
                                                <option value="dinner">Dinner</option>
                                            </select>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="cuisine" class="form-label fw-bold">Cuisine</label>
                                            <select class="form-select p-2" id="cuisine">
                                                <option value="" selected disabled>Select Cuisine</option>
                                                <option value="indian">Indian</option>
                                                <option value="asian">Asian</option>
                                                <option value="japanese">Japanese</option>
                                                <option value="american">American</option>
                                                <option value="mexican">Mexican</option>
                                                <option value="korean">Korean</option>
                                            </select>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="cook-method" class="form-label fw-bold">Cook Method</label>
                                            <input type="text" class="form-control p-2" id="cook-method" placeholder="Cook Method">
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="ingredient-focus" class="form-label fw-bold">Ingredient Focus</label>
                                            <input type="text" class="form-control p-2" id="ingredient-focus" placeholder="Ingredient Focus">
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="difficulty-level" class="form-label fw-bold">Difficulty Level</label>
                                            <select class="form-select p-2" id="difficulty-level">
                                                <option value="" selected disabled>Select Difficulty Level</option>
                                                <option value="easy">Easy</option>
                                                <option value="medium">Intermediate</option>
                                                <option value="hard">Hard</option>
                                            </select>
                                        </div>

                                        <div class="mb-2 col-md-6">
                                            <label for="serve-person" class="form-label fw-bold">Serve Person</label>
                                            <input type="number" class="form-control p-2" id="serve-person" placeholder="Server Person">
                                        </div>

                                        <div class="mb-3 mt-3 text-center col-12">
                                            <button type="submit" class="btn btn-dark" id="create-btn">Create</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Change Password
        $(document).ready(function() {
            $('button[type="submit"]').click(function() {
                var oldPassword = $('#oldPassword').val();
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();

                $('#old-password-error').html('');
                $('#new-password-error').html('');
                $('#confirm-password-error').html('');

                if (oldPassword === '' || newPassword === '' || confirmPassword === '') {
                    alert('Please fill in all fields');
                    return;
                }

                var passV = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
                if (!passV.test(newPassword)) {
                    $('#new-password-error').html('Password must be 7-15 characters long and include at least one number and one special character.');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    $('#confirm-password-error').html('Passwords do not match');
                    return;
                }

                $.ajax({
                    url: 'api/changePasswordAPI.php',
                    type: 'POST',
                    data: {
                        oldPassword: oldPassword,
                        newPassword: newPassword,
                        confirmPassword: confirmPassword
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.success) {
                            alert('Password updated successfully');
                        } else {
                            $('#old-password-error').html(response.message);
                        }
                    },
                    error: function() {
                        alert('Error occurred while processing your request');
                    }
                });
            });
        });

        // Fetch User Left Profile
        $(document).ready(function() {
            var userId = 1;
            $.ajax({
                type: "POST",
                url: "api/userProfileAPI.php",
                data: {
                    userId: userId
                },
                dataType: "json",
                success: function(response) {
                    displayProfileResult(response);
                },
                error: function(error) {
                    console.error("Error in AJAX request:", error);
                }
            });

            function displayProfileResult(response) {
                $("#username").text(response.username);
                $("#role").text(response.role);
                $("#email").text(response.email);
            }
        });

        // Fetch Data For Input Field
        $(document).ready(function() {
            var userId = 1;

            function fetchUserData() {
                $.ajax({
                    type: "POST",
                    url: "api/userProfileAPI.php",
                    data: {
                        userId: userId
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#name").val(response.username);
                        $("#femail").val(response.email);
                        $("#user_type").val(response.role);
                    },
                    error: function(error) {
                        console.error("Error in AJAX request:", error);
                    }
                });
            }
            fetchUserData();

            // Update User Info
            $("#updateButton").on("click", function(event) {
                event.preventDefault();

                var name = $("#name").val();
                var email = $("#femail").val();
                var user_type = $("#user_type").val();

                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        $('#email-error').html('Please enter a valid email address.');
                        return;
                    }

                $.ajax({
                    type: "POST",
                    url: "api/updateProfileAPI.php",
                    data: {
                        user_id: userId,
                        username: name,
                        email: email,
                        user_type: user_type
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            alert('User Info Successfully Updated');
                        } else {
                            if (response.error === 'Email is already taken') {
                                $('#email-error').html(response.error);
                            } else if (response.error === 'username_contains_numbers') {
                                $('#username-error').html('Username cannot contain numbers.');
                            }
                        }
                        fetchUserData();
                    }
                });
            });
        });

        // Get User Favs
        $(document).ready(function() {
            $.ajax({
                url: 'api/favoriteAPI.php',
                method: 'POST',
                data: {
                    action: 'get_favorite_items'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var cardContainer = $('#favorite-card-container');

                        response.favorite_items.forEach(function(item) {
                            console.log(item.id);
                            var cardHTML = `
                            <div class='col-lg-4 col-md-6 col-sm-6 my-2'>
                                <div class="card" style="border-radius: 30px;">
                                    <div class="row p-1">
                                        <div class="col-md-12 d-flex justify-content-center align-items-center position-relative">
                                            <img src="${item.img_path}" class="card-img-top" alt="..." style="border-radius: 30px; width: 100%;">
                                            <button class="delete-button btn btn-light text-danger rounded-circle position-absolute top-0 end-0" data-item-id="${item.id}">
                                                <i class="fas fa-times"></i> 
                                            </button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <h5 class="card-title text-center" id="name">${item.name}</h5>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6 col-md-6">
                                                        <p class="text-center" id="meal_type"><strong>Category<br></strong>${item.meal_type}</p>
                                                    </div>
                                                    <div class="col-6 col-md-6">
                                                        <p class="text-center" id="dietary"><strong>Dietary</strong><br>${item.dietary}</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6 col-md-6">
                                                        <p class="text-center" id="cook_time"><strong>Cook <i class="fas fa-clock"></i> <br></strong>${item.cook_time} mins</p>
                                                    </div>
                                                    <div class="col-6 col-md-6">
                                                        <p class="text-center" id="serve_person"><strong>Serve <i class="fas fa-users"></i></strong><br>${item.serve_person} Persons</p>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <a href="recipe.php?id=${item.id}" class="btn btn-primary rounded-pill">
                                                        See Details <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            cardContainer.append(cardHTML);
                        });
                    } else {
                        console.error('Error fetching favorite items');
                    }
                },
                error: function() {
                    console.error('Error fetching favorite items');
                }
            });
        });

        $('#favorite-card-container').on('click', '.delete-button', function() {
            var recipeId = $(this).data('item-id');
            console.log('Recipe ID:', recipeId);
            var $clickedIcon = $(this); 
            $.ajax({
                method: 'POST',
                url: 'api/removeRecipeAPI.php', 
                data: {
                    recipeId: recipeId
                },
                success: function(response) {
                    console.log(response); 
                    $clickedIcon.closest('.col-lg-4').remove();
                },
                error: function() {
                    console.log('AJAX request failed');
                }
            });
        });


        document.getElementById('anotherButton').addEventListener('click', function() {
            var profileInfoButton = document.getElementById('home-tab');
            var bootstrapTab = new bootstrap.Tab(profileInfoButton);
            bootstrapTab.show();
        });

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('newPassword');
            var passwordIcon = document.getElementById('newPasswordIcon');

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

        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            togglePasswordVisibility();
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            toggleConfirmPasswordVisibility();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>