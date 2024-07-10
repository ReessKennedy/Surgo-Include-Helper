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
 * Function to generate stats for file existence.
 * 
 * @param string $filePath The full path to the file.
 * @param string $outputType The type of output (bool, text, or emoji).
 * @return array Array containing file path and existence status.
 */
function InclusionStats($filePath, $outputType = 'bool') {
    $fileExists = file_test($filePath);

    $status = $fileExists;
    if ($outputType === 'emoji') {
        $status = $fileExists ? '✅' : '❌';
    } elseif ($outputType === 'text') {
        $status = $fileExists ? true : false;
    }

    return [
        'file' => $filePath,
        'exists' => $status
    ];
}

/**
 * Function to merge an array of file names with a given path from settings,
 * and include additional stats if required.
 * 
 * @param array $settings Associative array containing 'path', 'files', 'suffix', and 'stats' keys.
 * @return array Array of full paths of files that exist, or detailed stats if 'stats' is set.
 */
function inclusion($settings) {
    // Default settings
    $defaultSettings = [
        'path' => '',
        'files' => [],
        'suffix' => '', // Optional suffix for file names
        'stats' => false // Optional stats setting
    ];
    
    // Merge default settings with user-provided settings
    $settings = array_merge($defaultSettings, $settings);
    
    if (empty($settings['path']) || empty($settings['files'])) {
        throw new InvalidArgumentException('Settings must include both "path" and "files" keys.');
    }

    $path = rtrim($settings['path'], '/') . '/';
    $files = $settings['files'];
    $suffix = $settings['suffix'];
    $stats = $settings['stats'];
    
    $fullPaths = array();
    foreach ($files as $file) {
        $fullPath = $path . $file . $suffix;

        if ($stats) {
            $fullPaths[] = InclusionStats($fullPath, $stats);
        } else {
            if (file_test($fullPath)) {
                $fullPaths[] = $fullPath;
            }
        }
    }
    
    return $fullPaths;
}