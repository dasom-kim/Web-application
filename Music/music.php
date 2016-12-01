<!DOCTYPE html>
<html>

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/4/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?php $song_count = 5678; ?> <?= $song_count; ?> total songs,
			which is over <?php $song_time = 5678 / 10; ?> <?= (int)$song_time; ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>		
			<ol>
				<?php 
					if (isset($_GET["newspages"])) {
						$news_pages = $_GET["newspages"]; 
					}
					else {
						$news_pages = 5; 
					}
				?>
				<?php for($i = 1; $i <= $news_pages; $i++) { ?>
				<li><a href="http://music.yahoo.com/news/archive/?page=<?= $i ?>">Page <?= $i ?></a></li>		
				<?php } ?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>		
			<ol>
				<?php 
					foreach (file("favorite.txt") as $name) {
						$artistname = explode(",", $name); //artistname이라는 배열에 ,를 기준으로 잘라서 하나하나 저장한다.
					}
					for ($i = 0; $i < count($artistname); $i++) { //하나하나마다
						$artistname2 = explode(" ", $artistname[$i]); //artistname2이라는 배열에 띄어쓰기 기준으로 artistname을 잘라서 저장시키고
						$artistlink = implode("_", $artistname2); //그 띄어쓰기 부분에 _를 삽입해서 다시 붙인다.
				?>
				<li><a href="http://en.wikipedia.org/wiki/<?= $artistlink; ?>"><?= $artistname[$i] ?></a></li>
				<?php } ?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
			<ul id="musiclist">
				<?php
					foreach (glob("problem4/musicPHP/songs/*.mp3") as $mp3file) {
						$sizelist["$mp3file"] = filesize($mp3file) / 1024;
					}
					arsort($sizelist);
					foreach ($sizelist as $key=>$value) {
				?>				
				<li class="mp3item">
					<a href="<?= $key ?>">
						<?= basename($key);?>
					</a>
					(<?= (int)$value; ?>KB)
				</li>
				<?php } ?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php 
					foreach (glob("problem4/musicPHP/songs/*.m3u") as $m3ufile) {
						$list[] = "$m3ufile";
						$list3 = NULL;
						$lines = file("$m3ufile");
						foreach ($lines as  $line) {
							if (strpos($line, "#") != "NULL") { //strpos([대상 문자열], [조건 문자열], [검색 시작위치]) strrpos는 뒤에서부터 찾음							
								$list3[] = "$line";
							}
						}
						shuffle($list3);
					}
					$list2 = array_reverse($list);
					
					foreach($list2 as $m3ufile2) {
				?>	
				<li class="playlistitem"><?= basename($m3ufile2) ?>:
					<ul>
						<?php
							foreach ($list3 as $list4) {
						?>
						<li><?= $list4 ?></li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
