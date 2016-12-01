"use strict";

/* Q1 - Fruits Basket Page
* 
* Complete 'fruitsBasket.js' and make the Fruits Basket page to runs as shown in the provided 'fruitsBasket.mp4' clip. 
* 
* Do NOT modify the provided 'fruitsBasket.html' and 'fruitsBasket.css'.
* Only Prototype and Scriptaculous libraries are allowed.
* 
* 1. Drag & Drop fruit images for selection :
*     (a) make all necessary elements Draggable.
*     (b) make all necessary elements Droppable and set it to call appropriate function when onDrop event occurs 
*     (c) when a fruit image is dragged into basket division, the dragged fruit image is moved from 'basket division' to 'fruits division'.
*     (d) when a fruit image is dragged into basket division, new list item is added selection ol and added list item pulsate 3 times for 1.0second.
*     (e) when a fruit image is dragged into basket division, add and/or remove class to the basket division to change the color of the basket division.
*         (required classes are already defined in 'fruitsBasket.css'.)
*     (f) basket division can hold upto 3 fruits maximum; when the 4th fruit is dragged into the basket division, the dragged image reverts back to its original position.
*
* 2. Drag & Drop fruit images for removal :
*     (a) when a fruit image is dragged into fruits division, the dragged fruit image is moved from 'basket division' to 'fruits division'. 
*     (b) when removing a fruit image, associated list item in selection ol and every class of basket division is removed.
*
* 3. Drag & Drop constraints :
*     (a) When fruit image is dragged 
*         - from fruits division to fruits divisio
*         - from basket division to basket division으
*         nothing happens and the fruit image reverts back to its original position .
*     (b) when a fruit image is dragged to a place other than fruits division or basket division, the dragged fruit image reverts itself back to the original position.
* 
* 
* 
* [KOREAN Translation]
* fruitsBasket.js를 완성하여 Fruits Basket 페이지를 동영상처럼 작동하도록 만드세요.
*
* 주어진 fruitsBasket.html과 fruitsBasket.css 파일은 수정하지마세요.
* Prototype과 Scriptaculous 라이브러리만 사용가능합니다.
*
* 1. Drag & Drop fruit images for selection :
*     (a) 필요한 모든 element들을 Dragabble로 만드세요
*     (b) 필요한 모든 element들을 Droppable로 만들고 onDrop 이벤트 발생시 적절한 함수를 부르도록 설정하세요.
*     (c) 과일 이미지를 basket division으로 드래그하면 과일 이미지를 fruits division에서 basket division으로 옮길 수 있습니다.
*     (d) 과일 이미지를 basket division으로 드래그 했을 때 selection ol에 새로운 list item을 추가하고 추가된 list item은 1.0초 동안 3번 pulsate합니다.
*     (e) 과일 이미지를 basket division으로 드래그 했을 때 basket division의 클래스를 추가하거나 삭제하여 basket division의 색깔을 변경하세요.
*         (관련 클래스는 fruitsBasket.css에 정의되어 있습니다.)
*     (f) basket division은 최대 3개까지의 과일을 담을 수 있습니다. 4번째 과일을 basket division에 드래그하면 이미지는 원래의 자리로 돌아갑니다.
*
* 2. Drag & Drop fruit images for removal :
*     (a) 과일 이미지를 fruits division으로 드래그하면 과일 이미지를 basket division에서 fruits division으로 옮길 수 있습니다.
*     (b) 과일 이미지를 제거할 때 selection ol에서 해당하는 list item과 basket division의 모든 클래스를 삭제합니다.
*
* 3. Drag & Drop constraints :
*     (a) 과일 이미지를
*         - fruits division에서 fruits division으로 드래그 한 경우
*         - basket division에서 basket division으로 드래그 한 경우
*         아무 일도 일어나지 않고 과일 이미지는 원래의 자리로 돌아갑니다.
*     (b) 과일 이미지를 fruits division이나 basket division이 아닌 곳에 드래그 한 경우 과일 이미지는 원래의 자리로 돌아갑니다.
*/

