<?php
session_start();

if (isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    if ($theme === 'dark' || $theme === 'light') {
        $_SESSION['theme'] = $theme;
    }
}
?>