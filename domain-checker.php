<?php
$domain = isset($_GET['domain']) ? trim($_GET['domain']) : '';
$action = isset($_GET['action']) ? trim($_GET['action']) : 'register';

header('Content-Type: application/json');

if (!$domain) {
    echo json_encode(['status' => 'error', 'message' => 'Please enter a domain name.']);
    exit;
}

$domain = strtolower($domain);
$domain = preg_replace('/^https?:\/\//', '', $domain);
$domain = preg_replace('/^www\./', '', $domain);
$domain = preg_replace('/\s/', '', $domain);

if (!preg_match('/^[a-z0-9]([a-z0-9\-]*[a-z0-9])?(\.[a-z]{2,})+$/', $domain)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid domain format. Please enter a valid domain (e.g., example.com).']);
    exit;
}

$tlds = [
    'com' => ['register' => 40000, 'renew' => 40000, 'transfer' => 40000],
    'net' => ['register' => 40000, 'renew' => 40000, 'transfer' => 40000],
    'org' => ['register' => 40000, 'renew' => 40000, 'transfer' => 40000],
    'info' => ['register' => 70000, 'renew' => 70000, 'transfer' => 70000],
    'me' => ['register' => 60000, 'renew' => 60000, 'transfer' => 60000],
    'biz' => ['register' => 70000, 'renew' => 70000, 'transfer' => 70000],
    'co' => ['register' => 70000, 'renew' => 70000, 'transfer' => 70000],
    'tv' => ['register' => 110000, 'renew' => 110000, 'transfer' => 110000],
    'shop' => ['register' => 130000, 'renew' => 130000, 'transfer' => 130000],
    'church' => ['register' => 110000, 'renew' => 110000, 'transfer' => 110000],
    'app' => ['register' => 70000, 'renew' => 70000, 'transfer' => 70000],
    'africa' => ['register' => 80000, 'renew' => 80000, 'transfer' => 80000],
    'tours' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'co.ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'or.ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'ac.ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'sc.ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'org.ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'com.ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
    'go.ug' => ['register' => 100000, 'renew' => 100000, 'transfer' => 100000],
];

$parts = explode('.', $domain);
$ext = implode('.', array_slice($parts, 1));
$name = $parts[0];

$price = isset($tlds[$ext]) ? $tlds[$ext][$action] : null;

if ($action === 'transfer') {
    $whmcs_url = "https://core.code-panda.online/order/domain-transfer?domain=" . urlencode($domain);
} else {
    $whmcs_url = "https://core.code-panda.online/order/domain-registration?domain=" . urlencode($domain);
}

$available = false;
if (function_exists('checkdnsrr')) {
    $available = !checkdnsrr($domain, 'ANY');
} else {
    $available = true;
}

$search_suggestions = [];
if (!$available) {
    $alt_exts = ['com', 'net', 'org', 'co.ug', 'ug', 'info', 'biz'];
    foreach ($alt_exts as $alt_ext) {
        if ($alt_ext !== $ext) {
            $alt_domain = $name . '.' . $alt_ext;
            $alt_price = isset($tlds[$alt_ext]['register']) ? number_format($tlds[$alt_ext]['register']) . ' Ugx' : 'N/A';
            $search_suggestions[] = [
                'domain' => $alt_domain,
                'price' => $alt_price,
                'url' => "https://core.code-panda.online/order/domain-registration?domain=" . urlencode($alt_domain)
            ];
        }
    }
}

echo json_encode([
    'status' => $available ? 'available' : 'unavailable',
    'domain' => $domain,
    'action' => $action,
    'price' => $price ? number_format($price) . ' Ugx' : null,
    'whmcs_url' => $whmcs_url,
    'suggestions' => $search_suggestions
]);
