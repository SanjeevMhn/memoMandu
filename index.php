<?php 
    session_start();
    include "./include/header.php" 
?>    
<?php 
    require "./classes/Posts.php";
    
    $posts = new Posts;
    $getPosts = $posts->getAllPosts();
    $result = '';
    if(isset($_GET['q'])){
        $result = $posts->addToFavorite($_GET['q']);
    }

    if($result){
        header('Location: index.php');
        $_SESSION['status'] = 'Added to favorites';
        exit;
    }

    if(isset($_GET['d'])){
        $result = $posts->deletePost($_GET['d']);
    }
    if($result){
        header('Location: index.php');
        $_SESSION['status'] = 'Post Deleted';
        exit;
    }
?>

    <div class="wrapper">
        <?php 
            if(isset($_SESSION['status'])){
                echo "<div class='status-msg'>".$_SESSION['status']."</div>";
                unset($_SESSION['status']);
            }
        ?>
        <div class="grid-wrapper">
            <?php
                if(isset($getPosts)){
                    foreach($getPosts as $gp){
            ?>
                <div class='post-card ft-lato'>
                    <h2 class='post-title flex'>
                        <div class="text-content">
                            <?php echo $gp['post_title'] ?>
                        </div>
                        <a href='index.php?q=<?php echo $gp['post_id'] ?>' name='add_to_favorites' class='add-to-fav'>
                            <i class='bi bi-heart'></i>
                        </a>
                    </h2>
                    <p class='post-author'>
                        <?php echo $gp['post_author'] ?>
                    </p>
                    <p class='post-desc'>
                        <?php echo $gp['post_desc'] ?>
                    </p>
                    <div class='post-actions'>
                        <button type='button' name='show'>Edit</button>
                        <a href="viewPost.php?v=<?php echo $gp['post_id']?>">Show</a>
                        <a href="?d=<?php echo $gp['post_id'] ?>" type='button' name='delete'>Delete</a>
                    </div>
                </div> 
            <?php
                    }
                }
            ?>

        </div>
    </div>
  
<?php include "./include/footer.php" ?>