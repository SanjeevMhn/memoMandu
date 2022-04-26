<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php CMS</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
    <header class="flex">
        <div class="logo-brand">
            CMS
        </div>
        <ul class="nav-list flex">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="./AddPosts.php" class="nav-link">Create Post</a>
            </li>
            <li class="nav-item">
                <a href="./FavoritesPage.php" class="nav-link">Favorites
                    <?php
                        require "./classes/FavoritePosts.php";
                        $fav_count = new FavoritePosts;
                    ?>
                    <?php 
                        echo "<span class='counter'>
                            ".$fav_count->getFavoriteCount()." 
                            </span>"
                    ?>
                </a>
                
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">Saved</a>
            </li>
        </ul>
    </header>