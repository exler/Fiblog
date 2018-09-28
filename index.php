<?php // Fiblog - source: https://github.com/EXLER/Fiblog

define("CONTENT_DIR", __DIR__ . "/posts/");

require_once("lib/Parsedown-1.6.0.php");	
$config = require_once("config.php");

$posts = array_diff(scandir(CONTENT_DIR), array(".", ".."));

function getPost($postPath) {
	$markdownString = file_get_contents($postPath);
	return Parsedown::instance()->text($markdownString);
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
                <meta content="" name="description">
                    <link href="/assets/main.css" rel="stylesheet">
                        <link href="/assets/favicon.png" rel="icon">
                        </link>
                    </link>
                </meta>
            </meta>
        </meta>
    </head>
    <body>
        <div class="menu">
            <div class="title">
                <a href="/"><?php echo $config->site_name ?></a>
            </div>
            <ul class="links">
                <li><a href="https://github.com/exler/Fiblog"><img src="/assets/icons/github.svg" width="18"></a></li>
                <!-- <li><a href="#"><img src="/assets/icons/linkedin.svg" width="18"></a></li> -->
                <!-- <li><a href="#"><img src="/assets/icons/facebook.svg" width="18"></a></li> -->
                <!-- <li><a href="#"><img src="/assets/icons/twitter.svg" width="18"></a></li> -->
            <ul>
        </div>
        <hr class="big">
        <div class="content">
			<div class="article">
				<?php

				if($_GET["post"]) {
					echo getPost(CONTENT_DIR . $_GET["post"] . ".md");
				}

				?>
			</div>
        	<ul class="article-list">
        		<?php 

        		if(!$_GET["post"]) {
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
        </div>
    </body>
</html>