<?php
/**
 * Purchase | src/Message/Request/Purchase.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package     Omnipay-iDeal
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Request;

use Omnipay\iDeal\Message\Response\Purchase as PurchaseResponse;
use Omnipay\Common\Message\RequestInterface;

class Purchase extends AbstractRequest
{

    public function getData()
    {
        
        $this->validate('issuer', 'amount', 'currency', 'returnUrl');
        
        $data = $this->getBaseData('transaction', 'message', [
            'issuerID'          => $this->getIssuer(),
            'merchantID'        => $this->getMerchantId(),
            'subID'             => $this->getSubId(),
            'merchantReturnURL' => $this->getReturnUrl(),
            'purchaseID'        => $this->getTransactionId(),
            'amount'            => $this->getAmount(),
            'currency'          => $this->getCurrency(),
            'expiration_period' => 'PT1H',
            'locale'            => 'nl',
            'description'       => $this->getDescription(),
            'entrance_code'     => sha1(uniqid()),
            'timestamp'         => $this->makeTimestamp(),
        ]);

        return $data;
    }
    
    public function createResponse($data){
        return new PurchaseResponse($this, $data);
    }

}