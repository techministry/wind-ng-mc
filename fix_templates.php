<?php
/**
 * Script to fix Smarty 5 template compatibility issues.
 * - Quote unquoted file paths in {include} and {html_image} tags
 */

$templateDir = dirname(__FILE__) . '/templates/basic/';

// Find all .tpl files
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($templateDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::LEAVES_ONLY
);

$fixedCount = 0;

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'tpl') {
        continue;
    }
    
    $content = file_get_contents($file->getPathname());
    $original = $content;
    
    // Fix {include file=path/to/file.tpl ...} -> {include file="path/to/file.tpl" ...}
    $content = preg_replace_callback(
        '/\{include\s+([^}]*?)file=([a-zA-Z][a-zA-Z0-9_\/\.\-]*)([^}]*)\}/',
        function($matches) {
            return '{include ' . $matches[1] . 'file="' . $matches[2] . '"' . $matches[3] . '}';
        },
        $content
    );
    
    // Fix {include assign=var file=path ...} -> {include assign="var" file="path" ...}
    $content = preg_replace_callback(
        '/\{include\s+assign=([a-zA-Z_][a-zA-Z0-9_]*)\s+/',
        function($matches) {
            return '{include assign="' . $matches[1] . '" ';
        },
        $content
    );
    
    // Fix help=varname -> help="varname" (only for simple alphanumeric values)
    $content = preg_replace_callback(
        '/\bhelp=([a-zA-Z_][a-zA-Z0-9_]*)([}\s])/',
        function($matches) {
            return 'help="' . $matches[1] . '"' . $matches[2];
        },
        $content
    );
    
    // Fix confirm=TRUE -> confirm="TRUE"
    $content = preg_replace('/\bconfirm=TRUE\b/', 'confirm="TRUE"', $content);
    
    if ($content !== $original) {
        file_put_contents($file->getPathname(), $content);
        echo "Fixed: " . $file->getPathname() . "\n";
        $fixedCount++;
    }
}

echo "\nTotal files fixed: $fixedCount\n";
?>
