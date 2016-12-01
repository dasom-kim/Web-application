<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simple Timeline</title>
        <link rel="stylesheet" href="timeline.css">
    </head>
    <body>
        <div>
            <a href="index.php"><h1>Simple Timeline</h1></a>
            <div class="search">
                <!-- Ex 3: Modify forms -->
                <form class="search-form" action="index.php" method="get">
                    <input type="submit" value="search">
                    <input type="text" name = "findings" placeholder="Search">
                    <select name="finding">
                        <option value="author">Author</option>
                        <option value="contents">Content</option>
                    </select>
                </form>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <!-- Ex 3: Modify forms -->
                    <form class="write-form" action="add.php" method="post">
                        <input type="text" name="Author" placeholder="Author">
                        <div>
                            <input type="text" name="Content" placeholder="Content">
                        </div>
                        <input type="submit" value="write">
                    </form>
                </div>
                <!-- Ex 3: Modify forms & Load tweets -->
                <?php
                if(isset($_GET["contents"])) {
                	$query = $_GET["contents"];
                	$author = "author";
                	$contents = "contents";
                	include("timeline.php");
					$temp = new TimeLine();
				    $tweets = $temp->searchTweets($author, $query);
					if (count($tweets) == 0) {
						$tweets = $temp->searchTweets($contents, $query);
					}
					if (count($tweets) == 0) {
						$tweets = $temp->loadTweets();
					}
				} elseif(isset($_GET["finding"]) && isset($_GET["findings"])) {
					$type = $_GET["finding"];
					$query = $_GET["findings"];
					include("timeline.php");
					$temp = new TimeLine();
				    $tweets = $temp->searchTweets($type, $query);
					if (count($tweets) == 0) {
						$tweets = $temp->loadTweets();
					}	
				} else {
					include("timeline.php");
					$temp = new TimeLine();
				    $tweets = $temp->loadTweets();
				}
									
					$count = count($tweets) / 4;
						
					$no = array();
					$author = array();
					$contents = array();
					$time = array();						
					for($i = 0; $i < count($tweets); $i++) {
						if (($i % 4) == 0) { // no
							array_push($no, $tweets[$i]);
						} elseif (($i % 4) == 1) { // author
							array_push($author, $tweets[$i]);
						} elseif (($i % 4) == 2) { //contents
							array_push($contents, $tweets[$i]);
						} elseif (($i % 4) == 3) { //time
							array_push($time, $tweets[$i]);
						}	
					}	
						
				 	for($i = 0; $i < $count; $i++) {
				 		$time[$i] = date("H:i:s Y-m-d", strtotime($time[$i]));
							
                ?>
			                <div class="tweet">
			                    <form class="delete-form" action="delete.php" method="post">
			                        <input type="submit" value="delete">
			                        <input type="hidden" name = "no" value = "<?= $no[$i]?>">
			                    </form>
			                    <div class="tweet-info">
			                        <span><?= $author[$i]?></span>
			                        <span><?= $time[$i]?></span>
			                    </div>
			                    <div class="tweet-content">
			                        <?= $contents[$i] ?>
			                    </div>
			                </div>
                <?php
					}
               	?>
            </div>
        </div>
    </body>
</html>
