<?php
session_start();

include('dbinfo.php');

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'save_favorite') {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $recipe_id = isset($_POST['recipe_id']) ? $_POST['recipe_id'] : null;

        if ($user_id && $recipe_id) {
            $mysqli = new mysqli($host, $user, $pass, $database);

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $query = "
            INSERT INTO favorite (user_id, recipe_id)
            VALUES (?, ?)
            ";

            $statement = $mysqli->prepare($query);

            if (!$statement) {
                die("Prepare failed: " . $mysqli->error);
            }

            $statement->bind_param('ii', $user_id, $recipe_id);
            $statement->execute();

            if ($statement->affected_rows > 0) {
                $response = array('success' => true);
            } else {
                $response = array('success' => false);
            }

            $statement->close();
            $mysqli->close();
            echo json_encode($response);
        } else {
            echo json_encode(array('success' => false, 'error' => 'Invalid user_id or recipe_id'));
        }
    } elseif ($_POST['action'] === 'get_favorite_items') {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if ($user_id) {
            $mysqli = new mysqli($host, $user, $pass, $database);

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $query = "
                SELECT *
                FROM favorite
                INNER JOIN recipe ON favorite.recipe_id = recipe.id
                WHERE favorite.user_id = ?
            ";

            $statement = $mysqli->prepare($query);
            $statement->bind_param('i', $user_id);
            $statement->execute();
            $result = $statement->get_result();

            $favorite_items = array();

            while ($row = $result->fetch_assoc()) {
                $favorite_items[] = $row;
            }

            $response = array('success' => true, 'favorite_items' => $favorite_items);

            $statement->close();
            $mysqli->close();
            echo json_encode($response);
        } else {
            echo json_encode(array('success' => false, 'error' => 'Invalid user_id'));
        }
    } else {
        echo json_encode(array('success' => false, 'error' => 'Invalid action'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Action not set'));
}
