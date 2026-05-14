<?php
header('Content-Type: application/json');

if (php_sapi_name() !== 'cli') {
    $allowed_ips = ['127.0.0.1', '::1', '66.212.18.106'];
    if (!in_array($_SERVER['REMOTE_ADDR'] ?? '', $allowed_ips)) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'Forbidden']);
        exit;
    }
}

$config = require __DIR__ . '/config.php';

if (empty($config['server_key'])) {
    echo json_encode(['status' => 'error', 'message' => 'FCM_SERVER_KEY not set. Add it to your environment or fcm/config.php']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['token'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required field: token']);
    exit;
}

$payload = [
    'to' => $input['token'],
    'notification' => [
        'title' => $input['title'] ?? 'Code Panda Computers',
        'body' => $input['body'] ?? '',
        'sound' => 'default',
        'click_action' => $input['click_action'] ?? 'FLUTTER_NOTIFICATION_CLICK',
    ],
    'data' => $input['data'] ?? [],
];

if (isset($input['topic']) && $input['topic']) {
    $payload['to'] = '/topics/' . $input['topic'];
    unset($payload['to']);
}

$ch = curl_init($config['api_url']);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: key=' . $config['server_key'],
        'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_TIMEOUT => 10,
]);

$result = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo json_encode(['status' => 'error', 'message' => 'CURL error: ' . $error]);
    exit;
}

echo json_encode([
    'status' => $http_code === 200 ? 'success' : 'error',
    'http_code' => $http_code,
    'response' => json_decode($result, true),
]);
