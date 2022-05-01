<?php

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'http://localhost/project'); // Replace this value with your project path
}

if (!defined('API_DOMAIN_URL')) {
    define('API_DOMAIN_URL', 'https://sandbox.sslcommerz.com'); // Sandbox API URL
    // define('API_DOMAIN_URL', 'https://securepay.sslcommerz.com'); // Live API URL
}

if (!defined('STORE_ID')) {
    define('STORE_ID', 'iamsp626d0d800a2d5');
}

if (!defined('STORE_PASSWORD')) {
    define('STORE_PASSWORD', 'iamsp626d0d800a2d5@ssl');
}

if (!defined('IS_LOCALHOST')) {
    define('IS_LOCALHOST', true);
}

return [
    'projectPath' => constant("PROJECT_PATH"),
    'apiDomain' => constant("API_DOMAIN_URL"),
    'apiCredentials' => [
        'store_id' => constant("STORE_ID"),
        'store_password' => constant("STORE_PASSWORD"),
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v3/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => constant("IS_LOCALHOST"),
    'success_url' => 'payment/pg_redirection/success.php',
    'failed_url' => 'payment/pg_redirection/fail.php',
    'cancel_url' => 'payment/pg_redirection/cancel.php',
    'ipn_url' => 'pg_redirection/ipn.php',
];
