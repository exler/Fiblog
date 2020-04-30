<?php

define("CONTENT_DIR", __DIR__ . "/posts/");

require_once("vendor/autoload.php");	
$config = require_once("config.php");

$posts = array_diff(scandir(CONTENT_DIR), array(".", "..", ".gitkeep"));

function getPostDetails($postName) {
    $title = "";
    $date = "";
    $author = "";
    $tags = [];

    $postContent = file_get_contents(CONTENT_DIR . $postName);
    $detailsStartPos = strpos($postContent, "---");
    $detailsEndPos = strpos($postContent, "---", $detailsStartPos + 1);

    $titlePos = strpos($postContent, "title:", $detailsStartPos) + strlen("title: ");
    if (!($titlePos > $detailsEndPos)) {
        $title = substr($postContent, $titlePos, (strpos($postContent, PHP_EOL, $titlePos)) - $titlePos);
    }
    $authorPos = strpos($postContent, "author:", $detailsStartPos) + strlen("author: ");
    if (!($authorPos > $detailsEndPos)) {
        $author = substr($postContent, $authorPos, (strpos($postContent, PHP_EOL, $authorPos)) - $authorPos);
    }
    $datePos = strpos($postContent, "date:", $detailsStartPos) + strlen("date: ");
    if (!($datePos > $detailsEndPos)) {
        $date = substr($postContent, $datePos, (strpos($postContent, PHP_EOL, $datePos)) - $datePos);
    }
    $tagsPos = strpos($postContent, "tags:", $detailsStartPos) + strlen("tags: ");
    if (!($tagsPos > $detailsEndPos)) {
        $tagsString = substr($postContent, $tagsPos, (strpos($postContent, PHP_EOL, $tagsPos)) - $tagsPos);
        $tags = explode(", ", $tagsString);
    }

    return [$title, $date, $author, $tags];
}

function getPost($postName) {
    $postContent = file_get_contents(CONTENT_DIR . $postName . ".md");
    $detailsStartPos = strpos($postContent, "---");
    $detailsEndPos = strpos($postContent, "---", $detailsStartPos + 1);

    $markdown = substr($postContent, $detailsEndPos);
	return ParsedownExtra::instance()->text($markdown);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo $config->site_name ?></title>
    <meta content="<?php echo $config->site_short_description ?>" name="description">

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/base.css">

    <!-- Favicon -->
    <link rel="icon" href="/assets/favicon.png">
</head>

<body>
    <div class="container">

        <header id="header">
            <a href="/">
                <img id="logo" alt="<?php echo $config->site_name ?>" src="assets/logo.png">

            <?php if(!isset($_GET["post"])) : ?>
                <div id="title">
                    <h1><?php echo $config->site_name ?></h1>
                </div>
            </a>

            <div class="social">
                <?php if($config->social_github) echo "<li><a target='_blank' href='https://github.com/" . $config->social_github . "'><img src='/assets/icons/github.svg' width='18'></a></li>" ?>
                <?php if($config->social_linkedin) echo "<li><a target='_blank' href='https://www.linkedin.com/in/" . $config->social_linkedin . "'><img src='/assets/icons/linkedin.svg' width='18'></a></li>" ?>
                <?php if($config->social_facebook) echo "<li><a target='_blank' href='https://www.facebook.com/" . $config->social_facebook . "'><img src='/assets/icons/facebook.svg' width='18'></a></li>" ?>
                <?php if($config->social_twitter) echo "<li><a target='_blank' href='https://twitter.com/" . $config->social_twitter . "'><img src='/assets/icons/twitter.svg' width='18'></a></li>" ?>
            </div>
            
            <?php else: $postDetails = getPostDetails($_GET["post"] . ".md"); ?>
                <div id="title">
                    <h1><?php echo $postDetails[0]; ?></h1>
                </div>
            </a>

            <div id="post-details">
                <?php
                    echo "Written by: " . $postDetails[2] . " @ ";
                    echo $postDetails[1] . " | ";
                    foreach($postDetails[3] as $tag) { echo "#" . $tag . " ";};
                ?>
            </div>
            <?php endif; ?>
        </header>

        <?php if(!isset($_GET["post"])) : ?>
            <section id="about">
                <p><?php echo $config->site_long_description ?></p>
            </section>

            <section>
                <h1>Posts</h1>
                <ul class="post-list">
                    <?php foreach($posts as $post) : ?>
                        <?php $postDetails = getPostDetails($post) ?>
                        <li class="post-item">
                            <div class="meta">
                                <?php echo $postDetails[1] ?>
                            </div>

                            <span>
                                <a href="?post=<?php echo substr($post, 0, -3) ?>">
                                    <?php echo $postDetails[0] ?>
                                </a>
                            </span>
                        </li>
        			<?php endforeach; ?>
                </ul>
            </section>

            <?php if($config->additional_section_header) : ?>
                <section>
                    <h1><?php echo $config->additional_section_header ?></h1>
                    <ul class="post-list">
                        <?php
                        foreach(array_keys($config->additional_section_links) as $link) : ?>
                            <li class="post-item">
                                <div class="additional_link">
                                    <a target="_blank" href="<?php echo $config->additional_section_links[$link][1] ?>">
                                        <?php echo $link ?>
                                    </a>
                                </div>
                                <div>
                                    <?php echo $config->additional_section_links[$link][0] ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>
        <?php else: ?>
            <div class="post-content">
                <?php echo getPost($_GET["post"]) ?>
            </div>
        <?php endif; ?>

    </div>

    <footer id="footer">
        <div class="footer-center">
            <?php echo $config->site_name . " - " . $config->site_short_description ?>
        </div>
    </footer>
</html>
</body>