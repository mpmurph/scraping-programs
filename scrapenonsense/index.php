<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Nonsense Word Scraper</title>
	<meta charset="UTF-8">
</head>

<body>

	<?php

		//Error message and exit to prevent additions to an existing word list

		if (file_exists("/Applications/MAMP/htdocs/p2/wordlists/nonsensewords.txt")) {
			echo "A nonsensewords.txt file already exists in your p2/wordlists directory. To avoid appending to it, this program will terminate.";
			exit;
		}

		$nonsenseSource = file_get_contents("http://phrontistery.info/nonsense.html");
		preg_match_all("/<tr><td>(.*)<td>/", $nonsenseSource, $matches);

		$counter = count($matches[1], COUNT_RECURSIVE);

		for ($i=0; $i<$counter-1; $i++) {
			file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/nonsensewords.txt", $matches[1][$i]."\n", FILE_APPEND);
		}

		file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/nonsensewords.txt", $matches[1][$i], FILE_APPEND);
	?>

</body>

</html>