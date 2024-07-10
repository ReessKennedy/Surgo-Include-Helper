<?php 
include('inclusion.php');

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

$fullPaths = inclusion($settings);
print_r($fullPaths);