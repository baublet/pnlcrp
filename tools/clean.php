<?php

function scanDirectories($rootDir, $allData = array())
{
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
    $dirContent = scandir($rootDir);
    foreach ($dirContent as $key => $content) {
        // filter all files not accessible
        $path = $rootDir . '/' . $content;
        if (!in_array($content, $invisibleFileNames)) {
            // if content is file & readable, add to array
            if (is_file($path) && is_readable($path)) {
                // save file name with path
                $allData[] = $path;
            // if content is a directory and readable, add path and name
            } elseif (is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}

function removeAttributes(DOMNode $domNode)
{
    // Don't do this for iframes, since we need their width,
    // height, and other attributes
    if (isNodeType($domNode, ["iframe"])) {
        return;
    }
    if ($domNode->hasAttributes()) {
        $domNode->removeAttribute("style");
        $domNode->removeAttribute("height");
        $domNode->removeAttribute("width");
        $domNode->removeAttribute("border");
        $domNode->removeAttribute("align");
        $domNode->removeAttribute("size");
        $domNode->removeAttribute("face");
        $domNode->removeAttribute("bgcolor");
        $domNode->removeAttribute("onfocus");
        $domNode->removeAttribute("align");
        $domNode->removeAttribute("onblur");
        $domNode->removeAttribute("onmouseout");
        $domNode->removeAttribute("onmouseover");
        $domNode->removeAttribute("cellspacing");
        $domNode->removeAttribute("colspan");
        $domNode->removeAttribute("rowspan");
        $domNode->removeAttribute("valign");
        foreach ($domNode->attributes as $attribute) {
            if (empty($attribute->value)) {
                $domNode->removeAttribute($attribute->name);
            }
        }
    }
    if ($domNode->hasChildNodes()) {
        foreach ($domNode->childNodes as $child) {
            removeAttributes($child);
        }
    }
}

function removeUnusedElements(DOMNode $domNode)
{
    if (isNodeType($domNode, ["style", "script", "link", "meta"])) {
        $parent = $domNode->parentNode;
        $parent->removeChild($domNode);
        removeUnusedElements($parent);
        return;
    }
    if (method_exists($domNode, "hasChildNodes") && $domNode->hasChildNodes()) {
        foreach ($domNode->childNodes as $child) {
            removeUnusedElements($child);
        }
    }
}

function removeInlineUtf8($output)
{
    return str_replace(
        ["‘", "’", "“", "”"],
        ["&lsquo;", "&rsquo;", "&ldquo;", "&rdquo;"],
        $output
    );
}

function removeMsoStuff($output)
{
    return str_replace(
        ["class=\"MsoNormal\"", "class=\"arial10\""],
        ["", ""],
        $output
    );
}

function removeWhiteSpace($output)
{
    return preg_replace(
        ["/>\s+/", "/\s+/", "/\s+</", "/<p>\s+/"],
        ["> "  ,    " ",     " <",    "<p>"],
        $output
    );
}

function removeNbsp($output)
{
    return preg_replace(
        "/\&?nbsp;?/",
        " ",
        $output
    );
}

function removeComments($output)
{
    return preg_replace(
        "/\<\!\-\-.*\-\-\>/U",
        "",
        $output
    );
}

function removeFontTags($output)
{
    return preg_replace(
        [
            "/<font.*>/U",
            "/<\/font>/U",
            "/<center>/U",
            "/<\/center>/U"
        ],
        ["", "", "", ""],
        $output
    );
}

function removeTables($output)
{
    return preg_replace(
        [   "/<table.*>/U", "/<\/table>/U",
            "/<tr.*>/U", "/<\/tr>/U",
            "/<td.*>/U", "/<\/td>/U",
            "/<tbody.*>/U", "/<\/tbody>/U",
        ],
        ["", "", "", "", "", "", ""],
        $output
    );
}

function prettify($output)
{
    $dom = new DOMDocument();

    $dom->preserveWhiteSpace = false;
    $dom->loadHTML($output, LIBXML_HTML_NOIMPLIED);
    $dom->formatOutput = true;

    return $dom->saveXML($dom->documentElement);
}

function removeEmptyNodes(DOMNode $domNode)
{
    if (isNodeType($domNode, ["span", "div"])) {
        if (!$domNode->hasChildNodes()) {
            $parentNode = $domNode->parentNode;
            $parentNode->removeChild($domNode);
            removeEmptyNodes($parentNode);
            return;
        }
        // If it has only one child node, just replace this one with the
        // child node
        if ($domNode->childNodes->length == 1) {
            $parentNode = $domNode->parentNode;
            $parentNode->replaceChild($domNode->firstChild, $domNode);
            removeEmptyNodes($parentNode);
            return;
        }
    }
    if ($domNode->hasChildNodes()) {
        foreach ($domNode->childNodes as $child) {
            removeEmptyNodes($child);
        }
    }
}

// Returns true if $domNode is one of tag of type $tagNames
function isNodeType(DOMNode $domNode, array $tagNames)
{
    if (!property_exists($domNode, "tagName")) {
        return false;
    }
    $nodeTag = strtolower($domNode->tagName);
    foreach ($tagNames as $tag) {
        if (strtolower($tag) == $nodeTag) {
            return true;
        }
    }
    return false;
}

// Returns "true" if $domNode has any attribute in the array $attributeNames
function nodeHasAttributes(DOMNode $domNode, array $attributeNames)
{
    if (!$domNode->hasAttributes()) {
        return false;
    }
    foreach ($attributeNames as $attributeName) {
        foreach ($domNode->attributes as $domAttribute) {
            if ($domAttribute->name == $attributeName) {
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
$preprocessors = [
    "removeInlineUtf8"
];

$processors = [
    "removeAttributes",
    "removeUnusedElements",
    "removeEmptyNodes"
];

$postProcessors = [
    "removeMsoStuff",
    "removeNbsp",
    "removeComments",
    "removeTables",
    "removeFontTags",
    "removeWhiteSpace",
    "prettify"
];

foreach ($files as $file) {
    $source = $file;
    $target = str_replace($sourceDirectory, $targetDirectory, $file);
    $fileContents = file_get_contents($source);

    echo "Running filters on " . $file . " ";

    foreach ($preprocessors as $process) {
        $fileContents = $process($fileContents);
    }

    $doc = new DOMDocument();
    @$doc->loadHTML($fileContents);

    foreach ($processors as $process) {
        $process($doc->documentElement);
    }

    $newContents = $doc->saveHTML();

    foreach ($postProcessors as $process) {
        $newContents = $process($newContents);
    }
    
    file_put_contents($target, $newContents);
    echo strlen($fileContents) . " -> " . strlen($newContents) . "\n\n";
}

echo "\n\n";
