<?php

// Calculate Shannon Entropy for the given filename
//
// Chris Ridings - http://www.chrisridings.com
//

// Check for file error conditions
if (!isset($argv[1])) {
	echo "php entropy.php <filename>\n";
	exit;
}

if (!file_exists($argv[1])) {
	echo "File not found\n";
	exit;
}

// Initialise our character count array
$chars = array();

// Read in the file and adjust the counts
$handle = fopen($argv[1], "r");
$charcount = 0;
while ($thischar = fread($handle, 1)) {
	if (!isset($chars[ord($thischar)])) {
		$chars[ord($thischar)] = 0;
	}
	$chars[ord($thischar)]++;
	$charcount++;
}

// Next calculate the entropy
$entropy = 0.0;
foreach ($chars as $val) {
	$p = $val / $charcount;
	$entropy = $entropy - ($p * log($p,2));
}

echo $entropy;

?>
