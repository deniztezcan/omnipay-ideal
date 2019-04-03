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
    'DirectoryReq' => [
        '_attributes' => [
            'xmlns' => 'http://www.idealdesk.com/ideal/messages/mer-acq/3.3.1',
            'version' => '3.3.1',
        ],
        'createDateTimestamp' => $config['timestamp'],
        'Merchant' => [
            'merchantID' => $config['merchantID'],
            'subID' => $config['subID'],
        ],
    ],
];