document.observe("dom:loaded", function() {
/*    1-1(a) create Dragabble
 *    1-1(b) add appropriate element in Droppable and attach adequate event handler function.  
 *    1-3(b) when a fruit image is dragged incorrectly it reverts back to its original position.
 * 
 *    [KOREAN Translation]
 *    1-1(a) Dragabble을 생성하세요
 *    1-1(b) Droppable에 적절한 element를 추가하고 적절한 함수를 호출하세요
 *    1-3(b) 과일 이미지를 잘못 드래그하면 원래 위치로 돌아갑니다
 * 
 */
	Droppables.add("fruits", {onDrop: fruitUnselect, revert: true});	
	Droppables.add("basket", {onDrop: fruitSelect, revert: true});
	
	var fruitsImgs = $$("#fruits img");
	for (var i = 0; i < fruitsImgs.length; i++) {
    	new Draggable(fruitsImgs[i], {revert: true});
    }
     
});

function fruitSelect(drag, drop, event) {
/*    1-1(c) adding a fruit image to basket division should be possible 
 *    1-1(d) add a new list item and appropriate effect
 *    1-1(e) add/remove necessary class to basket division
 *    1-1(f) set basket division to take maximum of 3 fruits
 *    1-3(a) if a fruit image inside basket division is dragged into basket division, nothing happens
 * 
 *   [KOREAN Translation]
 *    1-1(c) 과일 이미지를 basket division에 추가할 수 있도록 만드세요
 *    1-1(d) 새로운 list item을 추가하고 적절한 효과를 추가하세요
 *    1-1(e) basket division에 적절한 클래스를 추가하거나 삭제하세요
 *    1-1(f) basket division이 최대 3개의 과일만 담을 수 있도록 만드세요
 *    1-3(a) basket division안의 과일 이미지를 basket division으로 드래그한 경우 아무 일도 벌어지지 않습니다
 */
	if (drag.parentNode.getAttribute("id") !== drop.id) {
		if ($("basket").descendants().length < 3) {
			$("fruits").removeChild(drag);
			$("basket").appendChild(drag);
			
			var fruitname = drag.alt;
			var fruitlist = [];
			
			var list = document.getElementsByTagName("li");
			for (var i = 0; i < list.length; i++) {
				fruitlist.push(list[i].innerHTML);
			}
			
			for (i = 0; i < fruitlist.length; i++) {
				$("basket").removeClassName(fruitlist[i]);
			}
			
			$("basket").addClassName(fruitname);
						
			var li = document.createElement("li");
			li.innerHTML = fruitname;
			$("selection").appendChild(li);
					
			$("selection").pulsate({
				duration: 1.0,
				pulses: 3
			});
		}
	}
}
function fruitUnselect(drag, drop, event) {
/*    1-2(a) removing a fruit from basket division should be possible.
 *    1-2(b) remove list item associated to a removed fruit images and also remove class from basket division
 *    1-3(a) if a fruit image inside fruits division is dragged into fruits division, nothing happens 
 * 
 *    [KOREAN Translation] 
 *    1-2(a) 과일 이미지를 basket division에서 제거할 수 있도록 만드세요
 *    1-2(b) 제거한 과일 이미지에 해당하는 list item을 삭제하고 basket division의 클래스도 제거하세요
 *    1-3(a) fruits division안의 과일 이미지를 fruits division으로 드래그한 경우 아무 일도 벌어지지 않습니다
 */
	if (drag.parentNode.getAttribute("id") !== drop.id) {
		$("basket").removeChild(drag);
		$("fruits").appendChild(drag);
					
		var list = document.getElementsByTagName("li");
		
		var fruitname = drag.alt;
		var fruitlist = [];
					
		for (var i = 0; i < list.length; i++) {
			fruitlist.push(list[i].innerHTML);
			if (list[i].innerHTML.indexOf(fruitname) >= 0) {
				list[i].parentNode.removeChild(list[i]);
			}
		}
		
		for (i = 0; i < fruitlist.length; i++) {
			$("basket").removeClassName(fruitlist[i]);
		}
	}
}
