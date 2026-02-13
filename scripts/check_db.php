<?php
try {
    $db = new PDO('sqlite:'.__DIR__.'/../database/database.sqlite');
    $q = $db->query("SELECT id, email, name, is_admin FROM users WHERE email='admin@example.com' LIMIT 1");
    $admin = $q ? $q->fetch(PDO::FETCH_ASSOC) : null;
    $q2 = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='sessions'");
    $sessions = $q2 ? $q2->fetch(PDO::FETCH_ASSOC) : null;
    echo json_encode(['admin' => $admin, 'has_sessions' => (bool)$sessions]);
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
