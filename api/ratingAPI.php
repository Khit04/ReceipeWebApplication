<?php
session_start();

require_once 'dbinfo.php';
$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST["rating_data"])) {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($user_id === null) {
        echo json_encode(array('error' => 'Please log in first'));
    } else {
        $recipe_id = $_POST["recipe_id"];

        $check_query = "SELECT COUNT(*) FROM review_table WHERE user_id = ? AND recipe_id = ?";
        $check_statement = $conn->prepare($check_query);
        $check_statement->bind_param('ii', $user_id, $recipe_id);
        $check_statement->execute();
        $check_statement->bind_result($review_count);
        $check_statement->fetch();
        $check_statement->close();

        if ($review_count > 0) {
            echo json_encode(array('error' => 'You have already reviewed this recipe'));
        } else {
            $user_name = $_POST["user_name"];
            $user_rating = $_POST["rating_data"];
            $user_review = $_POST["user_review"];
            $datetime = time();

            $query = "INSERT INTO review_table (user_id, user_name, user_rating, user_review, datetime, recipe_id) VALUES (?, ?, ?, ?, ?, ?)";
            $statement = $conn->prepare($query);
            $statement->bind_param('isssii', $user_id, $user_name, $user_rating, $user_review, $datetime, $recipe_id);
            $statement->execute();
            $statement->close();

            echo "Your Review & Rating Successfully Submitted";
        }
    }
}

if (isset($_POST["action"])) {
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    if (isset($_POST["recipe_id"]) && is_numeric($_POST["recipe_id"])) {
        $recipe_id = $_POST["recipe_id"];

        $query = "SELECT * FROM review_table WHERE recipe_id = ? ORDER BY review_id DESC";
        $statement = $conn->prepare($query);
        $statement->bind_param('i', $recipe_id);
        $statement->execute();
        $result = $statement->get_result();

        while ($row = $result->fetch_assoc()) {
            $review_content[] = array(
                'user_name' => $row["user_name"],
                'user_review' => $row["user_review"],
                'rating' => $row["user_rating"],
                'datetime' => date('l jS, F Y h:i:s A', $row["datetime"])
            );

            switch ($row["user_rating"]) {
                case '5':
                    $five_star_review++;
                    break;
                case '4':
                    $four_star_review++;
                    break;
                case '3':
                    $three_star_review++;
                    break;
                case '2':
                    $two_star_review++;
                    break;
                case '1':
                    $one_star_review++;
                    break;
            }

            $total_review++;
            $total_user_rating += $row["user_rating"];
        }

        if ($total_review > 0) {
            $average_rating = $total_user_rating / $total_review;
        }

        $output = array(
            'average_rating' => number_format($average_rating, 1),
            'total_review' => $total_review,
            'five_star_review' => $five_star_review,
            'four_star_review' => $four_star_review,
            'three_star_review' => $three_star_review,
            'two_star_review' => $two_star_review,
            'one_star_review' => $one_star_review,
            'review_data' => $review_content
        );

        echo json_encode($output);
    } else {
        echo json_encode(array('error' => 'Invalid recipe_id'));
    }
}

$conn->close();
?>
