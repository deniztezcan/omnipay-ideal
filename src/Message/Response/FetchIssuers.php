<?php
/**
 * FetchIssuers | src/Message/Response/FetchIssuers.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package		Omnipay-iDeal
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Response;

class FetchIssuers extends AbstractResponse
{

	public function rootElementExists(){
        return isset($this->data->Directory);
    }
    
    public function getDirectory() {
        return $this->data->Directory;
    }
    
    public function getIssuers() {
        if (isset($this->data->Directory)) {
            $issuers = array();
            foreach ($this->data->Directory->Country as $country) {
                foreach ($country->Issuer as $issuer) {
                    $id = (string) $issuer->issuerID;
                    $issuers[(string)$country->countryNames][$id] = (string) $issuer->issuerName;
                }
            }
            return $issuers;
        }
    }

}