<?php

/**
 * Function to check whether a file exists at the specified path.
 * 
 * @param string $filePath The full path to the file.
 * @return bool True if the file exists, false otherwise.
 */
function file_test($filePath) {
    return file_exists($filePath);
}

/**
 * Function to merge an array of file names with a given path from settings,
 * and include only the files that exist.
 * 
 * @param array $settings Associative array containing 'path' and 'files' keys.
 * @return array Array of full paths of files that exist.
 */
function inclusion($settings) {
    // Default settings
    $defaultSettings = [
        'path' => '',
        'files' => [],
        'suffix' => '', // Optional suffix for file names
    ];
    
    // Merge default settings with user-provided settings
    $settings = array_merge($defaultSettings, $settings);
    
    if (empty($settings['path']) || empty($settings['files'])) {
        throw new InvalidArgumentException('Settings must include both "path" and "files" keys.');
    }

    $path = rtrim($settings['path'], '/') . '/';
    $files = $settings['files'];
    $suffix = $settings['suffix'];
    
    $fullPaths = array();
    foreach ($files as $file) {
        $fullPath = $path . $file . $suffix;
       if (file_test($fullPath)) {
            $fullPaths[] = $fullPath;
        }
    }
    
    return $fullPaths;
}
