window.onload = function() {
    $("b_xml").onclick=function(){
    	    //construct a Prototype Ajax.request object
      new Ajax.Request("books.php", {
    		method: "get",
    		parameters: {category: getCheckedRadio($$("div#category>label>input"))},
    		onSuccess: showBooks_XML,
    		onFailure: ajaxFailed,
    		onException: ajaxFailed
    	});
    };
    $("b_json").onclick=function(){
    	    //construct a Prototype Ajax.request object
      new Ajax.Request("books_json.php", {
    		method: "get",
    		parameters: {category: getCheckedRadio($$("div#category>label>input"))},
    		onSuccess: showBooks_JSON,
    		onFailure: ajaxFailed,
    		onException: ajaxFailed
    	});

    };
};

function getCheckedRadio(radio_button){
  console.log("getCheckedRadio");
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
  console.log('showBooks_XML');
	alert(ajax.responseText);
  var booksList = document.getElementById("books");
  while (booksList.hasChildNodes()){
    booksList.removeChild(booksList.firstChild);
  }
  var books = ajax.responseXML.getElementsByTagName("book");
  for (var i = 0; i < books.length; i ++){
    var title = books[i].getElementsByTagName("title")[0].firstChild.nodeValue;
    var author = books[i].getElementsByTagName("author")[0].firstChild.nodeValue;
    var year = books[i].getElementsByTagName("year")[0].firstChild.nodeValue;

    var list = document.createElement("li");
    list.textContent = title + ", by " + author + " (" + year + ")";
    $("books").appendChild(list);
  }
}

function showBooks_JSON(ajax) {
	// alert(ajax.responseText);
  var booksList = document.getElementById("books");
  while (booksList.hasChildNodes()){
    booksList.removeChild(booksList.firstChild);
  }
  var data = JSON.parse(ajax.responseText);
  for (var i = 0; i < data.books.length; i ++){
    var list = document.createElement("li");
    list.textContent = data.books[i].title + ", by " + data.books[i].author + " (" + data.books[i].year + ")";
    $("books").appendChild(list);
  }
}

function ajaxFailed(ajax, exception) {
  console.log('ajaxFailed');
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText +
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
