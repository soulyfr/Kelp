<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <title>Kelp</title>
</head>
<body>

    <?php

    include 'db.php';

    if(!isset($_SESSION['reviews'])) {
        $queryAll = 'SELECT * FROM reviews';
        $reviewsAll = $connection->query($queryAll); 
    
    
        if($reviewsAll->num_rows > 1){
            while($row = $reviewsAll->fetch_assoc()) {
                $_SESSION['reviews'][] = $row;
            }
        }
        $connection->close();
    }
    $posts = [];

    if(isset($_SESSION['reviews'])){
    $posts = $_SESSION['reviews'];
    } 

    if(isset($_GET['category'])) {
        $category = $_GET['category'];

        if($category == 'All') {

        } else {
            $posts = array_filter($posts, function($post) use($category){
                return $post['category'] == $category;
            });
        }
    }   

    $postCount = count($posts);
    $pageCount = ceil($postCount / 4);

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page -1) * 4;

    $currentPagePosts = array_slice($posts , $offset, 4);
    ?>

    <div class="post-display">
        <div class="displayed-post"></div>
    </div>
    <div class="menus">
        <div class="topbar">
        <div class="secleft">
          <a class="site-icon" href="/">
            <img src="logo3.png" alt="" style="height: 100%;">
          </a>
          <p class="page-title" style="font-size : 20px; font-weight: bold;"> Kelp</p>
        </div>
  
      <div class="secmid">
        <input class="search-bar" type="text" placeholder="Search for a place you visited..">
        <button class="search-button">
          <img class="search-icon" src="search.svg" alt="" style="filter: invert();">
        </button>
      </div>
        
      <div class="secright">
        <a class="new-review-button" href="/write-review.php">Write a review</a>
      </div>
        </div>
    </div>
    <div class="header">
        <p style="color : rgb(240,240,240); font-size: 30px; text-shadow: 0px 4px 5px black;">All your reviews in one place</p>
    </div>
    <div class="content">
        <div class="sidebar">
            <button class="all-button">All</button>
            <button class="category-button">Shopping</button>
            <button class="category-button">Sport</button>
            <button class="category-button">Fashion</button>
            <button class="category-button">Food/Drinks</button>
            <button class="category-button">Household</button>
            <button class="category-button">Services</button>
        </div>
        <div class="postlist">
            

            <?php 
                foreach ($currentPagePosts as $post) {
                    echo '<div class="post">';
                    echo '<div class="data">';
                    echo '<p class="service">' . htmlspecialchars($post['service']) . '</p>';
                    echo '<p class="stars">' . str_repeat('★', $post['stars']) . '</p>';
                    echo '<p class="user">' . htmlspecialchars($post['user']) . '</p>';
                    echo '<p class="category">' . htmlspecialchars($post['category']) . '</p>';
                    if ($post['image'] != '') {
                        echo '<img src="../' . htmlspecialchars($post['image']) . '" alt="" class="source-img">';
                    }
                    echo '</div>';
                    echo '<div class="review">';
                    echo'<p class="review-title">' . htmlspecialchars_decode($post['title'], ENT_QUOTES) . '</p>';
                    echo '<p class="review-text">' . htmlspecialchars_decode($post['text'], ENT_QUOTES) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '<div class="page-buttons">';
                if($page > 1) {
                    echo '<button class="page-button" page="' . $page-1 . '" >◀</button>'; 
                }
                if($page != $pageCount && count($posts) > 0) {
                    echo '<button class="page-button" page="' . $page+1 . '" >▶</button>';
                }
                echo '</div>';

                if(count($posts) == 0) {
                    echo '<p class="no-posts">No posts yet..<p>';
                }
            ?>

        </div>
        <div class="right-side">
            <div class="image-display"></div>
            <div class="join-us">
                <p class="career-title">Join Us</p>
                <p class="career-text">Are you ready to make an impact? We're on the lookout for passionate, creative, and driven individuals to join our growing family. See available careers below:</p>
                <a href="/webprogbeadando" class="career-link">Careers</a>
                <p class="career-title">Missing something?</p>
                <p class="career-text">Want to register a location or service that isn't on our site yet? Reach out to us below:</p>
                <a href="/webprogbeadando" class="career-link">Contact us</a>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-column">
            <p class="footer-title">About</p>
            <p class="footer-text">About Kelp</p>
            <p class="footer-text">Terms of Service</p>
            <p class="footer-text">Careers</p>
        </div>
        <div class="footer-column">
            <p class="footer-title">Contact us</p>
            <p class="footer-text">Phone: +36 99-999-9999</p>
            <p class="footer-text">Business email: kelp_is_a_real_company@realmail.com</p>
            <p class="footer-text" style="font-weight:bold;">Facebook</p>
        </div>
        <div class="footer-column">
            <p class="footer-title">Other info</p>
            <p class="footer-text">This is all</p>
            <p class="footer-text">Extremely valid</p>
            <p class="footer-text">Information</p>
        </div>
        <div class="footer-column">
            <p class="footer-title">Copyright©</p>
            <p class="footer-text">Kelp inc.</p>
            <p class="footer-text">1994-2025</p>
        </div>
        </div>
    <script type="module" src="script.js"></script>
</body>
</html>