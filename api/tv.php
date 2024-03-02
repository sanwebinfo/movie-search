<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('Content-Type: application/json');
header('X-Robots-Tag: noindex, nofollow', true);

include '../class/store.php';
(new DevCoder\DotEnv('../.env'))->load();

$API = getenv('APIKEY');

$apiKey = $API;

$itemId = $_GET['id'] ?? '';
if (empty($itemId)) {
    http_response_code(400);
    die('Item ID is missing.');
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

$tmdbUrl = 'https://api.themoviedb.org/3/tv/' . urlencode(sanitizeInput($itemId)) . '?api_key=' . urlencode($apiKey) . '&append_to_response=credits';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $tmdbUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if(curl_error($ch)) {
    http_response_code(500);
    die('Error: ' . curl_error($ch));
}

curl_close($ch);

http_response_code(200);
echo $response;

?>