<!DOCTYPE html>
<html>
<head>
	<title>Refresh Page</title>
	<link rel="stylesheet" href="5style.css">
</head>
<body>

	<?php
		echo "<h1> REFRESH PAGE</h1>";
		$file='count.txt';
		$c=file_get_contents($file);
		file_get_contents($file,$c+1);
		echo "The number of users visited:".$c;

</body>
</html>