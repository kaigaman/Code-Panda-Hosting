<?php
try {
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$domain = isset($_GET['q']) ? trim($_GET['q']) : '';

if (!$domain) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide a domain name (q parameter).']);
    exit;
}

$domain = strtolower($domain);
$domain = preg_replace('/^https?:\/\//', '', $domain);
$domain = preg_replace('/^www\./', '', $domain);
$domain = preg_replace('/\s/', '', $domain);

if (!preg_match('/^[a-z0-9]([a-z0-9\-]*[a-z0-9])?(\.[a-z]{2,})+$/', $domain)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid domain format. Please enter a valid domain (e.g., example.com).'
    ]);
    exit;
}

$response = [
    'status' => 'success',
    'domain' => $domain,
    'whois_data' => null,
    'registered' => null,
    'source' => 'dns_check'
];

if (function_exists('shell_exec') && !in_array('shell_exec', explode(',', ini_get('disable_functions') ?? ''))) {
    $whois_output = @shell_exec('whois ' . escapeshellarg($domain) . ' 2>&1');
    if ($whois_output && strlen(trim($whois_output)) > 10) {
        $lines = explode("\n", $whois_output);
        $parsed = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || preg_match('/^%/', $line)) continue;
            if (strpos($line, ':') !== false) {
                list($key, $val) = explode(':', $line, 2);
                $parsed[trim($key)] = trim($val);
            }
        }
        $response['whois_data'] = $parsed;
        $response['source'] = 'whois_command';
    }
}

$response['registered'] = $response['whois_data'] !== null
    ? true
    : (function_exists('checkdnsrr') ? checkdnsrr($domain, 'ANY') : null);

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Internal server error: ' . $e->getMessage()]);
}
