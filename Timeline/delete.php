<?php
	try {
		$no = $_POST["no"];
		include("timeline.php");
		$temp = new TimeLine();
	    $temp->delete($no);
	    header("Location:index.php");
	} catch(Exception $e) {
	    header("Location:error.php");
	}
?>
