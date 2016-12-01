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

header("Content-type: application/xml");

$doc = new DOMDocument('1.0', 'UTF-8');
$doc->formatOutput = true;

$root = $doc->createElement('books');
$root = $doc->appendChild($root);

$lines = file($BOOKS_FILE);
for ($i = 0; $i < count($lines); $i++) {
	list($title, $author, $book_category, $year, $price) = explode("|", trim($lines[$i]));
	if ($book_category == $category) {
		$a = $doc->createElement('book');
		$a = $root->appendChild($a);

		$att = $doc->createAttribute('category');
		$att->value = $category;
		$a->appendChild($att);
		
		$b = $doc->createElement('title');
		$b = $a->appendChild($b);
		$text2 = $doc->createTextNode($title);
		$text2 = $b->appendChild($text2);
		
		$c = $doc->createElement('author');
		$c = $a->appendChild($c);
		$text3 = $doc->createTextNode($author);
		$text3 = $c->appendChild($text3);
		
		$d = $doc->createElement('year');
		$d = $a->appendChild($d);
		$text4 = $doc->createTextNode($year);
		$text4 = $d->appendChild($text4);
		
		$e = $doc->createElement('price');
		$e = $a->appendChild($e);
		$text5 = $doc->createTextNode($price);
		$text5 = $e->appendChild($text5);		
	}
}

echo $doc->saveXML();
?>
