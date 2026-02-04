<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Rating</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: whitesmoke;
        }

        .card {
            border-radius: 20px;
            background: white;
            box-shadow: 1px 1px 2px black;
        }

        .modal-content {
            border-radius: 20px;
            background: white;
            box-shadow: 1px 1px 2px black;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 mx-auto text-center">
                <div class="card">
                    <div class="card-header text-center fw-bold">Overall Reviews</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5 text-center d-flex flex-column justify-content-center">
                                <h3>Rating</h3>
                                <h1 class="text-warning mt-4 mb-4">
                                    <b><span id="average_rating">0.0</span> / 5</b>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <p>
                                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right"><<span id="total_five_star_review">0</span>></div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right"><<span id="total_four_star_review">0</span>></div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right"><<span id="total_three_star_review">0</span>></div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right"><<span id="total_two_star_review">0</span>></div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right"><<span id="total_one_star_review">0</span>></div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                </div>
                                </p>
                            </div>
                            <div class="col-sm-1">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="review_modal" class="modal" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title">Feedback this Recipe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center mt-2 mb-3">
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                            </h4>
                            <div class="form-group">
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Username" style="border-radius: 10px;" />
                            </div>
                            <div class="form-group">
                                <textarea name="user_review" id="user_review" class="form-control" cols="30" rows="5" placeholder="Add Comment Here" style="border-radius: 10px;"></textarea>
                            </div>
                            <div class="form-group text-center mt-4">
                                <button type="button" class="btn btn-primary rounded-pill" id="save_review">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4 class="text-center mt-3">Comments</h4>
        </div>
        <div class="mt-3" id="review_content"></div>
    </div>
</body>

</html>


<style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }
</style>

<script>
    $(document).ready(function() {
        var rating_data = 0;
        $('#add_review').click(function() {
            $('#review_modal').modal('show');
        });

        $(document).on('mouseenter', '.submit_star', function() {
            var rating = $(this).data('rating');
            reset_background();
            for (var count = 1; count <= rating; count++) {
                $('#submit_star_' + count).addClass('text-warning');
            }
        });

        function reset_background() {
            for (var count = 1; count <= 5; count++) {
                $('#submit_star_' + count).addClass('star-light');
                $('#submit_star_' + count).removeClass('text-warning');
            }
        }

        $(document).on('mouseleave', '.submit_star', function() {
            reset_background();
            for (var count = 1; count <= rating_data; count++) {
                $('#submit_star_' + count).removeClass('star-light');
                $('#submit_star_' + count).addClass('text-warning');
            }
        });

        $(document).on('click', '.submit_star', function() {
            rating_data = $(this).data('rating');
        });

        $('#save_review').click(function() {
            var user_name = $('#user_name').val();
            var user_review = $('#user_review').val();
            var urlParams = new URLSearchParams(window.location.search);
            var recipeId = urlParams.get('id');

            if (user_name == '' || user_review == '' || !recipeId) {
                alert("Please Fill Both Fields or Invalid Recipe ID");
                return false;
            } else {
                $.ajax({
                    url: "api/ratingAPI.php",
                    method: "POST",
                    data: {
                        rating_data: rating_data,
                        user_name: user_name,
                        user_review: user_review,
                        recipe_id: recipeId
                    },
                    success: function(data) {
                        $('#review_modal').modal('hide');
                        load_rating_data();
                        alert(data);
                    }
                })
            }
        });

        load_rating_data();

        function load_rating_data() {
            var urlParams = new URLSearchParams(window.location.search);
            var recipe_id = urlParams.get('id');

            $.ajax({
                url: "api/ratingAPI.php",
                method: "POST",
                data: {
                    action: 'load_data',
                    recipe_id: recipe_id
                },
                dataType: "JSON",
                success: function(data) { 
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);

                    var count_star = 0;

                    $('.main_star').each(function() {
                        count_star++;
                        if (Math.ceil(data.average_rating) >= count_star) {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });

                    $('#total_five_star_review').text(data.five_star_review);
                    $('#total_four_star_review').text(data.four_star_review);
                    $('#total_three_star_review').text(data.three_star_review);
                    $('#total_two_star_review').text(data.two_star_review);
                    $('#total_one_star_review').text(data.one_star_review);
                    $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');
                    $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');
                    $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');
                    $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');
                    $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                    if (data.review_data.length > 0) {
                        var html = '';

                        for (var count = 0; count < data.review_data.length; count++) {
                            html += `
                        <div class="row mb-3 mx-auto justify-content-center">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-1 col-2">
                                        <div class="rounded-circle bg-info text-black pt-2 pb-2" style="width: 100%; min-height: 50px; max-height: 10vh; display: flex; align-items: center; justify-content: center;">
                                            <h3 class="text-center" style="margin: 0;">${data.review_data[count].user_name.charAt(0)}</h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-11">
                                        <div class="card">
                                            <div class="card-header"><b>${data.review_data[count].user_name}</b></div>
                                            <div class="card-body">`;

                            for (var star = 1; star <= 5; star++) {
                                var class_name = '';

                                if (data.review_data[count].rating >= star) {
                                    class_name = 'text-warning';
                                } else {
                                    class_name = 'star-light';
                                }

                                html += `<i class="fas fa-star ${class_name} mr-1"></i>`;
                            }

                            html += `<br />${data.review_data[count].user_review}
                                            </div>
                                            <div class="card-footer text-left">Reviewed On ${data.review_data[count].datetime}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        }
                        $('#review_content').html(html);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed. Status:', status, 'Error:', error);
                 }
            })
        }
    });
</script>