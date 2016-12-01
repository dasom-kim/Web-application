/* CSE3026 : Web Application Development
 * Lab 8 - Maze
 * 
 */
"use strict";

var loser = null;  // whether the user has hit a wall

window.onload = function() {
	$("start").observe("click", startClick); //함수는 ()없이 호출함!
};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
	if (loser !== null) { //loser변수에 변화가 있으면 진거
		loser = "loser";
		this.addClassName("youlose");
	}
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
	$("status").innerHTML = 'Click the "S" to begin.'; //innerHTML은 스트링에서만 쓰는 걸 권장!
	if (loser === "loser") {
		var walls = $$(".boundary");
		for (var i = 0; i < walls.length; i++) {
			walls[i].removeClassName("youlose");
		}
	}
	loser = "start";
	
	$("maze").observe("mouseleave", overBody); //mouseleave가 왜 JSLint에서 오류뜨는지 질문
	
	var walls = $$(".boundary");
	for (var i = 0; i < walls.length; i++) {
		walls[i].observe("mouseover", overBoundary);
	}
	
	$("end").observe("mouseover", overEnd);
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
	if (loser === "start") {
		$("status").innerHTML = "You win! :)";
		loser = null;
	} else {
		$("status").innerHTML = "you lose! :(";
	}
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
	if (loser !== null) {
		loser = "loser";
		var walls = $$(".boundary");
		for (var i = 0; i < walls.length; i++) {
			walls[i].addClassName("youlose");
		}
	}
}



