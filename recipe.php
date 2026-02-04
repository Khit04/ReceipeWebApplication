<?php
session_start();
$isUserLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: whitesmoke;
        }

        .recipe-title {
            font-size: 2em;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 20px;
        }

        .recipe-photo {
            max-width: 100%;
            height: auto;
            border-radius: 30px;
            box-shadow: 1px 1px 2px white;
        }

        .recipe-description {
            margin-top: 20px;
            color: black;
        }

        .recipe-ingredients {
            margin-top: 20px;
            color: black;
        }

        .recipe-details {
            margin-top: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .detail-item i {
            margin-right: 10px;
            color: #6c757d;
        }

        .category-label,
        .difficulty-label,
        .dietary-label,
        .serving-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .instruction-container {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 1px 1px 2px black;
            align-items: center;
        }

        .no-underline {
            text-decoration: none !important;
        }

        .recipe-details p {
            background: linear-gradient(145deg, #e6e6e6, #ffffff);
            border-radius: 10px;
            padding: 10px;
            box-shadow: 1px 1px 2px black;
        }

        :root {
            --yellow: #FFBD13;
            --blue: #4383FF;
            --blue-d-1: #3278FF;
            --light: #F5F5F5;
            --grey: #AAA;
            --white: #FFF;
            --shadow: 8px 8px 30px rgba(0, 0, 0, .05);
        }

        .wrapper {
            background: var(--white);
            padding: 2rem;
            max-width: 576px;
            width: 100%;
            border-radius: 30px;
            box-shadow: 1px 1px 2px black;
            text-align: center;
            margin: 0 auto;
        }

        .wrapper h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: .5rem;
            font-size: 2rem;
            color: var(--yellow);
            margin-bottom: 2rem;
        }

        .rating .star {
            cursor: pointer;
        }

        .rating .star.active {
            opacity: 0;
            animation: animate .5s calc(var(--i) * .1s) ease-in-out forwards;
        }

        @keyframes animate {
            0% {
                opacity: 0;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .rating .star:hover {
            transform: scale(1.1);
        }

        textarea {
            width: 100%;
            background: var(--light);
            padding: 1rem;
            border-radius: .5rem;
            border: none;
            outline: none;
            resize: none;
            margin-bottom: .5rem;
        }

        .btn-group {
            display: flex;
            gap: .5rem;
            align-items: center;
        }

        .btn-group .btn {
            padding: .75rem 1rem;
            border-radius: .5rem;
            cursor: pointer;
            font-size: .875rem;
            font-weight: 500;
        }

        .btn-group .btn.submit {
            background: var(--blue);
            color: var(--white);
        }

        .btn-group .btn.submit:hover {
            background: var(--blue-d-1);
        }

        .btn-group .btn.cancel {
            background: var(--white);
            color: var(--blue);
        }

        .btn-group .btn.cancel:hover {
            background: var(--light);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="imgs/logo3.png" width="55" height="55" alt="">
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

                <div class="profile-container" id="profile-container">

                    <?php if ($isUserLoggedIn) : ?>
                        <a class="btn text-light" href="userProfile.php"><i class="fas fa-user-circle" style="font-size: 2rem;"></i></a>
                    <?php endif; ?>

                </div>

                <?php if ($isUserLoggedIn) : ?>
                    <a class="btn btn-outline-danger my-4 my-sm-0 mx-2 rounded rounded-pill" data-toggle="tooltip" data-placement="top" href="logout.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
                <?php else : ?>
                    <a class="btn btn-outline-info my-4 my-sm-0 mx-2 rounded rounded-pill" data-toggle="tooltip" data-placement="top" href="login.php">Log In <i class="fas fa-sign-in-alt"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-2 p-3">
        <!-- Recipe Title Row -->
        <div class="row">
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a class="btn btn-light fw-bold fa-xl" href="searchRecipe.php">
                            <i class="fas fa-arrow-left"></i>
                        </a> Back
                    </div>
                    <div class="col">
                        <h1 class="recipe-title text-center" id="name">Shrimp Noodle</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipe Photo and Description Row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="row">
                    <div class="col-xl-12"><img src="imgs/food/recipe1.jpeg" alt="Recipe Photo" class="recipe-photo" id="img_path"></div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 text-center d-flex align-items-center justify-content-center">
                        <div class="rating-got">
                            <span class="star main_star"><i class="fas fa-star"></i></span>
                            <span class="star main_star"><i class="fas fa-star"></i></span>
                            <span class="star main_star"><i class="fas fa-star"></i></span>
                            <span class="star main_star"><i class="fas fa-star"></i></span>
                            <span class="star main_star"><i class="fas fa-star"></i></span>
                        </div>
                        <p class="mx-3 mb-0 fw-bold" id="total_review">0</p>
                        <div class="fw-bold">
                            <p class="mb-0">ratings</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-2 align-items-center">
                        <div class="btn-group" role="group" aria-label="Action Buttons">
                            <button type="button" class="btn btn-primary" id="add_review"><i class="fas fa-star"></i> Rate</button>
                            <button type="button" class="btn btn-success" id="favorite"><i class="fas fa-heart"></i> Save </button>
                            <button type="button" class="btn btn-info"><i class="fas fa-share"></i> Share</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Box -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">Please Log In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Please log in before saving.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- First Column Ends -->
            <div class="col-lg-5 col-md-6">

                <div class="row">
                    <div class="col-12 mt-2 d-flex align-items-center">
                        <img src="imgs/logo3.png" alt="Profile" class="profile-image">
                        <label for="owner" class="mx-2 fw-bold">Created by </label>
                        <a href="#" class="no-underline fw-bold">Marco</a>
                    </div>
                </div>

                <div class="row">
                    <div class="recipe-description">
                        <h5 class="fw-bold">Description</h5>
                        <p style="text-align: justify;" id="description"></p>
                    </div>
                </div>

                <div class="row recipe-details mx-3">
                    <div class="col-6 col-md-4">
                        <p class="text-center" id="prepare_time"><strong>Prepare <i class="fas fa-clock"></i> <br></strong>15</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p class="text-center" id="cook_time"><strong>Cook <i class="fas fa-fire"></i></strong><br>30</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p class="text-center" id="difficulty"><strong>Difficulty <i class="fas fa-star"></i></strong><br>Normal</p>
                    </div>
                </div>

                <div class="row recipe-details mx-3">
                    <div class="col-6 col-md-4">
                        <p class="text-center" id="meal_type"><strong>Category <i class="fas fa-utensils"></i> <br></strong>Lunch</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p class="text-center" id="dietary"><strong>Dietary <i class="fas fa-leaf"></i></strong><br>Hybrid</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p class="text-center" id="cuisine"><strong>Cuisine <i class="fas fa-earth"></i></strong><br></p>
                    </div>
                </div>
            </div>
            <!-- Second Column Ends -->
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <div class="recipe-ingredients">
                            <h5 class="fw-bold text-center">Ingredients</h5>

                            <div id="ingredientsContainer" class="list-group">
                                <ul></ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Ingredients Section Ends -->

            <div class="row mt-3 instruction-container mb-3 mx-auto justify-content-center">
                <div class="col-8">
                    <h5 class="fw-bold text-center mb-3">Instructions</h5>
                    <div id="instructions-container"></div>
                </div>

                <div class="col-4">
                    <div class="row">
                        <img src="imgs/food/instruction.png" alt="" style="width: 100%;">
                    </div>
                </div>
            </div>

            <!-- Star Rating -->
            <?php
            include 'rating.php';
            ?>
        </div>
    </div>
    <footer class="bg-dark text-light py-3 mt-2">
        <div class="container text-center">
            <p class="mb-0">&copy; 2023 MarcoHub Inc. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            $('#favorite').on('click', function() {
                <?php if ($isUserLoggedIn) : ?>
                    $.ajax({
                        method: 'POST',
                        url: 'api/checkAPI.php',
                        data: {},
                        success: function(response) {
                            console.log('Save successful');
                        },
                        error: function() {
                            console.log('AJAX request failed');
                        }
                    });
                <?php else : ?>
                    $('#loginModal').modal('show');
                <?php endif; ?>
            });
        });

        $(document).ready(function() {
            var recipeId = new URLSearchParams(window.location.search).get('id');
            $.ajax({
                type: 'POST',
                url: 'api/recipeDetailAPI.php',
                data: {
                    recipeId: recipeId
                },
                dataType: 'json',
                success: function(response) {
                    console.log("Raw Response from server:", response);
                    displayRecipeDetails(response);
                },
                error: function(error) {
                    console.error('Error in AJAX request:', error);
                }
            });

            function displayRecipeDetails(response) {
                $('#img_path').attr('src', response.img_path); // Update the image source
                $('#description').text(response.description);
                $('#name').text(response.name);
                $('#prepare_time').html('<strong>Prepare <i class="fas fa-clock"></i><br></strong>' + response.prepare_time + ' mins');
                $('#cook_time').html('<strong>Cook <i class="fas fa-fire"></i></strong><br>' + response.cook_time + ' mins');
                $('#difficulty').html('<strong>Difficulty <i class="fas fa-star"></i></strong><br>' + response.difficulty);
                $('#meal_type').html('<strong>Category <i class="fas fa-utensils"></i><br></strong>' + response.meal_type);
                $('#dietary').html('<strong>Dietary <i class="fas fa-leaf"></i></strong><br>' + response.dietary);
                $('#cuisine').html('<strong>Cuisine <i class="fas fa-earth"></i></strong><br>' + response.cuisine);
            }
        });

        function fetchInstructions(recipeId) {
            $.ajax({
                type: 'POST',  
                url: 'api/getInstructionAPI.php',
                data: { recipeId: recipeId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        displayInstructions(response.instructions);
                    } else {
                        console.error('Failed to fetch instructions.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching instructions:', status, error);
                }
            });
        }

        function displayInstructions(instructions) {
        var instructionsContainer = $('#instructions-container');
        instructionsContainer.empty();

        if (instructions.length > 0) {
            instructions.forEach(function(instruction, index) {
                var stepNumber = index + 1;
                var stepHtml = `
                    <div class="row align-items-center">
                        <div class="col-12 d-flex">
                            <p class="fw-bold text-center text-primary me-3">Step ${stepNumber}</p>
                            <hr class="flex-grow-1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex align-items-center">
                            <p>${instruction.description}</p>
                        </div>
                    </div>
                `;

                instructionsContainer.append(stepHtml);
            });
        } else {
            instructionsContainer.text('No instructions available.');
        }
    }

        function fetchIngredients(recipeId) {
            $.ajax({
                url: 'api/getIngredientAPI.php',
                type: 'POST',
                data: { recipeId: recipeId },
                dataType: 'json',
                success: function (response) {
                    displayIngredients(response);
                },
                error: function (error) {
                    console.error('Error fetching ingredients:', error);
                }
            });
        }

        function displayIngredients(ingredients) {
            var ingredientsList = $('#ingredientsContainer ul');
            ingredientsList.empty();

            ingredients.forEach(function(ingredient, index) {
                var checkboxId = 'ingredient' + (index + 1);
                var listItem = $('<li class="list-group-item d-flex align-items-center">');
                var checkbox = $('<div class="form-check">').append(
                    $('<input class="form-check-input" type="checkbox" id="' + checkboxId + '" onchange="toggleIngredient(this)">'),
                    $('<label class="form-check-label flex-grow-1" for="' + checkboxId + '">').text(ingredient.name)
                );
                listItem.append(checkbox);
                ingredientsList.append(listItem);
            });
        }


        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var recipeId = urlParams.get('id');

            if (recipeId) {
                fetchIngredients(recipeId);
                fetchInstructions(recipeId);
            } else {
                console.error('Recipe ID not found in the URL.');
            }
        });

        $(document).ready(function() {
            $('#favorite').click(function() {
                var urlParams = new URLSearchParams(window.location.search);
                var recipe_id = urlParams.get('id');
                var userId = 1;

                $.ajax({
                    url: 'api/favoriteAPI.php',
                    method: 'POST',
                    data: {
                        action: 'save_favorite',
                        userId: userId,
                        recipe_id: recipe_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            alert('Recipe saved to favorites!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('You have already saved this recipe.');
                    }
                });
            });
        });

        function toggleIngredient(checkbox) {
            const listItem = checkbox.closest('.list-group-item');

            if (listItem) {
                const isDisabled = checkbox.checked;
                const label = listItem.querySelector('.form-check-label');
                label.style.textDecoration = isDisabled ? 'line-through' : 'none';
            } else {
                console.error('Error: Unable to find closest .list-group-item.');
            }
        }
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/4e28e1f29c.js" crossorigin="anonymous"></script>
</body>

</html>