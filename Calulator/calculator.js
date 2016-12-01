"use strict";

var stack = [];
window.onload = function () {
    var displayVal = "0";
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = $(this).innerHTML;
            var value2 = $('expression').innerHTML;
            
            if (displayVal === "Error") {
				if(value === "AC"){
					value2 = "0"; 
					displayVal ="0"; //displayVal 초기화
					stack = []; //stack 초기화
				} else {
					$$('button')[i].disabled = true;
				}
			}
			
			else {                   			
				if(value === "0" || value === "1" || value === "2" || value === "3" || 
				value === "4" || value === "5" || value === "6" || value === "7" || value === "8" || value === "9" || value === ".") {
					if(displayVal === "0"){ //0으로 시작하는지 안하는지 확인
						displayVal = value;
					} else {
						displayVal += value;
					}
				}
				
				else if(value === "."){
					if(displayVal.indexOf(".") === -1){
						displayVal += value;
					}
				} 
				
				else if(value === "AC"){
					value2 = "0"; 
					displayVal ="0"; //displayVal 초기화
					stack = []; //stack 초기화
				}
				
				else if (value === "(" || value === ")") {
					if(displayVal === "0"){ //0으로 시작하는지 안하는지 확인
						displayVal = value;
						
					} else {
						displayVal += value;
					}
				}  
				
				else { //연산자가 나오면
					var displayVal2 = displayVal.split("");
					var want1 = [];
					var want2 = [];
					var decimal = [];
					
					for (var i = 0; i < displayVal2.length; i++) {
						if (displayVal2[i] === "(") {
							want1.push(displayVal[i]);
						} else if (displayVal2[i] === ")") {
							want2.push(displayVal[i]);
						} else {
							decimal.push(displayVal[i]);
						}
					}
					
					var decimalvalue = parseFloat(decimal.join(""));
					
					for (var i = 0; i < want1.length; i++) {
						stack.push(want1[i]);
					}
					
					stack.push(decimalvalue);
					
					for (var i = 0; i < want2.length; i++) {
						stack.push(want2[i]);
					}
									
					stack.push(value);				
					var temp= displayVal + value;
	
					if(value2 === "0"){ //expression에 나올 값들
						value2 = temp;
					} else {
						value2 += temp;
					}
					
					if(value === "="){
						var result = isValidExpression(stack);
						if (stack.length > 0) {
							if (result) {
								stack = infixToPostfix(stack);
								displayVal = postfixCalculate(stack);
								if (displayVal === "NaN") {
									displayVal = "Error";
								}					
							} else {
								displayVal = "Error";
							}
						} else {
							displayVal = "Error";
						}
					} else { 
						displayVal ="0";
					}
				}
			}
			
			$('expression').innerHTML = value2;
            $('result').innerHTML = displayVal;
        };
    }
};

function isValidExpression(s) {
	var temp = s;
	var opening = [];
	var closing = [];
	temp.pop();
	for (var i = 0; i < temp.length; i++) {
		if (temp[i] === "(") {
			opening.push(temp[i]);
		} else if (temp[i] === ")") {
			closing.push(temp[i]);
		}
	}

	if (opening.length === closing.length) {
		return true;	
	} else {
		return false;
	}
}
function infixToPostfix(s) {
    var priority = {
        "+":0,
        "-":0,
        "*":1,
        "/":1
    };
    var tmpStack = [];
    var result = [];
    for(var i =0; i<stack.length ; i++) {
        if(/^[0-9.]+$/.test(s[i])){
            result.push(s[i]);
        } else {
            if(tmpStack.length === 0){
                tmpStack.push(s[i]);
            } else {
                if(s[i] === ")"){
                    while (true) {
                        if(tmpStack.last() === "("){
                            tmpStack.pop();
                            break;
                        } else {
                            result.push(tmpStack.pop());
                        }
                    }
                    continue;
                }
                if(s[i] ==="(" || tmpStack.last() === "("){
                    tmpStack.push(s[i]);
                } else {
                    while(priority[tmpStack.last()] >= priority[s[i]]){
                        result.push(tmpStack.pop());
                    }
                    tmpStack.push(s[i]);
                }
            }
        }
    }
    for(var i = tmpStack.length; i > 0; i--){
        result.push(tmpStack.pop());
    }
 
    return result;
}
function postfixCalculate(s) {
	var temp = s;
	var operand = [];
	var result;
	
	for (var i = 0; i < temp.length; i++) {
		if (temp.length === 1) {
			result = temp[i];
			break;
		}
		if (temp[i] === "+") {
			var operand1 = operand.pop();
			var operand2 = operand.pop();
			operand1 = parseFloat(operand1);
			operand2 = parseFloat(operand2);
			result = operand2 + operand1;
			operand.push(result);
		} else if (temp[i] === "-") {
			var operand1 = operand.pop();
			var operand2 = operand.pop();
			operand1 = parseFloat(operand1);
			operand2 = parseFloat(operand2);
			result = operand2 - operand1;
			operand.push(result);	
		} else if (temp[i] === "*") {
			var operand1 = operand.pop();
			var operand2 = operand.pop();
			operand1 = parseFloat(operand1);
			operand2 = parseFloat(operand2);
			result = operand2 * operand1;
			operand.push(result);
		} else if (temp[i] === "/") {
			var operand1 = operand.pop();
			var operand2 = operand.pop();
			operand1 = parseFloat(operand1);
			operand2 = parseFloat(operand2);
			result = operand2 / operand1;
			operand.push(result);
		} else { //숫자면
			 operand.push(temp[i]);
		}
	}
	
	return result;
}
