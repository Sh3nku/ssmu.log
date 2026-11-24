<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );

$status = '';

if ( $_COOKIE['cookie'] === 'accepted' || $_COOKIE['cookie'] === 'declined' ) {
    $status = $_COOKIE['cookie'];
} else if ( !empty( $_REQUEST['param'] ) ) {
    $status = $_REQUEST['param'];

    setcookie( 'cookie', $status, [
        'expires' => time() + ( 365 * 24 * 60 * 60 ),
        'path' => '/',
        'domain' => '',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
} else {
    $status = 'unset';
}

echo json_encode([
    'status' => 'success',
    'data' => [
        'status' => $status
    ],
    'errors' => []
]);