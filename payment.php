<?php

require 'vendor/autoload.php';
require 'src/Service/Cart/CartService.php';

$ids = require('paypal.php');
$cart = $cart->getFullCart();

$apiContext = new \Paypal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']
    )
);

// pacourrir la liste des produits
$list = new \PayPal\Api\ItemList();
foreach ($cart->getProducts() as $product) {
    $item = (new \PayPal\Api\Item())
        ->setName($product->getName())
        ->setPrice($product->getPrice())
        ->setCurrency('EUR')
        ->setQuantity(1);
    $list->addItem($item);
}

$details = (new \PayPal\Api\Details())
    ->setSubtotal($cart->getPrice());

$amount = (new \PayPal\Api\Amount())
    ->setTotal($cart->getPrice())
    ->setCurrency('EUR')
    ->setDetails($details);

$transaction = (new \PayPal\Api\Transaction())
    ->setItemList($list)
    ->setDescription('Achat sur lbdr')
    ->setAmount($amount)
    ->setCustom('demo');

    
$payment = new \PayPal\Api\Payment();
$payment->setTransactions([$transaction]);
$payment->setIntent('sale');
$redirectUrls = new \PayPal\Api\RedirectUrls();
$payment->setRedirectUrls($redirectUrls);
$payment->setPayer((new \PayPal\Api\Payer())->setPaymentMethod('paypal'));

try{
    $payment->create($apiContext);
    header('Location: ' . $payment->getApprovalLink()) ;
} catch (\PayPal\Exception\PayPalConnectionException $e){
    echo $e->getMessage();
}