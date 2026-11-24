<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/vendor/autoload.php';

use Bitrix\Main\Loader;

\Bitrix\Main\Loader::includeModule('paraweb.local');
\Paraweb\Local\Models\EventHandlers::addEventHandlers();
header('Access-Control-Allow-Origin: https://medclass.ssmu.ru');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache");

Loader::registerAutoLoadClasses( null, [
    'Approval\Cookie' => '/local/php_interface/classes/Approval/Cookie.php',
    'Approval\Form' => '/local/php_interface/classes/Approval/Form.php'
]);

AddEventHandler( 'form', 'onAfterResultAdd', function ( $WEB_FORM_ID, $RESULT_ID )  {
    Approval\Form::Log( $WEB_FORM_ID );
});

if (class_exists('\\Dotenv\\Dotenv')) {
    $env = \Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $env->load();
    define('ENV_LOADED', true);
}

if (class_exists('\Sentry\SentrySdk')) {
    \Sentry\init([
        'dsn' => 'https://f17a6385a6450969395bc22610d38bb8@sentry.hope.paraweb.space/2',
        'environment' => 'production',
    ]);
}
