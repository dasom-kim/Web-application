<!DOCTYPE html>
<html>
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if (!isset($_POST["Name"]) || !isset($_POST["ID"]) || !isset($_POST["Course"]) 
			|| !isset($_POST["Grade"]) || !isset($_POST["Credit"]) || !isset($_POST["Creditcard"])
			|| $_POST["Name"] == "" || $_POST["ID"] == "" || $_POST["Course"] == "" 
			|| $_POST["Grade"] == "" || $_POST["Credit"] == "" || $_POST["Creditcard"] == "" ){
		?>		
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p> 

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (!preg_match("/[a-zA-Z]([-\s])[a-zA-Z]/", $_POST["Name"])) { 
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p> 

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif (!preg_match("/[0-9]{16}/", $_POST["Credit"])) {
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>		
		
		<?php
		} elseif ($_POST["Creditcard"] == "Visa" && !preg_match("/4[0-9]{15}/", $_POST["Credit"])) {
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>
			
		<?php
		} elseif ($_POST["Creditcard"] == "MasterCard" && !preg_match("/5[0-9]{15}/", $_POST["Credit"])) {
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>
			
		<?php
		} else {
		?>
			<h1>Thanks, looser!</h1>
			<p>Your information has been recorded.</p>
			
			<ul> 
				<li>Name: <?= $_POST["Name"]?></li>
				<li>ID: <?= $_POST["ID"]?></li>
				<li>Course: <?= processCheckbox($_POST["Course"])?></li>
				<li>Grade: <?= $_POST["Grade"]?></li>
				<li>Credit Card: <?= $_POST["Credit"]?> (<?= $_POST["Creditcard"]?>)</li>
			</ul>
			 
			<p>Here are all the loosers who have submitted here:</p> 
			
			<?php
				$filename = "loosers.txt";
				file_put_contents($filename, "\n".$_POST["Name"].";".$_POST["ID"].";".$_POST["Credit"].";".$_POST["Creditcard"], FILE_APPEND);
				$contents = file_get_contents($filename);
			?>
			
			<pre>
				<?= $contents; ?>
			</pre>			
		<?php
		}
		?>
		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				if (isset($names)) {
					$result = implode(", ", $names);	
				}
				return $result;
			}
		?>
		
	</body>
</html>
