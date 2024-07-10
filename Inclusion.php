<?php

function inclusion($settings) {
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

