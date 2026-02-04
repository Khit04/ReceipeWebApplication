<?php
session_start();
$isUserLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<style>
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

    .custom-border {
        border: 0.5px solid black;
    }

    .placeholder {
        font-size: 30px;
    }

    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(imgs/searchbg3.jpeg);
        background-size: cover;
    }

    body,html {
        height: 100%;
        margin: 0;
    }

    .card-img {
        border-radius: 30px;
        width: 100%;
    }
</style>

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
                <ul class="navbar-nav me-auto mb-1 mb-lg-0 mr-auto">
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

            </div>
        </div>
    </nav>

    <!-- Nav Bar Ends -->
    <div class="container-fluid mt-4">
        <!-- Search Bar -->
        <div class="row">
            <div class="col-12">
                <div class="input-group mb-3 justify-content-center">
                    <form class="d-flex col-6 p-1 bg-light custom-border rounded rounded-pill shadow-sm me-2" role="search">
                        <div class="input-group">
                            <input class="form-control rounded rounded-pill border-0 bg-light ui-widget" id="SearchForm" type="search" placeholder="Search Recipes Here ..." aria-label="Search">
                            <div class="input-group-append">
                                <button id="searchButton" type="submit" class="btn btn-link text-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filter Options -->
        <div class="row justify-content-center">
            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <select class="form-control" id="dietaryPreferences">
                    <option value="">All Dietary</option>
                    <option value="Vegetarian">Vegetarian</option>
                    <option value="Low-Carb">Low-Carb</option>
                    <option value="Vegan">Vegan</option>
                    <option value="Gluten-free">Gluten-Free</option>
                    <option value="Dairy-free">Dairy-Free</option>
                    <option value="Nut-free">Nut-Free</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <select class="form-control" id="mealTypes">
                    <option value="">All Meal Types</option>
                    <option value="Entry">Entry</option>
                    <option value="Starter">Starter</option>
                    <option value="Main">Main</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Dinner">Dinner</option>
                    <option value="Dessert">Dessert</option>
                </select>
            </div>

            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <select class="form-control" id="cuisineTypes">
                    <option value="">All Cuisines</option>
                    <option value="Italian">Italian</option>
                    <option value="Asian">Asian</option>
                    <option value="Mexican">Mexican</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Korean">Korean</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Thailand">Thailand</option>
                </select>
            </div>

            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <select class="form-control" id="difficultyLevels">
                    <option value="">All Difficulties</option>
                    <option value="Easy">Easy</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Hard">Hard</option>
                </select>
            </div>

            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <select class="form-control" id="prepareTime">
                    <option value="">All Preparation Times</option>
                    <option value="10">10 mins and above</option>
                    <option value="15">15 mins and avove</option>
                    <option value="25">25 mins and above</option>
                    <option value="30">30 mins and above</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="col-6 col-sm-4 col-md-2 mb-3">
                <select class="form-control" id="cookTime">
                    <option value="">All Cook Times</option>
                    <option value="15">15 mins and above</option>
                    <option value="25">25 mins and above</option>
                    <option value="30">30 mins and above</option>
                    <option value="60">60 mins and above</option>
                </select>
            </div>

            <div class="col-6 col-sm-4 col-md-2 mb-1">
                <select class="form-control" id="name">
                    <option value="">Select Sorting</option>
                    <option value="ascending">A-Z</option>
                    <option value="descending">Z-A</option>
                    <option value="rating">Highest Rating</option>
                </select>
            </div>

        </div>

    </div>

    <!-- Recipes Card Start -->
    <div id="searchResults"></div>
    <div id="noResult"></div>
    <script>
        $(document).ready(function() {
            $.ajax({
                    type: "GET",
                    url: "api/getAutocompleteData.php",
                })
                .done(function(response) {
                    var availableTags = Array.isArray(response) ? response.filter(item => item !== null && item !== undefined) : [];

                    $("#SearchForm").autocomplete({
                        source: availableTags
                    });
                })
                .fail(function(error) {
                    console.error("Error fetching autocomplete data:", error);
                });

            var urlSearchQuery = new URLSearchParams(window.location.search).get("q");
            console.log("URL Search query:", urlSearchQuery);

            if (urlSearchQuery) {
                fetchAndDisplayResults(urlSearchQuery);
            }

            $("form").on("submit", function(event) {
                event.preventDefault();
                var formSearchQuery = $("#SearchForm").val();
                fetchAndDisplayResults(formSearchQuery || urlSearchQuery);
            });

            function applyFilter() {
                var selectedDifficulty = $("#difficultyLevels").val();
                var selectedCuisine = $("#cuisineTypes").val();
                var selectedMealType = $("#mealTypes").val();
                var selectedDietary = $("#dietaryPreferences").val();
                var selectedPrepareTime = $("#prepareTime").val();
                var selectedCookTime = $("#cookTime").val();
                var formSearchQuery = $("#SearchForm").val();
                var selectedSorting = $("#name").val();
                fetchAndDisplayResults(formSearchQuery || urlSearchQuery, selectedDifficulty, selectedCuisine, selectedMealType, selectedDietary, selectedPrepareTime, selectedCookTime, selectedSorting);
            }

            $("#difficultyLevels, #cuisineTypes, #mealTypes, #dietaryPreferences, #prepareTime, #cookTime, #name").on("change", applyFilter);

            function fetchAndDisplayResults(searchQuery, difficulty, cuisine, mealType, dietary, prepareTime, cookTime, name) {
                $.ajax({
                        type: "POST",
                        url: "api/searchRecipeAPI.php",
                        data: {
                            searchQuery: searchQuery,
                            difficulty: difficulty,
                            cuisine: cuisine,  
                            mealType: mealType,
                            dietary: dietary,
                            prepareTime: prepareTime,
                            cookTime: cookTime,
                            name: name
                        },
                    })
                    .done(function(response) {
                        console.log("Raw Response from server:", response);
                        var jsonResponse = Array.isArray(response) ? response : JSON.parse(response);
                        console.log("Parsed JSON Response:", jsonResponse);
                        displaySearchResults(jsonResponse);
                    })
                    .fail(function(error) {
                        console.error("Error in AJAX request:", error);
                    });
            }

            function displaySearchResults(results) {
                $("#searchResults").empty();
                var cardContainerHtml = '<div class="container-fluid"><div id="search-card-container" class="row justify-content-center">';
                if (results.length > 0) {
                        for (var i = 0; i < results.length; i++) {
                        const filledStars = Math.round(results[i].average_rating);
                            const unfilledStars = 5 - filledStars;
                            const starIcons = `<div class="rating-got">
                                ${Array(filledStars).fill('<span class="star main_star text-warning"><i class="fas fa-star"></i></span>').join('')}
                                ${Array(unfilledStars).fill('<span class="star main_star unfilled-star"><i class="fas fa-star"></i></span>').join('')}
                            </div>`;
                        var cardHtml = `
                        <div class='col-lg-3 col-md-4 col-sm-6 col-9 my-2'>
                            <div class="card" style="border-radius: 30px;">
                                <div class="row p-1">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center position-relative">
                                        <img src="${results[i].img_path}" class="card-img">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">${results[i].name}</h5>
                                                    <div class="col-12 text-center d-flex align-items-center justify-content-center">
                                                        ${starIcons} 
                                                        <p class="mx-3 mb-0 fw-bold" id="total_review">${results[i].total_reviews}</p>
                                                        <div class="fw-bold">
                                                            <p class="mb-0">ratings</p>
                                                        </div>
                                                    </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 col-md-6">
                                                    <p class="text-center" id="meal_type"><strong>Category<br></strong>${results[i].meal_type}</p>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p class="text-center" id="dietary"><strong>Dietary</strong><br>${results[i].dietary}</p>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <a href="recipe.php?id=${results[i].id}" class="btn btn-primary rounded-pill">
                                                    See Details <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                        cardContainerHtml += cardHtml;
                    }

                    cardContainerHtml += '</div></div>';

                    $("#searchResults").append(cardContainerHtml);
                } else {
                    $("#noResult").html('<p>No recipes found.</p></div>').css({
                        fontSize: '20px',
                        margin: '10% auto', 
                        textAlign: 'center',
                        color : 'red',
                        backgroundColor: 'white'
                    });
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>