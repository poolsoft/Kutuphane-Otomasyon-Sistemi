<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>abc</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
		function getBookDetails(isbn) {
  
  // Query the book database by ISBN code.
  isbn = isbn || "9786053604372"; // Steve Jobs book 
  
  var url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;

  $.getJSON(url, function(a){
    
	    // There'll be only 1 book per ISBN
	    var book = a.items[0];
	    
	    var title = (book["volumeInfo"]["title"]);
	    var subtitle = (book["volumeInfo"]["subtitle"]);
	    var authors = (book["volumeInfo"]["authors"][0]);
	    var printType = (book["volumeInfo"]["printType"]);
	    var pageCount = (book["volumeInfo"]["pageCount"]);
	    var publisher = (book["volumeInfo"]["publisher"]);
	    var publishedDate = (book["volumeInfo"]["publishedDate"]);
	    var webReaderLink = (book["accessInfo"]["webReaderLink"]);
	    var imageLing = (book["volumeInfo"]["imageLinks"]["thumbnail"])
	    
	    // For debugging
	    console.log(title);
	    console.log(authors);
	    console.log(publisher);
	  	console.log(publishedDate);
	  	console.log(imageLing);

  });

}

	getBookDetails();

	</script>
</head>
<body>

</body>
</html>