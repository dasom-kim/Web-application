document.observe("dom:loaded", function() {
	/*	create an Ajax request to 'names.php' using HTTP GET request 
	 *  with the parameter name: 'type' & value: 'list'
	 *  when request is successful call 'listNames' function
	 *  when request fails or when exception occurs call 'ajaxFailed' function
	 * 
	 * 'names.php'에 HTTP GET 요청을 사용하는 Ajax 요청을 생성하시오
	 * 요청에서 사용되는 매개변수 이름: 'type' & 값: 'list'
	 * 요청이 성공적일 경우 'listNames' 함수 호출 
	 * 요청이 실패하거나 예외가 발생할 경우 'ajaxFailed' 함수 호출  
	 */
	
    new Ajax.Request("names.php", {
    	method: "get",
    	parameters: {"type": "list"},
    	onSuccess: listNames,
    	onFailure: ajaxFailed,
    	onException: ajaxFailed
    });
	
	/*	observe mouse click event from 'search' button and create anonymous function 
	 *  in the anonymous function create an Ajax request to 'names.php' using HTTP GET request 
	 *  with the parameter name: 'name' & value: selected option in the 'names' drop down list
	 *  when request is successful call 'listPopularity' function
	 *  when request fails or when exception occurs call 'ajaxFailed' function
	 * 
	 * 'search' 버튼으로부터의 마우스 클릭 이벤트를 관찰하여 익명의 함수를 생성하시오 
	 * 익명의 함수에서 'names.php'에 HTTP GET 요청을 사용하는 Ajax 요청을 생성하시오
	 * 요청에서 사용되는 매개변수 이름: 'name' & 값: 'names' 드랍다운리스트에서 선택된 옵션
	 * 요청이 성공적일 경우 'listPopularity' 함수 호출 
	 * 요청이 실패하거나 예외가 발생할 경우 'ajaxFailed' 함수 호출
	 */ 
	
	$("search").onclick = function(){
    	new Ajax.Request("names.php", {
    		method: "get",
    		parameters: {"name": $F("names")},
    		onSuccess: listPopularity,
    		onFailure: ajaxFailed,
    		onException: ajaxFailed
    	});
    }

});

function listNames(ajax) {
	/* process repsonse from the 'names.php'. 
	 * for each name in the response create an option element and attach it to the 'names' drop down list
	 * 
	 * 'names.php'에서의 응답을 처리하시오 
	 * 응답으로 온 각 이름에 해당하는 option 객체를 생성하여 'names' 드랍다운리스트에 추가하시오 
	 */	
	var newnames = ajax.responseText.replace('"', '');
	var names = newnames.split(" ");
	
	for (var i = 0; i < names.length; i++) {
		var option = document.createElement("option");
		option.innerHTML = names[i];
		$("names").appendChild(option);
	}
}

function listPopularity(ajax) {
	// clear out all existing list items (if exist) from the 'populalrity' list
	// 'popularity' 리스트에 이미 존재하는 list item이 있다면 이를 모두 지우시오  
	
    
    /* process repsonse from the 'names.php'. 
	 * for each rank in the response (each XML element) create an list item element containing year and ranking data from XML and attach it to the 'popularity' list
	 * 
	 * 'names.php'에서의 응답을 처리하시오 
	 * 응답으로 온 각 랭킹(각 XML 객체) 마다, XML에 있는 년도와 랭킹 데이터를 나타내는 list item 객체를 생성하여 'popularity' 리스트에 추가하시오 
	 */
	
	while($("popularity").firstChild) {
		$("popularity").removeChild($("popularity").firstChild);
	}
	
	var temp = ajax.responseXML.getElementsByTagName("rank");

	for (var i = 0; i < temp.length; i++) {
		var year = temp[i].getAttribute("year");;
		var rank = temp[i].firstChild.nodeValue;
		
		var li = document.createElement("li");
		li.innerHTML = year+" : "+rank; 
		$("popularity").appendChild(li);
	}
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
