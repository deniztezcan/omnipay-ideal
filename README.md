# Omnipay: iDeal

**iDeal (PSP) driver for the Omnipay PHP payment processing library**

[![Latest Stable Version](https://poser.pugx.org/deniztezcan/omnipay-ideal/v/stable)](https://packagist.org/packages/deniztezcan/omnipay-ideal) 
[![Total Downloads](https://poser.pugx.org/deniztezcan/omnipay-ideal/downloads)](https://packagist.org/packages/deniztezcan/omnipay-ideal) 
[![Latest Unstable Version](https://poser.pugx.org/deniztezcan/omnipay-ideal/v/unstable)](https://packagist.org/packages/deniztezcan/omnipay-ideal) 
[![License](https://poser.pugx.org/deniztezcan/omnipay-ideal/license)](https://packagist.org/packages/deniztezcan/omnipay-ideal)

[Omnipay 3.x](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment processing library for PHP 5.6+

Table of Contents
=================
* [Installation](#installation)
* [List iDeal Issuers](#List&#32;iDeal&#32;Issuers)
* [Payment](#Do&#32;a&#32;Payment)
* [Complete Payment](#Complete&#32;a&#32;Payment)
* [Support](#support)

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/).

```
composer require deniztezcan/omnipay-ideal:^1
```

## List iDeal Issuers

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('iDeal');

$gateway->setAcquirer('YOUR_BANK');
$gateway->setMerchantId('MERCHANT_ID');
$gateway->setSubId('SUB_ID');
$gateway->setPrivateKeyPassphrase('PASSPHRASE');
$gateway->setPrivateKeyPath('PATH_TO_PRIVATE_KEY');
$gateway->setPrivateCerPath('PATH_TO_PRIVATE_CER');

$request = $gateway->fetchIssuers();
$response = $request->send();
```

This gives you an array of `Issuers`:

```php
$response->getIssuers();
```

## Do a Payment

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('iDeal');

$gateway->setAcquirer('YOUR_BANK');
$gateway->setMerchantId('MERCHANT_ID');
$gateway->setSubId('SUB_ID');
$gateway->setPrivateKeyPassphrase('PASSPHRASE');
$gateway->setPrivateKeyPath('PATH_TO_PRIVATE_KEY');
$gateway->setPrivateCerPath('PATH_TO_PRIVATE_CER');

$request = $gateway->purchase(['issuer' => 'ISSUER', 'amount' => 99.99, 'currency' => 'EUR', 'returnUrl' => 'RETURN_URL', 'transactionId' => 'PURCHASE_ID', 'description' => 'DESCRIPTION']);
$response = $request->send();
```

To properly handle the response

```php
if ($response->isRedirect()) {
	// redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getConsumerMessage();
}
```

## Complete a Payment

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('iDeal');

$gateway->setAcquirer('YOUR_BANK');
$gateway->setMerchantId('MERCHANT_ID');
$gateway->setSubId('SUB_ID');
$gateway->setPrivateKeyPassphrase('PASSPHRASE');
$gateway->setPrivateKeyPath('PATH_TO_PRIVATE_KEY');
$gateway->setPrivateCerPath('PATH_TO_PRIVATE_CER');

$request = $gateway->completePurchase(['transactionReference' => 'TRANSACTION_REFERENCE']);
$response = $request->send();
```
To properly handle the response

```php
if ($response->isSuccessful()) {
	// payment was successful: update database
    print_r($response);
} else {
    // payment failed: display message to customer
    echo $response->getConsumerMessage();
}
```

## Support

If you are having general issues with Omnipay, we suggest posting on [Stack Overflow](http://stackoverflow.com/). Be sure to add the [omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/deniztezcan/omnipay-ideal/issues), or better yet, fork the library and submit a pull request.
