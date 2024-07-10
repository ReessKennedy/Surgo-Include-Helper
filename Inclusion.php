<?php

// Example usage
$incs = array(
    'api_requests',  // This is the API request snippet
    'surgo_table_td',	
    'surgo_table_css_1',
    'pretty_array',
    'surgo_inputs',
    'time_ago',
    'time_ago2',
    'time_test',
    'debug'
);

function surgo_include($path, $files) {
    // Ensure the path ends with a directory separator
    $path = rtrim($path, '/') . '/';
    
    $fullPaths = array();
    foreach ($files as $file) {
        $fullPaths[] = $path . $file;
    }
    
    return $fullPaths;
}

$fullPaths = surgo_include('path/to/my/snippets', $incs);
print_r($fullPaths);