<?php // Fiblog - source: https://github.com/EXLER/Fiblog

define("CONTENT_DIR", __DIR__ . "/posts/");

require_once("vendor/autoload.php");	
$config = require_once("config.php");

$posts = array_diff(scandir(CONTENT_DIR), array(".", "..", ".gitkeep"));

function getPost($postPath) {
	$markdownString = file_get_contents($postPath);
	return ParsedownExtra::instance()->text($markdownString);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>
            <?php echo $config->site_name ?>
        </title>
        <meta content="<?php echo $config->site_description ?>" name="description">
        <link rel="stylesheet" href="/assets/main.css">
    </head>
    <body>
        <div class="menu">
            <div class="title">
                <a href="/"><?php echo $config->site_name ?></a>
            </div>
            <ul class="links">
            	<?php if($config->social_github) echo "<li><a href='https://github.com/" . $config->social_github . "'><img src='/assets/icons/github.svg' width='18'></a></li>" ?>
            	<?php if($config->social_linkedin) echo "<li><a href='https://www.linkedin.com/in/" . $config->social_linkedin . "'><img src='/assets/icons/linkedin.svg' width='18'></a></li>" ?>
            	<?php if($config->social_facebook) echo "<li><a href='https://www.facebook.com/" . $config->social_facebook . "'><img src='/assets/icons/facebook.svg' width='18'></a></li>" ?>
            	<?php if($config->social_twitter) echo "<li><a href='https://twitter.com/" . $config->social_twitter . "'><img src='/assets/icons/twitter.svg' width='18'></a></li>" ?>
            </ul>
        </div>
        <hr class="big">
        <div class="content">
			<div class="article">
				<?php

				if(isset($_GET["post"])) {
					echo getPost(CONTENT_DIR . $_GET["post"] . ".md");
				}

				?>
			</div>
        	<ul class="article-list">
        		<?php 

        		if(!isset($_GET["post"])) {
        			foreach($posts as $post) {
        				$post = substr($post, 0, -3);
        				$postTitle = str_replace("-", " ", $post);
        				$postTitle = ucwords($postTitle);
        				echo "<li><a href=" . "?post=" . $post . ">" . $postTitle . "</a></li>";
        			}
        		}

        		?>
        	</ul>
        </div>
        <hr class="big">
        <div class="footer">
        	<?php echo "&copy; " . date("Y") . " " . $config->site_author ?> 
        </div>
    </body>
</html>