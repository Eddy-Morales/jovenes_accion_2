<?php
require __DIR__ . '/common.php';
save_post_to_session();
$next = $_GET['next'] ?? './no-profesionales/Info_general.php';
header("Location: $next");
exit;
