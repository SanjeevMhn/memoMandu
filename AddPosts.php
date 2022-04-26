<?php 

    session_start();

    require "./include/header.php";
    require "./classes/Posts.php";

    $errTitle = $errDesc = $errAuthor = null;
    $title = $desc = $author = null;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['title'])){
            $errTitle = "Please enter valid title";
        }else{
            $title = test_input($_POST['title']);
        }

        if(empty($_POST['desc'])){
            $errDesc = "Please enter description";
        }else{
            $desc = test_input($_POST['desc']);
        }

        if(empty($_POST['author'])){
            $errAuthor = "Please enter author name";
        }else{
            $author = test_input($_POST['author']);
        }
    }

    $data = [
        "title" => $title,
        "desc" => $desc,
        "author" => $author
    ];

    $posts = new Posts();
    $result = $posts->insert($data);

    if($result){
        $_SESSION['status'] = "Post added";
        header("Location: index.php");
        exit;
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
?>

    <div class="form-wrapper ft-lato">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="post-form">
            <div class="form-data">
                <label for="title">Post Title</label>
                <input type="text" name="title" id="" class="form-input" placeholder="Post Title...">
                <?php 
                    if(isset($errTitle)){
                        echo "<div class='err-msg'>".$errTitle."</div>";
                    } 
                ?>
            </div>
            
            <div class="form-data">
                <label for="author">Post Author</label>
                <input type="text" name="author" id="" class="form-input" placeholder="Author Name...">
                <?php 
                    if(isset($errAuthor)){
                        echo "<div class='err-msg'>".$errAuthor."</div>";
                    } 
                ?>
            </div>

            <div class="form-data">
                <label for="desc">Post Description</label>
                <textarea name="desc" id="" cols="30" rows="10" class="form-text" placeholder="Post Description..."></textarea>
                <?php 
                    if(isset($errDesc)){
                        echo "<div class='err-msg'>".$errDesc."</div>";
                    } 
                ?>
            </div>
            <div class="form-data">
                <button type="submit" class="btn-submit" name="submit">Submit</button>
                <button type="reset" class="btn-cancel">Cancel</button>
            </div>
        </form>
    </div>

<?php require "./include/footer.php" ?>