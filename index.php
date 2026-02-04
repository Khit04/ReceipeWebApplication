<?php
session_start();
$isUserLoggedIn = isset($_SESSION['user_id']);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marco's Kitchen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="style.css">

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

        .home {
            width: 100%;
            height: 90vh auto;
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)), url(imgs/indexbg.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .larger-text {
            font-size: 1.8em;
        }

        .home .content {
            text-align: center;
            padding-top: 200px;
        }

        .home .content h5 {
            color: white;
            font-size: 38px;
            font-weight: 550;
            text-shadow: 0px 2px 2px black;
        }

        .home .content h1 {
            color: white;
            font-size: 70px;
            font-weight: 550;
            text-shadow: 0px 3px 3px black;
            margin-top: 5px;
        }

        .changecontent::after {
            content: ' ';
            color: aqua;
            text-shadow: 0px 3px 3px black;
            animation: changetext 10s infinite linear;
        }


        @keyframes changetext {
            0% {
                content: "Italian Recipes";
            }

            20% {
                content: "Asian Cuisine";
            }

            40% {
                content: "Dessert Delights";
            }

            60% {
                content: "Grilled Specialties";
            }

            80% {
                content: "Breakfast";
            }

            100% {
                content: "Worldly Flavors";
            }
        }

        .home .content p {
            color: whitesmoke;
            font-size: 15px;
            font-weight: 600;
            text-shadow: 0px 2px 2px black;
            margin-bottom: 40px;
        }

        .home .content a {
            padding: 10px;
            background-image: radial-gradient(circle at 10% 20%, rgb(255, 200, 124) 0%, rgb(252, 251, 121) 90%);
            color: black;
            letter-spacing: 2px;
            font-weight: 550;
            border-radius: 5px;
            text-decoration: none;
            box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px, rgba(0, 0, 0, .14) 0 6px 10px 0, rgba(0, 0, 0, .12) 0 1px 18px 0;
        }

        .home .content a:hover {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            color: black;
        }

        h5 span {
            font-size: 1.5em;
            color: yellow;
            text-shadow: 0px 2px 2px black;
        }

        @media (max-width: 850px) {
            .home {
                background-position: 50%;
            }
        }

        @media (max-width: 450px) {
            .home {
                background-position: center;
            }

            .home .content h5 {
                font-size: 25px;
            }

            .home .content h1 {
                font-size: 38px;
            }

            .home .content p {
                font-size: 13px;
            }
        }

        .card {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
            transition: 0.2s cubic-bezier(0.22, 0.78, 0.45, 1.02);
        }

        .recipe-details p {
            background: linear-gradient(145deg, #e6e6e6, #ffffff);
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 70px;
            box-shadow: 1px 1px 2px black;
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
                        <a class="nav-link" href="#contact-us">Contact Us</a>
                    </li>
                </ul>

                <form id="searchForm" class="d-flex p-1 bg-light rounded rounded-pill shadow-sm me-2" method="GET" action="">
                    <div class="input-group">
                        <input class="form-control rounded rounded-pill border-0 bg-light" type="search" id="searchInput" name="q" placeholder="Search recipes..." aria-label="Search">
                        <div class="input-group-append">
                            <button id="button-search" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>

                <div class="profile-container mt-1" id="profile-container">
                    <?php if ($isUserLoggedIn) : ?>
                        <a class="btn text-light" href="userProfile.php"><i class="fas fa-user-circle" style="font-size: 2rem;"></i></a>
                    <?php endif; ?>
                </div>

                <?php if ($isUserLoggedIn) : ?>
                    <a class="btn btn-outline-danger my-1 my-sm-0 mx-2 rounded rounded-pill" data-toggle="tooltip" data-placement="top" href="logout.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
                <?php else : ?>
                    <a class="btn btn-outline-info my-1 my-sm-0 mx-2 rounded rounded-pill" data-toggle="tooltip" data-placement="top" href="login.php">Log In <i class="fas fa-sign-in-alt"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Home Page  -->
    <div class="home">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <h5>Welcome to <span>Marco's Kitchen</span></h5>
                        <h1>Explore Delicious <span class="changecontent"></span></h1>
                        <p class="mt-3" style="font-size: 20px;">Discover a world of flavors and culinary delights. Elevate your culinary experience with this simple yet delightful recipe.</p>
                        <a href="searchRecipe.php" class="btn mt-2 mb-4 rounded-pill">Explore Recipes <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row recipe-details mx-3 mt-4 justify-content-center">
                <div class="col-6 col-lg-2">
                    <p class="text-center"><strong class="larger-text">2000 +<br></strong>Recipes <i class="fas fa-book"></i> </p>
                </div>
                <div class="col-6 col-lg-2">
                    <p class="text-center"><strong class="larger-text">Cooking</strong><br>Tips <i class="fas fa-utensils"></i></p>
                </div>
                <div class="col-6 col-lg-2">
                    <p class="text-center"><strong class="larger-text">Rating</strong><br>100k + <i class="fas fa-users"></i></p>
                </div>
                <div class="col-6 col-lg-2">
                    <p class="text-center"><strong class="larger-text">1k +<br></strong>Ingredients <i class="fas fa-carrot"></i> </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Trending Card -->
    <div class="trend-container" id="trend-container">
        <div class="row mx-auto text-center">
            <h2 class="col-md-12 mt-3">Latest Recipes <i class="fas fa-fire"></i></h2>
        </div>

        <div id="recipeCardsContainer" class="row justify-content-center p-2"></div>
    </div>
    <!-- Recipe Card Ends -->

    <!-- Chef Section Starts -->
    <div id="chef-section">
        <div class="container mt-1 mb-2">
            <div class="row text-center my-4">
                <h1 class="fw-bold">Chefs</h1>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-3 text-center">
                    <h3>Healthy</h3>
                    <p>We provide you recipes with the detail composition of each food groups. So you can enjoy your meal.</p>
                </div>
                <div class="col-md-3 text-center">
                    <h3>Delicious</h3>
                    <p>The recipes we provide are almost highly rated by the top chef. You won't need to worry if the meal tastes bad.</p>
                </div>
                <div class="col-md-3 text-center">
                    <h3>Easy</h3>
                    <p>We provide each receipe with detail steps and several precautions to make sure you never have difficulty.</p>
                </div>
            </div>
        </div>
        <?php
        include 'chef.php';
        ?>
    </div>

    <section class="container service-container mt-4" id="services">
        <div class="row">
            <h2 class="section-heading col-12 text-center">Marco's Services</h2>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4 col-md-6 mb-4 align-items-center">
                <div class="service-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="service-title">Our Kitchen's Vision</h3>
                    <p class="service-text">
                        To inspire and empower individuals to create culinary masterpieces by providing a diverse collection of exceptional recipes
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="service-title">Our Kitchen's Mission</h3>
                    <p class="service-text">
                        We aim to curate a vast array of exceptional recipes, ranging from traditional favorites to innovative culinary creations
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-carrot"></i>
                    </div>
                    <h3 class="service-title">Our Core Values</h3>
                    <p class="service-text">
                        Through shared experiences, discussions, and collaboration, we aim to create a space where culinary enthusiasts can connect and grow together
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Subscribe -->
    <section class="subscribe-area pb-5 pt-5 mt-5"  id="contact-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="subscribe-text mb-2 mt-2">
                        <span>JOIN OUR NEWS RECIPES</span>
                        <h2>Subscribe <br> Marco's Kitchen </h2>
                        <div class="footer-social-icon mt-2">
                            <ul>
                                <li>
                                    <a href="#"><i class="uil uil-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="uil uil-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="uil uil-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="subscribe-wrapper subscribe2-wrapper mb-3">
                        <div class="subscribe-form">
                            <form action="#">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Enter your email address" aria-describedby="basic-addon2">
                                    <button class="btn btn-primary" type="button">Subscribe <i class="fas fa-long-arrow-alt-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <div class="bottom-footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="copyright-text">
                        <p class="text-light">Copyright &copy; 2023 <span class="name">Marco.</span> 
                        </p>
                    </div>
                </div>
            </div>
            <button class="scrolltop"><i class="uil uil-angle-up"></i></button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'api/trendRecipeAPI.php',
                method: 'POST',
                data: {
                    action: 'get_trend_items'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var cardContainer = $('#recipeCardsContainer');

                        response.favorite_items.forEach(function(item) {
                            const filledStars = Math.round(item.average_rating);
                            const unfilledStars = 5 - filledStars;
                            const starIcons = `<div class="rating-got">
                                ${Array(filledStars).fill('<span class="star main_star text-warning"><i class="fas fa-star"></i></span>').join('')}
                                ${Array(unfilledStars).fill('<span class="star main_star unfilled-star"><i class="fas fa-star"></i></span>').join('')}
                            </div>`;
                            var cardHTML = `
                            <div class='col-lg-3 col-md-4 col-sm-6 col-xs-6 col-11 my-2'>
                                <div class="card" style="border-radius: 30px;">
                                    <div class="row p-2">
                                        <div class="col-md-12">
                                            <img src="${item.img_path}" class="card-img-top" alt="..." style="border-radius: 30px; width: 100%;">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <h5 class="card-title text-center" id="name">${item.name}</h5>
                                                <div class="row">
                                                    <div class="col-12 text-center d-flex align-items-center justify-content-center">
                                                        ${starIcons} 
                                                        <p class="mx-3 mb-0 fw-bold" id="total_review">${item.total_reviews}</p>
                                                        <div class="fw-bold">
                                                            <p class="mb-0">ratings</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6 col-md-6">
                                                        <p class="text-center" id="meal_type"><strong>Category<br></strong>${item.meal_type}</p>
                                                    </div>
                                                    <div class="col-6 col-md-6">
                                                        <p class="text-center" id="cook_time"><strong>Cook <i class="fas fa-clock"></i> <br></strong>${item.cook_time} mins</p>
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
                error: function(xhr, status, error) {
                    console.error('Error fetching favorite items. Status:', status, 'Error:', error);
                }
            });
        });

        // Send recipe to search page
        $(document).ready(function() {
            $("#searchForm").submit(function(event) {
                event.preventDefault();
                var searchQuery = $("#searchInput").val();
                var url = "searchRecipe.php?q=" + encodeURIComponent(searchQuery);
                window.location.href = url;
            });

            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.scrolltop').fadeIn();
                } else {
                    $('.scrolltop').fadeOut();
                }
            });

            $('.scrolltop').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>