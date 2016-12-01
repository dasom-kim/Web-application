var num1 = "12pt";

function hello() {
   timer = setInterval(hello, 500);
   var speech = $("area");
   var num2 = parseInt(num1);
   num2 += 2;
   num1 = num2 + "pt";
   speech.style.fontSize = num2 + "pt";
}

function hello2() {
	if ($("box").checked == true) {
		$("area").style.fontWeight = "bold";
		$("area").style.color = "green";
		$("area").style.textDecoration = "underline";
		document.body.style.backgroundImage = "url(http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/7/hundred.jpg)";
	} else {
		$("area").style.fontWeight = "normal";
	}
}

function hello3() {
	var s = $("area").value;
	s = s.toUpperCase(); 
	var a = s.split(".");
	s = a.join("-izzle.");
	$("area").value = s;
}

function hello4() {
	var s = $("area").value;
	var a = s.split("");
	var b = []; //모음부터 저장하는 배열
	var c = []; //자음만 저장하는 배열
	var n = []; //새로운 단어 저장하는 배열
	var d = 0;
	
	for (var i = 0; i < a.length; i++) {
		if (a[0] == "a" || a[0] == "e" || a[0] == "i" || a[0] == "o" || a[0] == "u") {
			a.push("ay");
			s = a.join("");
			$("area").value = s;
			break;
		}
		if (a[i] == "a" || a[i] == "e" || a[i] == "i" || a[i] == "o" || a[i] == "u") { //모음이면
			d = i;
			for(var i = d; i < a.length; i++) {
				b.push(a[i]);
			}
			
			for(var i  = 0; i < d; i++) {
				c.push(a[i]);
			}
			
			for(var i = 0; i < a.length; i++) {
				if (i < a.length - d) {
					n.push(b[i]);	
				} else {
					n.push(c[i - (a.length - d)]);
				}
			}
			n.push("ay");
			s = n.join("");
			$("area").value = s;
			break;
		} 
	}
	
}

function hello5() {
	var s = $("area").value;
	var a = s.split("");
	if (a.length >= 5) {
		s = "Malkovich";
	}
	$("area").value = s;
}