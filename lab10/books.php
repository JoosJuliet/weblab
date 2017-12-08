<?php
$BOOKS_FILE = "books.txt";

function filter_chars($str) {
	return preg_replace("/[^A-Za-z0-9_]*/", "", $str);
}

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

$category = "";
$delay = 0;

if (isset($_REQUEST["category"])) {
	$category = filter_chars($_REQUEST["category"]);
}
if (isset($_REQUEST["delay"])) {
	$delay = max(0, min(60, (int) filter_chars($_REQUEST["delay"])));
}

if ($delay > 0) {
	sleep($delay);
}

if (!file_exists($BOOKS_FILE)) {
	header("HTTP/1.1 500 Server Error");
	die("ERROR 500: Server error - Unable to read input file: $BOOKS_FILE");
}

header("Content-type: text/xml");

$doc = new DOMDocument('1.0', 'UTF-8');
$books = $doc -> createElement('books');
$doc -> appendChild($books);
$files = file($BOOKS_FILE);
for ($i = 0; $i < count($files); $i++) {
	list($title, $author, $book_category, $year, $price) = explode("|", trim($files[$i]));
	if ($book_category == $category) {
		$tbook = $doc -> createElement('book');

		$tbook ->setAttribute("category",$book_category);

		$ttitle = $doc -> createElement('title');
		$ttitle -> appendChild($doc -> createTextNode($title));
		$tbook -> appendChild($ttitle);


		$tauthor = $doc -> createElement('author');
		$tauthor -> appendChild($doc -> createTextNode($author));
		$tbook -> appendChild($tauthor);

		$tyear = $doc -> createElement('year');
		$tyear -> appendChild($doc -> createTextNode($year));
		$tbook -> appendChild($tyear);

		$tprice = $doc -> createElement('price');
		$tprice -> appendChild($doc -> createTextNode($price));
		$tbook -> appendChild($tprice);

		$books -> appendChild($tbook);
	}
}
$xml = $doc -> saveXML();
print $xml;

?>
