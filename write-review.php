<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="review-style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<a class="site-icon" href="/webprogbeadando">
    <img src="logo3.png" alt="" style="height: 45px;">
</a>
<p class="page-title" style="font-size: 20px; margin-top: 10px;">Kelp</p>


<form class="submit-form" action="submit_review.php" method="post" enctype="multipart/form-data">
    <h1>Write a review</h1>
    <div class="writables">
         
        <input class="writable" placeholder="Service" type="text" id="service" name="service" maxlength="30" required><br><br>

         
        <input class="writable" placeholder="Title" type="text" id="title" name="title" maxlength="30" required><br><br>

         
        <input class="writable" placeholder="Name" type="text" id="user" name="user" maxlength="20" required><br><br>
    </div>

    
    <div class="review-text">
        <textarea placeholder="Write your review.." id="review" name="review" rows="8" cols="30" maxlength="1500" required></textarea>
    </div>

    
    <div class="buttonables">
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="Shopping">Shopping</option>
            <option value="Sport">Sport</option>
            <option value="Fashion">Fashion</option>
            <option value="Food/Drinks">Food/Drinks</option>
            <option value="Household">Household</option>
            <option value="Services">Services</option>
        </select>

        <div class="image-upload">
            <label class="upload-button" for="image">🔼Upload image</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <label>Stars:</label>
        <div style="display: flex; gap: 5px; direction: rtl;">
            <input type="radio" id="star-5" name="stars" value="5">
            <label for="star-5"  class="radio-label">★</label>
        
            <input type="radio" id="star-4" name="stars" value="4">
            <label for="star-4" class="radio-label">★</label>

            <input type="radio" id="star-3" name="stars" value="3">
            <label for="star-3" class="radio-label">★</label>

            <input type="radio" id="star-2" name="stars" value="2">
            <label for="star-2" class="radio-label">★</label>

            <input type="radio" id="star-1" name="stars" value="1">
            <label for="star-1" class="radio-label">★</label>
        </div>
    </div>
    <button class="submit-button">Submit</button>
</form>

</body>
</html>