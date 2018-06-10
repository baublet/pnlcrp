<?php

$sourceDirectory = __DIR__ . "/../old";
$targetDirectory = __DIR__ . "/../formatted";
$settingsDirectory = __DIR__ . "/settings";

// Load up the toRemove.txt regexes
$rawRemovers = file_get_contents($settingsDirectory . "/toRemove.txt");
$removers = explode("\n", $rawRemovers);

// Load our replacers
$rawReplacers = file_get_contents($settingsDirectory . "/toReplace.txt");
$replacerLines = explode("\n", $rawReplacers);
$replacers = array_map(function($replacer) {
	$elements = explode(",", $replacer);
	return [trim($elements[0]), trim($elements[1])];
}, $replacerLines);

echo "\n\n";
echo "Ryan Poe's mass static-file site cleaner...";
echo "\n\n";

// Run it
$files = scanDirectories($sourceDirectory);

foreach($files as $file) {

	$source = $file;
	$target = str_replace($sourceDirectory, $targetDirectory, $file);
	$fileContents = file_get_contents($source);

	echo "Running filters on " . $file . "\n";

	foreach($removers as $remover) {
		$fileContents = remove($remover, $fileContents);
	}

	foreach($replacers as $replacer) {
		$fileContents = replace($replacer[0], $replacer[1], $fileContents);
	}

	if(!file_exists($target)) {
		touch($target);
	}

	file_put_contents($target, $fileContents);
}

echo "\n\n";

function remove($remover, $content) {
	$match = "/" . $remover . "/isU";
	while(preg_match($match, $content)) {
		$content = preg_replace($match, "", $content);
	}
	return $content;
}

function replace($what, $withWhat, $content) {
	$match = "/" . $what . "/isU";
	while(preg_match($match, $content)) {
		$content = preg_replace($match, $withWhat, $content);
	}
	return $content;
}

function scanDirectories($rootDir, $allData = array()) {
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) {
        // filter all files not accessible
        $path = $rootDir.'/'.$content;
        if(!in_array($content, $invisibleFileNames)) {
            // if content is file & readable, add to array
            if(is_file($path) && is_readable($path)) {
                // save file name with path
                $allData[] = $path;
            // if content is a directory and readable, add path and name
            }elseif(is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}