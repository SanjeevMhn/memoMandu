<?php include "./include/header.php" ?>

	<?php 

		require_once './classes/Posts.php';	

		$post = new Posts;
		if(isset($_GET['v'])){
			$res = $post->viewPost($_GET['v']);
		}

	?>

	<div class="container">
		<div class="post-card">
			<h2 class="post-card__header">
				<?php echo $res['post_title'] ?>
			</h2>
			<p class="post-card__desc">
				<?php echo $res['post_desc'] ?>
			</p>
			<p class="post-card__author">
				<?php echo $res['post_author']?>
			</p>
		</div>
	</div>

<?php include "./include/footer.php" ?>