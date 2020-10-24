<?php

use PhpParser\Node\Stmt\TryCatch;

require 'vender/autoload.php';
$ids = require('paypal.php');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']
    )
);

$cart = $cart->getProducts();
$payment = \PayPal\Api\Payment::get($_GET['paymentId'], $apiContext);

$execution = (new \PayPal\Api\PaymentExecution())
    ->setPayerId($_GET['PayerID'])
    ->setTransactions($payment->getTransactions());

try {
    $payment->execute($execution, $apiContext);
} catch (\PayPal\Exception\PayPalConnectionException $e) {
    
}

$payment->execute($execution, $apiContext);