<?php include "./include/header.php"; ?>
<?php 
    session_start();
    require_once "./classes/FavoritePosts.php";
    $favs = new FavoritePosts;
    $getFavs = $favs->getFavoritePosts();
    $result = '';
    if(isset($_GET['rm'])){
       $result = $favs->removeFromFavorites($_GET['rm']); 
    }
    if($result){
        header('Location: FavoritesPage.php');
        $_SESSION['status'] = 'Removed from favorites';
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
            if(isset($getFavs)){
                foreach($getFavs as $gf){
        ?>
            <div class='post-card ft-lato'>
                <h2 class='post-title flex'>
                    <div class="text-content">
                        <?php echo $gf['post_title'] ?>
                    </div>
                    <a href='?rm=<?php echo $gf['fav_id'] ?>' name='add_to_favorites' class='add-to-fav'>
                        <i class='bi bi-heart'></i>
                    </a>
                </h2>
                <p class='post-author'>
                    <?php echo $gf['post_author'] ?>
                </p>
                <p class='post-desc'>
                    <?php echo $gf['post_desc'] ?>
                </p>
                <div class='post-actions'>
                    <button type='button' name='edit'>Edit</button>
                    <button type='button' name='show'>Show</button>
                    <button type='button' name='delete'>Delete</button>
                </div>
            </div>
        <?php
                }
            }
        ?>
    </div>
</div>


<?php include "./include/footer.php"; ?>