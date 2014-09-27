<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>King James Bible Word Scraper</title>
	<meta charset="UTF-8">
</head>

<body>

	<?php

		//Error message and exit to prevent additions to an existing word list

		if (file_exists("/Applications/MAMP/htdocs/p2/wordlists/biblewords.txt")) {
			echo "A biblewords.txt file already exists in your p2/wordlists directory. To avoid appending to it, this program will terminate.";
			exit;
		}

		//Establishing an array with all the letters of the alphabet for which there are biblical words

		$alphabetLessX = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","y","z");

		//Scrape the words for the pages "a-y" into text file biblewords.txt

		for ($i=0; $i<count($alphabetLessX)-1; $i++) {

			$bibleSource = file_get_contents("http://www.apostolic-churches.net/bible/allwords/".$alphabetLessX[$i].".html");
			preg_match_all("/value=\"(.*)\" class/", $bibleSource, $matches);

			$counter = count($matches[1], COUNT_RECURSIVE);

			for ($j=0; $j<$counter; $j++) {
				file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/biblewords.txt", $matches[1][$j]."\n", FILE_APPEND);
			}
		}

		//Scrape the words for page "z," making sure that there is no extra line at the end of the .txt file

			$bibleSource = file_get_contents("http://www.apostolic-churches.net/bible/allwords/".$alphabetLessX[$i].".html");
			preg_match_all("/value=\"(.*)\" class/", $bibleSource, $matches);

			$counter = count($matches[1], COUNT_RECURSIVE);

			for ($j=0; $j<$counter-1; $j++) {
				file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/biblewords.txt", $matches[1][$j]."\n", FILE_APPEND);
			}

			file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/biblewords.txt", $matches[1][$j], FILE_APPEND);
	?>

</body>

</html>