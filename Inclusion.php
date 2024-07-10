<?php

function surgo_include($settings) {
    if (!isset($settings['path']) || !isset($settings['files'])) {
        throw new InvalidArgumentException('Settings must include both "path" and "files" keys.');
    }

    $path = rtrim($settings['path'], '/') . '/';
    $files = $settings['files'];
    
    $fullPaths = array();
    foreach ($files as $file) {
        $fullPaths[] = $path . $file;
    }
    
    return $fullPaths;
}

// Example usage
$settings = array(
    'path' => 'path/to/my/snippets',
    'files' => array(
        'api_requests',  // This is the API request snippet
        'surgo_table_td',	
        'surgo_table_css_1',
        'pretty_array',
        'surgo_inputs',
        'time_ago',
        'time_ago2',
        'time_test',
        'debug'
    )
);

$fullPaths = surgo_include($settings);
print_r($fullPaths);