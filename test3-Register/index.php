<!DOCTYPE html>
<!--
	1. Form - Register Page for SELab
	index.php를 완성하여 아래 등록 페이지를 스크린샷 처럼 생성하시오 (스크린샷은 맥의 Firefox에서) 
	
	대부분의 text는 주어졌으며; 지시 없이 text를 수정하는 것 금지.
	아래 사양에 맞게 적절한 HTML 태그와 PHP 코드를 작성하시오.
	
	1.Form : 
		(a) 사용자 입력을 HTTP POST request를 통하여 register.php로 제출하는 form을 생성하시오
		(b) form은 form 데이터(text)와 파일 모두를 제출할 수 있어야 함 
	
	2. Email, Password, and  Name : 
		(a) query parameter의 이름이 email인 text field를 생성하시오    
		(b) query parameter의 이름이 password인 암호를 위해 특별히 디자인 된 text field를 생성하시오  
		(c) query parameter의 이름이 name인 text field를 생성하시오'
		
	3.Status : 
		(a) 스크린 샷에서 보이는 것 처럼 radio button 그룹을 생성하시오  
		(b) radio button의 query parameter의 이름이 status이고 값이 undergraduate, master, phd이 될수 있도록 설정하시오 
	
	4.Courses :
		(a) 스크린 샷에서 보이는 것 처럼 check box 그룹을 생성하시오 
		(b) check box의 query parameter의 이름이 각각 web, logic, model이 되도록 설정하시오 
		(c) Web Application Development check box가 처음에 그리고 기본적으로 체크 되어 있도록 설정하시오.  
		
	5. Favorite Programming Language : 
		(a) query parameter의 이름이 language인 drop-down list를 생성하고 이 list의 가능한 값을 c, java, python, php, js가 되도록 설정하시오  
		
	6. File Upload : 
		(a) query parameter의 이름이 profile이며 파일 업로드를 가능하게 하는 form control을 생성하시오 
		
	7. Reset & Submit Button :
		(a) 리셋과 제출 버튼을 생성하시오 
		
	8. Member Lists : 
		(a) member.txt파일을 한줄 한줄 읽어서 스크린 샷에 보이는 것처럼 읽은 정보를 적절히 보여주는 PHP 코드를 작성하시오. 
			(처음에 member.txt에는 김가연 조교의 정보가 적혀 있음.)
			
	--------------------------------------------------
	HTML coding - Form.
	
	index.php에 SELab 등록 form을 생성하시오. 
		* 폴더/디렉터리 구조나 index.php와 register.php파일 이외에는 수정하지 마시오. 
		* 불필요하거나 오래되거나 폐기된 태그 사용 금지 (감점!)
-->

<html>
    <head>
        <meta charset="utf-8">
        <title>SElab Register</title>
        <link href="resource/style.css" rel="stylesheet" />
    </head>
    <body>
        <div class="wrap">
        	<form action="register.php" method="post" enctype="multipart/form-data">
	            <h1>Register</h1>
	            <div>Email :</div>
	            <input type="text" name="email">
	            <div>Password :</div>
	            <input type="password" name="password">
	            <div>Name :</div>
	            <input type="text" name="name">
	            
	            <fieldset>
	                <legend>Status</legend>
	                    <input type="radio" name="status" value="undergraduate" />Undergraduate
	                    <input type="radio" name="status" value="master" />Master
	                    <input type="radio" name="status" value="phd" />Ph.D
	            </fieldset>
	            
	            <fieldset>
	                <legend>Courses</legend>
	                    <input type="checkbox" name="courses[]" value="web" checked="checked" />Web Application Development
	                    <input type="checkbox" name="courses[]" value="logic" />Logical Fundamentals of Programming
	                    <input type="checkbox" name="courses[]" value="model" />Model Checking
	            </fieldset>
	            
	            <div>    
	                Favorite Programming Language :
	                <select name="language">
	                    <option value="c">C</option>
	                    <option value="java">Java</option>
	                    <option value="python">Python</option>
	                    <option value="php">PHP</option>
	                    <option value="js">JavaScript</option>
	                </select>
	            </div>
	            
	            <div>    
	                Profile Image :
	                <input type="file" name="profile" />
	            </div>
	            
	            <div>
	            	<input type="reset" value="초기화" />
	            	<input type="submit" value="질의 보내기" />
	            </div>
	        </form>
	            
	            <hr />
	            
	            <h2>Members List</h2>
	            <ul>
	            		<?php // 1-8a read file and display read information. use 'file_get_contents' 
	            			$filename = "resource/members.txt";
	            			$contents = file_get_contents($filename);
							
							$result = explode(";", $contents);
						?>
						<li><?= $result[2] ?>
							<ul>
								<li>Email : <?= $result[0] ?></li>
								<li>password : <?= $result[1] ?></li>
								<li>status : <?= $result[3] ?></li>
								<li>courses : <?= $result[4] ?></li>
								<li>favorite programming language : <?= $result[5] ?></li>
							</ul>
						</li>
	            </ul>
        </div>
    </body>
</html>
