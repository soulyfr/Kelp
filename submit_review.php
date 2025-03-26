<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "You must be logged in to submit a review.";
    header("Location: index.php"); 
    exit();
}

$errors = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['service'])) {
        $errors[] = 'Service name is required.';
    }
    if (empty($_POST['title'])) {
        $errors[] = 'Title is required.';
    }
    if (empty($_POST['user'])) {
        $errors[] = 'User name is required.';
    }
    if (empty($_POST['review'])) {
        $errors[] = 'Review text is required.';
    }
    if (empty($_POST['category'])) {
        $errors[] = 'Category is required.';
    }
    if (empty($_POST['stars'])) {
        $errors[] = 'Stars rating is required.';
    }


    if (empty($errors)) {

        $service = htmlspecialchars($_POST['service']);
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $user = htmlspecialchars($_POST['user']);
        $review = htmlspecialchars($_POST['review'], ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($_POST['category']);
        $stars = intval($_POST['stars']);
        $user_id = $_SESSION['user_id'];
 
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = uniqid('img_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $filePath)) {
                $imagePath = basename(dirname($filePath)) . '/' . basename($filePath);
            } else {
                echo "Error: Could not save the uploaded file.";
            }
        }


        $submitQuery = $connection->prepare('INSERT INTO reviews_auth (user_id, service, title, user, text, category, stars, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $submitQuery->bind_param('isssssis', $user_id, $service, $title, $user, $review, $category, $stars, $imagePath);

        $submitQuery->execute();
        
        $submitQuery->close();

        $newReview = [
            'id' => $connection->insert_id, 
            'service' => $service,
            'title' => $title,
            'user' => $user,
            'text' => $review,
            'category' => $category,
            'stars' => $stars,
            'image' => $imagePath
        ];

        $_SESSION['reviews'][] = $newReview;

      
        header("Location: /");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
</head>
<body>

    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="/">Return to homepage</a>
</body>
</html>
