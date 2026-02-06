<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['produtos']) || !is_array($data['produtos'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error']);
    exit;
}

$_SESSION['produtos_comprados'] = $data['produtos'];
echo json_encode(['status' => 'success']);
