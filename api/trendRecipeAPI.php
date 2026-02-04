<?php
include 'dbinfo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'get_trend_items') {
        $conn = new mysqli($host, $user, $pass, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT r.id, r.name, r.img_path, r.meal_type, r.dietary, r.cook_time, r.serve_person, 
                        AVG(rt.user_rating) AS average_rating, COUNT(rt.review_id) AS total_reviews
                FROM recipe r
                LEFT JOIN review_table rt ON r.id = rt.recipe_id
                GROUP BY r.id
                ORDER BY r.id DESC
                LIMIT 8";

        $result = $conn->query($sql);

        $response = array();

        if ($result->num_rows > 0) {
            $response['success'] = true;
            $response['favorite_items'] = array();

            while ($row = $result->fetch_assoc()) {
                $response['favorite_items'][] = $row;
            }
        } else {
            $response['success'] = false;
        }

        $conn->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'Invalid action parameter'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}
?>
