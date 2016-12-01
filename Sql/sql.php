<!DOCTYPE html>
<html>
	<head>
		<title>SQL</title>
	</head>

	<body>
	
	<h1>MYSQL</h1>
		
		<hr />

		<form action="sql.php" method="post">
			DBName: <input type="text" name="Name"><br />
			SQLquery: <textarea name="queries"></textarea>
			
			<div id="submitbutton">
				<input type="submit" value="I like SQL!">
			</div>		
		</form>

	<?php //   ltrim / rtrim / trim 은 공백 및 문자열을 제거하는 함수입니다.
   		  // ltrim 은 왼쪽에 존재하는 공백 및 문자열을 제거하고 rtrim 은 오른쪽에 존재하는 공백 및 문자열을 제거하며,
   		  // trim 은 양쪽에 존재하는 공백 및 문자열을 제거하는 역할을 합니다. trim([대상 문자열], [제거할 문자열]);
   		  
   		  // array_shift 는 배열의 첫번째 값을 삭제하고 그 값을 리턴값으로 돌려주는 함수이며, array_shift([배열명]);
   		  // array_unshift 는 배열의 첫번째 자리에 값을 입력하고 배열의 크기를 돌려주는 함수입니다.  array_unshift([배열명], "[넣을 값]");	
	
		if (isset($_POST["Name"]) && isset($_POST["queries"]) && $_POST["Name"] != "" && $_POST["Name"] != "") {
					
			$name = $_POST["Name"];
			$db = new PDO("mysql:dbname=$name;host=localhost", "root", "dasom1993");
			$query = $_POST["queries"];
			$rows = $db->query($query);
			foreach ($rows as $row) {
				?>
				<li>
				<?php
				foreach ($row as $key => $value) {
					if (gettype($key) == "string") { 
				?>
					<?= $key ?>:<?= $value ?>
				<?php		
				}}
				?>
				</li>
				<?php
			}
			
		}
	?>
	
	</body>
</html>
