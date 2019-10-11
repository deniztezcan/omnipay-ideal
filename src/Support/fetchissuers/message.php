<?php
/**
 * Message | src/Support/transaction/message.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @author      Björn Visser
 *
 * @since       v0.1
 */

return [
    'DirectoryReq' => [
        '_attributes' => [
            'xmlns'   => 'http://www.idealdesk.com/ideal/messages/mer-acq/3.3.1',
            'version' => '3.3.1',
        ],
        'createDateTimestamp' => $config['timestamp'],
        'Merchant'            => [
            'merchantID' => $config['merchantID'],
            'subID'      => $config['subID'],
        ],
        'Signature' => [
            '_attributes' => [
                'xmlns' => 'http://www.w3.org/2000/09/xmldsig#',
            ],
            'SignedInfo' => [
                'CanonicalizationMethod' => [
                    '_attributes' => [
                        'Algorithm' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
                    ],
                ],
                'SignatureMethod' => [
                    '_attributes' => [
                        'Algorithm' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256',
                    ],
                ],
                'Reference' => [
                    '_attributes' => [
                        'URI' => '',
                    ],
                    'Transforms' => [
                        'Transform' => [
                            '_attributes' => [
                                'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
                            ],
                        ],
                    ],
                    'DigestMethod' => [
                        '_attributes' => [
                            'Algorithm' => 'http://www.w3.org/2001/04/xmlenc#sha256',
                        ],
                    ],
                    'DigestValue' => $config['digest'],
                ],
            ],
            'SignatureValue' => $config['signature'],
            'KeyInfo'        => [
                'KeyName' => $config['fingerprint'],
            ],
        ],
    ],
];
