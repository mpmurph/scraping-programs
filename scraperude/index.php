<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Sound-Like-They're-Rude Words Scraper</title>
	<meta charset="UTF-8">
</head>

<body>

	<?php

		//Error message and exit to prevent additions to an existing word list

		if (file_exists("/Applications/MAMP/htdocs/p2/wordlists/notreallyrudewords.txt")) {
			echo "A notreallyrudewords.txt file already exists in your p2/wordlists directory. To avoid appending to it, this program will terminate.";
			exit;
		}

		$rudeSource = file_get_contents("http://mentalfloss.com/article/58036/50-words-sound-rude-actually-arent");
		preg_match_all("/<h4>\d*. (.*)<\/h4>/", $rudeSource, $matches);

		var_dump($matches);

		$counter = count($matches[1], COUNT_RECURSIVE);

		for ($i=0; $i<$counter-1; $i++) {
			file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/notreallyrudewords.txt", strtolower($matches[1][$i])."\n", FILE_APPEND);
		}

		file_put_contents("/Applications/MAMP/htdocs/p2/wordlists/notreallyrudewords.txt", strtolower($matches[1][$i]), FILE_APPEND);
	?>

</body>

</html>