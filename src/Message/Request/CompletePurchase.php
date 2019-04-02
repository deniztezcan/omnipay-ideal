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
    	$this->validate('transactionReference');
        
        $data = $this->getBaseData('status', 'message', [
            'merchantID'            => $this->getMerchantId(),
            'subID'                 => $this->getSubId(),
            'transactionReference'  => $this->getTransactionReference(),
            'timestamp'             => $this->makeTimestamp(),
        ]);
        
        return $data;
    }

    public function createResponse($data){
        return new CompletePurchaseResponse($this, $data);
    }
}