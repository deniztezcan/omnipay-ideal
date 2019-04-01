<?php
/**
 * Purchase | src/Message/Request/Purchase.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package		Omnipay-iDeal
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
        
        $data = $this->getBaseData('AcquirerTrxReq');
        $data->Issuer->issuerID = $this->getIssuer();
        $data->Merchant->merchantID = $this->getMerchantId();
        $data->Merchant->subID = $this->getSubId();
        $data->Merchant->merchantReturnURL = $this->getReturnUrl();
        $data->Transaction->purchaseID = $this->getTransactionId();
        $data->Transaction->amount = $this->getAmount();
        $data->Transaction->currency = $this->getCurrency();
        $data->Transaction->expirationPeriod = static::EXPIRATION_PERIOD;
        $data->Transaction->language = static::LANGUAGE;
        $data->Transaction->description = $this->getDescription();
        $data->Transaction->entranceCode = sha1(uniqid());
        
        return $data;
    }
    
    public function parseResponse(RequestInterface $request, $data){
        return new PurchaseResponse($request, $data);
    }

}