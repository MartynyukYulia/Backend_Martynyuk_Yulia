<?php

if (isset($_GET['size'])) {

    $size = $_GET['size'];

    switch ($size) {
        case 'big':
            setcookie('font_size', '24px', time() + 3600, '/');
            break;
        case 'medium':
            setcookie('font_size', '16px', time() + 3600, '/');
            break;
        case 'small':
            setcookie('font_size', '12px', time() + 3600, '/');
            break;
    }
}

header('Location: index.php');
exit();
