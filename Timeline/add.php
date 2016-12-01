<?php
    try {
        if (preg_match("/(([a-zA-Z]+([-\s]{1}))+[a-zA-Z]+$|^[a-zA-Z]+$)/", $_POST["Author"]) && 1 <= strlen($_POST["Author"]) && strlen($_POST["Author"]) <= 20) {
        	$author = $_POST["Author"];
			$content = htmlspecialchars($_POST["Content"]);
			$tweet = array();
			array_push($tweet, $author);
			array_push($tweet, $content);
			include("timeline.php");
			$temp = new TimeLine();			
            $temp->add($tweet);
            header("Location:index.php");
	
        } else {
            header("Location:error.php");
        }
    } catch(Exception $e) {
       	header("Location:error.php");
    }
?>
