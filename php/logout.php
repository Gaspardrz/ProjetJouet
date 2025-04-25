<?php
include __DIR__ . '/../php/includes/header.php';
include __DIR__ . '/php/includes/footer.php';
session_start();
session_destroy();
header("Location: ../index.html");
exit();
?>
