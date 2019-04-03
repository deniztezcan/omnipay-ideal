<?php
/**
 * Digest | src/Support/transaction/digest.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @author      Björn Visser
 * @package     Omnipay-iDeal
 * @since       v0.1
 */

return [
    'AcquirerTrxReq' => [
        '_attributes' => [
            'xmlns' => 'http://www.idealdesk.com/ideal/messages/mer-acq/3.3.1',
            'version' => '3.3.1',
        ],
        'createDateTimestamp' => $config['timestamp'],
        'Issuer' => [
            'issuerID' => $config['issuerID'],
        ],
        'Merchant' => [
            'merchantID' => $config['merchantID'],
            'subID' => $config['subID'],
            'merchantReturnURL' => $config['merchantReturnURL'],
        ],
        'Transaction' => [
            'purchaseID' => $config['purchaseID'],
            'amount' => number_format($config['amount'], 2),
            'currency' => $config['currency'],
            'expirationPeriod' => $config['expiration_period'],
            'language' => $config['locale'],
            'description' => $config['description'],
            'entranceCode' => $config['entrance_code'],
        ],
    ],
];