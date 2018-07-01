<?php

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
            } elseif(is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}

function removeAttributes(DOMNode $domNode) {
	if($domNode->hasAttributes()) {
		$domNode->removeAttribute("style");
		$domNode->removeAttribute("height");
		$domNode->removeAttribute("width");
		$domNode->removeAttribute("border");
		$domNode->removeAttribute("align");
		foreach($domNode->attributes as $attribute) {
			if(empty($attribute->value)) {
				$domNode->removeAttribute($attribute->name);
			}
		}
	}
	if($domNode->hasChildNodes()) {
		foreach($domNode->childNodes as $child) {
			removeAttributes($child);
		}
	}
}

function removeStyleElements(DOMNode $domNode) {
	if(isNodeType($domNode, ["style"])) {
		$domNode->parentNode->removeChild($domNode);
	}
	if(method_exists($domNode, "hasChildNodes") && $domNode->hasChildNodes()) {
		foreach($domNode->childNodes as $child) {
			removeStyleElements($child);
		}
	}
}

function removeEmptyNodes(DOMNode $domNode) {
	echo ".";
	if(isNodeType($domNode, ["span", "div"])) {
		if(!$domNode->hasChildNodes()) {
			$parentNode = $domNode->parentNode;
			$parentNode->removeChild($domNode);
			removeEmptyNodes($parentNode);
			return;
		}
		// If it has only one child node, just replace this one with the
		// child node
		if($domNode->childNodes->length == 1) {
			$parentNode = $domNode->parentNode;
			$parentNode->replaceChild($domNode->firstChild, $domNode);
			removeEmptyNodes($parentNode);
			return;
		}
	}
	if($domNode->hasChildNodes()) {
		foreach($domNode->childNodes as $child) {
			removeEmptyNodes($child);
		}
	}
}

// Returns true if $domNode is one of tag of type $tagNames
function isNodeType(DOMNode $domNode, array $tagNames) {
	if(!property_exists($domNode, "tagName")) {
		return false;
	}
	return in_array($domNode->tagName, $tagNames);
}

// Returns "true" if $domNode has any attribute in the array $attributeNames
function nodeHasAttributes(DOMNode $domNode, array $attributeNames) {
	if(!$domNode->hasAttributes()) return false;
	foreach($attributeNames as $attributeName) {
		foreach($domNode->attributes as $domAttribute) {
			if($domAttribute->name == $attributeName) {
				return true;
			}
		}
	}
	return false;
}

$sourceDirectory = __DIR__ . "/../old/test";
$targetDirectory = __DIR__ . "/../formatted";

echo "\n\n";
echo "Ryan Poe's mass static-file site cleaner...";
echo "\n\n";

// Load up all  of our files
$files = scanDirectories($sourceDirectory);

// Setup our processor functions
$processors = [
	"removeAttributes",
	"removeStyleElements",
	"removeEmptyNodes"
];

foreach($files as $file) {

	$source = $file;
	$target = str_replace($sourceDirectory, $targetDirectory, $file);
	$fileContents = file_get_contents($source);

	echo "Running filters on " . $file . " ";

	$doc = new DOMDocument();
	$doc->loadHTML($fileContents);

	foreach($processors as $process) {
		$process($doc->documentElement);
	}

	$newContents = $doc->saveHTML();
	
	file_put_contents($target, $doc->saveHTML());
	echo strlen($fileContents) . "  -> " . strlen($doc->saveHTML()) . "\n\n";
}

echo "\n\n";