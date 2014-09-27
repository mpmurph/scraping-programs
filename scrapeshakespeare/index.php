<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Shakespeare Word Scraper</title>
	<meta charset="UTF-8">
</head>

<body>

	<?php

		//Error message and exit to prevent additions to an existing word list

		if (file_exists("/Applications/MAMP/htdocs/p2/wordlists/shakespearewords.txt")) {
			echo "A shakespearewords.txt file already exists in your p2/wordlists directory. To avoid appending to it, this program will terminate.";
			exit;
		}

		//Establishing an array with the number of web pages on the site that we are extracting the data from

		$pages = array("1","2","3","4","5","6","7","8","9");

		//Scrape the words for the pages "1-8" into text file shakespearewords.txt

		for ($i=0; $i<count($pages)-1; $i++) {

			$shakespeareSource = file_get_contents("http://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Complete_Shakespeare_wordlist_".$pages[$i]);
			$cleaned = preg_split("</h2>", $shakespeareSource, 2);
			$shakespeareSource = array_pop($cleaned);
			$cleaned = preg_split("<noscript>", $shakespeareSource, 2);
			array_pop($cleaned);
			$shakespeareSource = array_pop($cleaned);
			$cleaned = preg_split("/p>/", $shakespeareSource);

			//var_dump($cleaned);

			$count = count($cleaned);
			$shakespeareSourceFinal = "";

			for ($k=0; $k<$count; $k++) {
				array_pop($cleaned);
				$shakespeareSourceFinal = $shakespeareSourceFinal."\n".array_pop($cleaned);
			}

			//echo $shakespeareSourceFinal;

			preg_match_all("/\">(\w*)<\/a>/", strtolower($shakespeareSourceFinal), $matches);

			//var_dump($matches[1]);
			sort ($matches[1]);

			$counter = count($matches[1], COUNT_RECURSIVE);

			for ($j=0; $j<$counter; $j++) {
				file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/shakespearewords.txt", $matches[1][$j]."\n", FILE_APPEND);
			}
		}

		//Scrape the words from the last page, making sure that there is no extra line at the end of the .txt file

			$shakespeareSource = file_get_contents("http://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Complete_Shakespeare_wordlist_".$pages[$i]);
			$cleaned = preg_split("</h2>", $shakespeareSource, 2);
			$shakespeareSource = array_pop($cleaned);
			$cleaned = preg_split("<noscript>", $shakespeareSource, 2);
			array_pop($cleaned);
			$shakespeareSource = array_pop($cleaned);
			$cleaned = preg_split("/p>/", $shakespeareSource);

			$count = count($cleaned);
			$shakespeareSourceFinal = "";

			for ($k=0; $k<$count; $k++) {
				array_pop($cleaned);
				$shakespeareSourceFinal = $shakespeareSourceFinal."\n".array_pop($cleaned);
			}

			preg_match_all("/\">(\w*)<\/a>/", strtolower($shakespeareSourceFinal), $matches);
			sort ($matches[1]);

			$counter = count($matches[1], COUNT_RECURSIVE);

			for ($j=0; $j<$counter-1; $j++) {
				file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/shakespearewords.txt", $matches[1][$j]."\n", FILE_APPEND);
			}

			file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/shakespearewords.txt", $matches[1][$j], FILE_APPEND);
	?>

</body>

</html>