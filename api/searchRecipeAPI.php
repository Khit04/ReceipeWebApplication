<?php
require_once 'dbinfo.php';

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die('Failed to connect to the database: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = '%' . $_POST['searchQuery'] . '%';
    $difficulty = $_POST['difficulty'] ?? '';
    $cuisine = $_POST['cuisine'] ?? ''; 
    $mealType = $_POST['mealType'] ?? '';
    $dietary = $_POST['dietary'] ?? '';
    $prepareTime = $_POST['prepareTime'] ?? '';
    $cookTime = $_POST['cookTime'] ?? '';
    $nameSorting = $_POST['name'] ?? '';

    $query = "SELECT r.*,
    AVG(rt.user_rating) AS average_rating,
    COUNT(rt.review_id) AS total_reviews
        FROM recipe r
        LEFT JOIN review_table rt ON r.id = rt.recipe_id
        WHERE (r.name LIKE ? OR r.description LIKE ? 
            OR r.meal_type LIKE ? OR r.cuisine LIKE ? 
            OR r.dietary LIKE ? OR r.cook_method LIKE ? 
            OR r.ingredient_focus LIKE ?)
            AND (r.difficulty LIKE ? OR ? = '')
            AND (r.cuisine LIKE ? OR ? = '')
            AND (r.meal_type LIKE ? OR ? = '')
            AND (r.dietary LIKE ? OR ? = '')
            AND (r.prepare_time >= ? OR ? = '')
            AND (r.cook_time >= ? OR ? = '')
        GROUP BY r.id";

    if ($nameSorting === 'ascending') {
        $query .= " ORDER BY r.name ASC";
    } elseif ($nameSorting === 'descending') {
        $query .= " ORDER BY r.name DESC";
    } elseif ($nameSorting === 'rating') {
        $query .= " ORDER BY average_rating DESC";
    }

    $stmt = $conn->prepare($query);

    $stmt->bind_param('sssssssssssssssssss', $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $searchQuery, $difficulty, $difficulty, $cuisine, $cuisine, $mealType, $mealType, $dietary, $dietary, $prepareTime, $prepareTime, $cookTime, $cookTime);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $allRows = $result->fetch_all(MYSQLI_ASSOC);
        header('Content-Type: application/json');
        $json_string = json_encode($allRows, JSON_UNESCAPED_UNICODE);
        echo $json_string;
    } else {
        echo json_encode([]);
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

$conn->close();
?>
