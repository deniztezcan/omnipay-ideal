<?php
/**
 * CompletePurchase | src/Message/Request/CompletePurchase.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package		Omnipay-iDeal
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Request;

use Omnipay\iDeal\Message\Response\CompletePurchase as CompletePurchaseResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchase extends AbstractRequest
{

	public function getData()
    {
    	$this->validate('transactionId');
        $data = $this->getBaseData('AcquirerStatusReq');
        $data->Merchant->merchantID = $this->getMerchantId();
        $data->Merchant->subID = $this->getSubId();
        $data->Transaction->transactionID = $this->getTransactionId();
        
        return $data;
    }

    public function parseResponse(RequestInterface $request, $data){
    	return new CompletePurchaseResponse($request, $data);
    }
}