<?php
/**
 * FetchIssuers | src/Message/Request/FetchIssuers.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 *
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Request;

use Omnipay\iDeal\Message\Response\FetchIssuers as FetchIssuersResponse;

class FetchIssuers extends AbstractRequest
{
    public function getData()
    {
        $data = $this->getBaseData('fetchissuers', 'message', [
            'merchantID'    => $this->getMerchantId(),
            'subID'         => $this->getSubId(),
            'timestamp'     => $this->makeTimestamp(),
        ]);

        return $data;
    }

    public function createResponse($data)
    {
        return new FetchIssuersResponse($this, $data);
    }
}
