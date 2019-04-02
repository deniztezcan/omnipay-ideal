<?php
/**
 * Signature | src/Support/transaction/signature.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package     Omnipay-iDeal
 * @since       v0.1
 */

return [
    'SignedInfo' => [
        '_attributes' => [
            'xmlns' => 'http://www.w3.org/2000/09/xmldsig#',
        ],
        'CanonicalizationMethod' => [
            '_attributes' => [
                'Algorithm' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
            ],
            'remove' => 'remove',
        ],
        'SignatureMethod' => [
            '_attributes' => [
                'Algorithm' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256',
            ],
            'remove' => 'remove',
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
                    'remove' => 'remove',
                ],
            ],
            'DigestMethod' => [
                '_attributes' => [
                    'Algorithm' => 'http://www.w3.org/2001/04/xmlenc#sha256',
                ],
                'remove' => 'remove',
            ],
            'DigestValue' => $config['digest'],
        ],
    ]
];