<?php
    class TimeLine {
        # Ex 2 : Fill out the methods
        private $db;
        function __construct()
        {
            # You can change mysql username or password
            $this->db = new PDO("mysql:host=localhost;dbname=timeline", "root", "dasom1993");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        public function add($tweet) // This function inserts a tweet
        {
			$sql = "SELECT now()";
			foreach($this->db->query($sql)as $row){
				$time = $row['now()'];
			}
			$sql2 = "use timeline";
			$this->db->query($sql2);
			$st = $this->db->prepare('INSERT INTO tweets (author, contents, time) values (?, ?, ?)'); //인젝션 방지!
			$st->execute([$tweet[0], $tweet[1], $time]);
        }
        public function delete($no) // This function deletes a tweet
        {
        	$sql = "delete from tweets where no = $no";
            $this->db->query($sql);
        }
        # Ex 6: hash tag
        # Find has tag from the contents, add <a> tag using preg_replace() or preg_replace_callback()
        public function loadTweets() // This function load all tweets
        {
        	$sql = "select * from tweets order by time desc";
        	$tweets = array();
			foreach($this->db->query($sql)as $row){
				array_push($tweets, $row['no']);
				array_push($tweets, $row['author']);
				
				if (preg_match("/#[a-zA-Z0-9]+/", $row['contents'])) {
					$nothashed = explode("#", $row['contents']);
					if (!preg_match("/#[a-zA-Z0-9]+$/", $nothashed[0])) {	//​ 앞에 # 붙여주고 단어를 쓰면 해시테그 완성
																			// 각 단어별로 #을 붙여줘야 여러개의 해시태그 등록 가능​
																			// 해시태그 단어는 띄어쓰기 안됨
																			// 해시태그 단어는 특수문자 안됨
						$not = $nothashed[0]; //해시태그 앞에 해시태그가 아닌 내용있으면 저장해둠
					}
					$temp = strstr($row['contents'], "#"); //첫번째 해시태그 기준으로 그 뒤까지 얻어오기
					$temp2 = explode(" ", $temp); // 띄어쓰기 기준으로 다시 나누기!
					$temp3 = array();
					for ($i = 0; $i < count($temp2); $i++) {
						if (preg_match("/#/", $temp2[$i])) { //다시 나눈 문자열에서 #가 붙어있으면 링크를 붙인다.
							array_push($temp3, trim($temp2[$i], "#")); //get으로 들어가는 문자를 위해 #삭제한 단어 따로 저장
							$temp2[$i] = preg_replace("/#[a-zA-Z0-9]+$/", "<a href='index.php?contents=$temp3[$i]'>$temp2[$i]</a>", $temp2[$i]); //링크를 붙여줌
						}
					}
					$temp = implode(" ", $temp2); //다시 합치기
					$row['contents'] = $not.$temp; //contents로 다시 만들기
				}
		
				array_push($tweets, $row['contents']);
				array_push($tweets, $row['time']);
			}
			
			return $tweets;
        }
        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
        	$sql = "select * from tweets where $type like '%$query%' order by time desc";
            $tweets = array();
			foreach($this->db->query($sql)as $row){
				array_push($tweets, $row['no']);
				array_push($tweets, $row['author']);
				
				if (preg_match("/#[a-zA-Z0-9]+/", $row['contents'])) {
					$nothashed = explode("#", $row['contents']);
					if (!preg_match("/#[a-zA-Z0-9]+$/", $nothashed[0])) {	//​ 앞에 # 붙여주고 단어를 쓰면 해시태그 완성
																			// 각 단어별로 #을 붙여줘야 여러개의 해시태그 등록 가능​
																			// 해시태그 단어는 띄어쓰기 안됨
																			// 해시태그 단어는 특수문자 안됨
						$not = $nothashed[0]; //해시태그 앞에 해시태그가 아닌 내용있으면 저장해둠
					}
					$temp = strstr($row['contents'], "#"); //첫번째 해시태그 기준으로 그 뒤까지 얻어오기
					$temp2 = explode(" ", $temp); // 띄어쓰기 기준으로 다시 나누기!
					$temp3 = array();
					for ($i = 0; $i < count($temp2); $i++) {
						if (preg_match("/#/", $temp2[$i])) { //다시 나눈 문자열에서 #가 붙어있으면 링크를 붙인다.
							array_push($temp3, trim($temp2[$i], "#")); //get으로 들어가는 문자를 위해 #삭제한 단어 따로 저장
							$temp2[$i] = preg_replace("/#[a-zA-Z0-9]+$/", "<a href='index.php?contents=$temp3[$i]'>$temp2[$i]</a>", $temp2[$i]); //링크를 붙여줌
						}
					}
					$temp = implode(" ", $temp2); //다시 합치기
					$row['contents'] = $not.$temp; //contents로 다시 만들기
				}

				array_push($tweets, $row['contents']);
				array_push($tweets, $row['time']);
			}
			
			return $tweets;
        }
    }
?>