<?php

require __DIR__ . '/includes/autoload.php';

if (isset($_GET['controller'])) {
    $url = $_GET['controller'];
    $file = __DIR__ . '/controller/' . $url . '.php';
    if (file_exists($file)){
        include_once $file;
    } else {
        header("HTTP/1.0 404 Not Found");
        echo '404 Page Not Found';
    }
} else {
    require_once __DIR__ . '/views/index.php';
}