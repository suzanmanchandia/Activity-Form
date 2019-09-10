addEvent(window, 'load', initForm);

var highlight_array = new Array();

function initForm(){
	initializeFocus();
	var activeForm = document.getElementsByTagName('form')[0];
	addEvent(activeForm, 'submit', disableSubmitButton);
	ifInstructs();
	showRangeCounters();
}

function disableSubmitButton() {
	document.getElementById('saveForm').disabled = true;
}

function test(){
	if($("#Field219").val() == ""){
		alert('Please fill the required field');
	}else{
	$('#container').hide();
	alert('Thank you for submitting the form. You may now close the browser');
	
	}

}

//------------------Vineet-------------------//

function saveform(){
		var id = $("#userid").val();
		var type = $("#opt").val();
		var pin = $("#pin").val();
		
		$.post("functions.php?create="+type+"&id="+id+"&pin="+pin,
						{
						"Field1"       			:   $("#Field1").val(),
						"Field2"				:   $("#Field2").val(),
						"Field37"				:   $("#Field37").val(),
						"Field25"				:   $("#Field25").val(),
						"Field33"				:   $("#Field33").val(),
						"Field34"				:   $("#Field34").val(),
						"Field31"				:   $("#Field31").val(),
						"Field32"				:   $("#Field32").val(),
						"Field26"				:   $("#Field26").val(),
						"Field30"				:   $("#Field30").val(),
						"Field27"				:   $("#Field27").val(),
						"Field35"				:   $("#Field35").val(),
						"Field222"				:   $("#Field222").val(),
						"Field221"				:   $("#Field221").val(),
						"Field16"				:   $("#Field16").val(),
						"Field51"				:   $("#Field51").val(),
						"Field50"				:   $("#Field50").val(),
						"Field203"				:   $("#Field203").val(),
						"Field205"				:   $("#Field205").val(),
						"Field206"				:   $("#Field206").val(),
						"Field208"				:   $("#Field208").val(),
						"Field210"				:   $("#Field210").val(),
						"Field209"				:   $("#Field209").val(),
						"Field224"				:   $("#Field224").val(),
						"Field61"				:   $("#Field61").val(),
						"Field72"				:   $("#Field72").val(),
						"Field68"				:   $("#Field68").val(),
						"Field70"				:   $("#Field70").val(),
						"Field67"				:   $("#Field67").val(),
						"Field74"				:   $("#Field74").val(),
						"Field73"				:   $("#Field73").val(),
						"Field83"				:   $("#Field83").val(),
						"Field84"				:   $("#Field84").val(),
						"Field85"				:   $("#Field85").val(),
						"Field90"				:   $("#Field90").val(),
						"Field91"				:   $("#Field91").val(),
						"Field92"				:   $("#Field92").val(),
						"Field76"				:   $("#Field76").val(),
						"Field88"				:   $("#Field88").val(),
						"Field87"				:   $("#Field87").val(),
						"Field227"				:   $("#Field227").val(),
						"Field97"				:   $("#Field97").val(),
						"Field99"				:   $("#Field99").val(),
						"Field98"				:   $("#Field98").val(),
						"Field216"				:   $("#Field216").val(),
						"Field217"				:   $("#Field217").val()																		
						},
						function(response){
								alert("Success");
						}
			);

}


//----------------------X----------------------//




// for radio and checkboxes, they have to be cleared manually, so they are added to the
// global array highlight_array so we dont have to loop through the dom every time.
function initializeFocus(){
	var fields = getElementsByClassName(document, "*", "field");
	
	for(i = 0; i < fields.length; i++) {
		if(fields[i].type == 'radio' || fields[i].type == 'checkbox') {
			fields[i].onclick = function() {highlight(this, 4);};
			fields[i].onfocus = function() {highlight(this, 4);};
		}
		else if(fields[i].className.match('addr') || fields[i].className.match('other')) {
			fields[i].onfocus = function(){highlight(this, 3);};
		}
		else {
			fields[i].onfocus = function(){highlight(this, 2); };
		}
	}
}

