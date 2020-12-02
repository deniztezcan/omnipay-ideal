<?php
/**
 * FetchIssuers | src/Message/Response/FetchIssuers.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 *
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Response;

class FetchIssuers extends AbstractResponse
{
    public function rootElementExists()
    {
        return isset($this->data['Directory']);
    }

    public function getDirectory()
    {
        return $this->data['Directory'];
    }

    public function getIssuers()
    {
        if (isset($this->data['Directory'])) {
            $issuers = [];
            if (is_array($this->data['Directory']['Country'])) {
                // TODO: add option to filter by country
                $issuerList = current(array_filter($this->data['Directory']['Country'], function($country) {
                    return $country['countryNames'] === 'Nederland';
                }))['Issuer'];
            } else {
                $issuerList = $this->data['Directory']['Country']['Issuer'];
            }
            foreach ($issuerList as $issuer) {
                $id = (string) $issuer['issuerID'];
                $issuers[$id] = (string) $issuer['issuerName'];
            }

            return $issuers;
        }
    }
}
