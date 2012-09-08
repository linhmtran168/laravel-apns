<?php
/**
 * Laravel wrapper of apns-php (http://code.google.com/p/apns-php/) for sending notification to Apple Notification Service
 * 
 * @package     Bundles
 * @subpackage  PHP-APNS
 * @author      Linh M. Tran
 *
 */

// Load APNS autoloader function
require __DIR__ . DS . 'ApnsPHP' . DS . 'Abstract.php';
require __DIR__ . DS . 'ApnsPHP' . DS . 'Exception.php';
require __DIR__ . DS . 'ApnsPHP' . DS . 'Message' . DS . 'Exception.php';
require __DIR__ . DS . 'ApnsPHP' . DS . 'Message.php';
require __DIR__ . DS . 'ApnsPHP' . DS . 'Push' . DS . 'Exception.php';
require __DIR__ . DS . 'ApnsPHP' . DS . 'Push.php';
require __DIR__ . DS . 'ApnsPHP' . DS . 'Log' . DS . 'Interface.php';
require __DIR__ . DS . 'ApnsPHP' . DS . 'Log' . DS . 'Embedded.php';


// Register a push instance in the Ioc Containter
Laravel\IoC::singleton('push', function() {
    // Custom variable
    // Is in dev mode
    $isDev = false;

    // App certificate
    $app_cert_dev = "";
    $app_cert_dis = "";

    // Entrust root certificate
    // $entrust_cert = "entrust_root_certification_authority.pem";

    // Instanciate a new ApnsPHP_Push object
    if ($isDev)
    {
        $push = new ApnsPHP_Push(
            ApnsPHP_Abstract::ENVIRONMENT_SANDBOX, __DIR__ . DS . 'certs' . DS . $app_cert_dev
        );
    }
    else
    {
        $push = new ApnsPHP_Push(
            ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION, __DIR__ . DS . 'certs' . DS . $app_cert_dis
        );
    }

    // Set the Root Certificate Autority to verify the Apple remote peer
    // $push->setRootCertificationAuthority(__DIR__ . DS . 'certs' . DS . $entrust_cert);

    return $push;
});


// Create the autoload map for Message
Autoloader::directories(array(
    __DIR__ . '/ApnsPHP',
    __DIR__ . '/ApnsPHP/Message',
    __DIR__ . '/ApnsPHP/Push',
    __DIR__ . '/ApnsPHP/Log',
    __DIR__ . '/ApnsPHP/Push/Server',
));