function highlight(el, depth){
	if(depth == 2){var fieldContainer = el.parentNode.parentNode;}
	if(depth == 3){var fieldContainer = el.parentNode.parentNode.parentNode;}
	if(depth == 4){var fieldContainer = el.parentNode.parentNode.parentNode.parentNode;}
	
	addClassName(fieldContainer, 'focused', true);
	var focusedFields = getElementsByClassName(document, "*", "focused");
	
	for(i = 0; i < focusedFields.length; i++) {
		if(focusedFields[i] != fieldContainer){
			removeClassName(focusedFields[i], 'focused');
		}
	}
}

function ifInstructs(){
	var container = document.getElementById('public');
	if(container){
		removeClassName(container,'noI');
		var instructs = getElementsByClassName(document,"*","instruct");
		if(instructs == ''){
			addClassName(container,'noI',true);
		}
		if(container.offsetWidth <= 450){
			addClassName(container,'altInstruct',true);
		}
	}
}

function showRangeCounters(){
	counters = getElementsByClassName(document, "em", "currently");
	for(i = 0; i < counters.length; i++) {
		counters[i].style.display = 'inline';
	}
}

function validateRange(ColumnId, RangeType) {
	if(document.getElementById('rangeUsedMsg'+ColumnId)) {
		var field = document.getElementById('Field'+ColumnId);
		var msg = document.getElementById('rangeUsedMsg'+ColumnId);

		switch(RangeType) {
			case 'character':
				msg.innerHTML = field.value.length;
				break;
				
			case 'word':
				var val = field.value;
				val = val.replace(/\n/g, " ");
				var words = val.split(" ");
				var used = 0;
				for(i =0; i < words.length; i++) {
					if(words[i].replace(/\s+$/,"") != "") used++;
				}
				msg.innerHTML = used;
				break;
				
			case 'digit':
				msg.innerHTML = field.value.length;
				break;
		}
	}
}

/*--------------------------------------------------------------------------*/

//http://www.robertnyman.com/2005/11/07/the-ultimate-getelementsbyclassname/
function getElementsByClassName(oElm, strTagName, strClassName){
	var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
	var arrReturnElements = new Array();
	strClassName = strClassName.replace(/\-/g, "\\-");
	var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
	var oElement;
	for(var i=0; i<arrElements.length; i++){
		oElement = arrElements[i];		
		if(oRegExp.test(oElement.className)){
			arrReturnElements.push(oElement);
		}	
	}
	return (arrReturnElements)
}

//http://www.bigbold.com/snippets/posts/show/2630
function addClassName(objElement, strClass, blnMayAlreadyExist){
   if ( objElement.className ){
      var arrList = objElement.className.split(' ');
      if ( blnMayAlreadyExist ){
         var strClassUpper = strClass.toUpperCase();
         for ( var i = 0; i < arrList.length; i++ ){
            if ( arrList[i].toUpperCase() == strClassUpper ){
               arrList.splice(i, 1);
               i--;
             }
           }
      }
      arrList[arrList.length] = strClass;
      objElement.className = arrList.join(' ');
   }
   else{  
      objElement.className = strClass;
      }
}

//http://www.bigbold.com/snippets/posts/show/2630
function removeClassName(objElement, strClass){
   if ( objElement.className ){
      var arrList = objElement.className.split(' ');
      var strClassUpper = strClass.toUpperCase();
      for ( var i = 0; i < arrList.length; i++ ){
         if ( arrList[i].toUpperCase() == strClassUpper ){
            arrList.splice(i, 1);
            i--;
         }
      }
      objElement.className = arrList.join(' ');
   }
}

//http://ejohn.org/projects/flexible-javascript-events/
function addEvent( obj, type, fn ) {
  if ( obj.attachEvent ) {
    obj["e"+type+fn] = fn;
    obj[type+fn] = function() { obj["e"+type+fn]( window.event ) };
    obj.attachEvent( "on"+type, obj[type+fn] );
  } 
  else{
    obj.addEventListener( type, fn, false );	
  }
}