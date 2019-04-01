<?php
/**
 * FetchIssuers | src/Message/Request/FetchIssuers.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package		Omnipay-iDeal
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Request;

use Omnipay\iDeal\Message\Response\FetchIssuers as FetchIssuersResponse;
use Omnipay\Common\Message\RequestInterface;

class FetchIssuers extends AbstractRequest
{

	public function getData()
    {
    	$data = $this->getBaseData('DirectoryReq');
        $data->Merchant->merchantID = $this->getMerchantId();
        $data->Merchant->subID = $this->getSubId();
        return $data;
    }
    
    public function parseResponse(RequestInterface $request, $data){
    	return new FetchIssuersResponse($request, $data);
    }

}