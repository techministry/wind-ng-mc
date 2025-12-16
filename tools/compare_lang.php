<?php
// Compare language files for missing keys

$en_content = file_get_contents(__DIR__ . '/../globals/language/english.php');
$gr_content = file_get_contents(__DIR__ . '/../globals/language/greek.php');

// Match array key assignments like 'key' => 
preg_match_all("/['\"]([a-z_0-9]+)['\"]\s*=>/i", $en_content, $en);
preg_match_all("/['\"]([a-z_0-9]+)['\"]\s*=>/i", $gr_content, $gr);

$en_keys = array_unique($en[1]);
$gr_keys = array_unique($gr[1]);

$missing_in_gr = array_diff($en_keys, $gr_keys);
$missing_in_en = array_diff($gr_keys, $en_keys);

echo "=== Language File Comparison ===\n\n";
echo "English keys: " . count($en_keys) . "\n";
echo "Greek keys: " . count($gr_keys) . "\n\n";

echo "Missing in Greek (" . count($missing_in_gr) . "):\n";
foreach ($missing_in_gr as $key) {
    echo "  - $key\n";
}

echo "\nMissing in English (" . count($missing_in_en) . "):\n";
foreach ($missing_in_en as $key) {
    echo "  - $key\n";
}

// Now check templates for used lang keys
echo "\n=== Checking templates for missing lang keys ===\n";
$tpl_files = glob(__DIR__ . '/../templates/basic/includes/**/*.tpl');
$tpl_files = array_merge($tpl_files, glob(__DIR__ . '/../templates/basic/includes/*.tpl'));

$used_keys = [];
foreach ($tpl_files as $file) {
    $content = file_get_contents($file);
    // Match {$lang.key} or {$lang['key']}
    preg_match_all('/\{\$lang\.([a-z_0-9]+)\}|\{\$lang\[[\'"]([a-z_0-9]+)[\'"]\]\}/i', $content, $matches);
    $used_keys = array_merge($used_keys, $matches[1], $matches[2]);
}
$used_keys = array_unique(array_filter($used_keys));

$missing_in_lang = array_diff($used_keys, $en_keys);
echo "\nLang keys used in templates but missing in language files (" . count($missing_in_lang) . "):\n";
foreach ($missing_in_lang as $key) {
    echo "  - $key\n";
}
