<?php
// autoload.php - Handles automatic class loading

spl_autoload_register(function ($className) {
    // Replace namespace separators with directory separators
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    // First try with namespaces
    $file = __DIR__ . DIRECTORY_SEPARATOR . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }

    // Then try common directories for classes without full namespace path
    $classNameOnly = basename(str_replace('\\', '/', $className));
    $directories = ['Models', 'Views', 'Controllers', 'Classes'];

    foreach ($directories as $dir) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $classNameOnly . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Finally try the root directory
    $file = __DIR__ . DIRECTORY_SEPARATOR . $classNameOnly . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
});