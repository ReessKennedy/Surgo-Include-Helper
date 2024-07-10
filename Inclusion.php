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
 * @param string $fileName The file name.
 * @param string $filePath The full path to the file.
 * @param string $outputType The type of output (bool, text, or emoji).
 * @return array Array containing file name and existence status.
 */
function StatsVar($fileName, $filePath, $outputType = 'bool') {
    $fileExists = file_test($filePath);

    $status = $fileExists;
    if ($outputType === 'emoji') {
        $status = $fileExists ? '✅' : '❌';
    } elseif ($outputType === 'text') {
        $status = $fileExists ? 'exists' : 'does not exist';
    }

    return [
        'file' => $fileName,
        'exists' => $status
    ];
}

/**
 * Function to display stats in different formats.
 * 
 * @param array $stats The array of stats to be displayed.
 * @param string $displayType The type of display (array, text_csv).
 * @return mixed Formatted stats based on display type.
 */
function StatsDisplay($stats, $displayType = 'array') {
    if ($displayType === 'text_csv') {
        $csvOutput = '';
        foreach ($stats as $stat) {
            $csvOutput .= $stat['file'] . ' ' . $stat['exists'] . ', ';
        }
        return rtrim($csvOutput, ', ');
    }
    return $stats; // Default is to return the array
}

/**
 * Function to merge an array of file names with a given path from settings,
 * and include additional stats if required.
 * 
 * @param array $settings Associative array containing 'path', 'files', 'suffix', 'stats', and 'display' keys.
 * @return mixed Array of file names that exist, or detailed stats if 'stats' is set, formatted by 'display' setting.
 */
function inclusion($settings) {
    // Default settings
    $defaultSettings = [
        'path' => '',
        'files' => [],
        'suffix' => '', // Optional suffix for file names
        'stats' => false, // Optional stats setting
        'display' => 'array' // Optional display setting
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
    $display = $settings['display'];
    
    $fullPaths = array();
    foreach ($files as $file) {
        $fullPath = $path . $file . $suffix;

        if ($stats === 'emoji' || $stats === 'text') {
            $fullPaths[] = StatsVar($file, $fullPath, $stats);
        } else {
            if (file_test($fullPath)) {
                $fullPaths[] = $file;
            }
        }
    }
    
    if ($stats === 'emoji' || $stats === 'text') {
        return StatsDisplay($fullPaths, $display);
    } elseif (!$stats) {
        return $fullPaths;
    } else {
        return ''; // Return an empty string if stats is set but not to 'text_csv' or 'array'
    }
}

