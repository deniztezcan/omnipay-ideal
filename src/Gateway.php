<?php
/**
 * Gateway | src/Gateway.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 *
 * @since       v0.1
 */

namespace Omnipay\iDeal;

use Omnipay\Common\AbstractGateway;
use Omnipay\iDeal\Message\Request\CompletePurchase;
use Omnipay\iDeal\Message\Request\FetchIssuers;
use Omnipay\iDeal\Message\Request\Purchase;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'iDeal';
    }

    public function getDefaultParameters()
    {
        return [
            'acquirer'             => ['', 'simulator', 'ing', 'rabobank', 'abn', 'deutsche'],
            'merchantId'           => '',
            'publicKeyPath'        => '',
            'privateKeyPath'       => '',
            'privateKeyPassphrase' => '',
            'testMode'             => false,
        ];
    }

    public function getAcquirer()
    {
        return $this->getParameter('acquirer');
    }

    public function setAcquirer($value)
    {
        return $this->setParameter('acquirer', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getSubId()
    {
        return $this->getParameter('subId');
    }

    public function setSubId($value)
    {
        return $this->setParameter('subId', $value);
    }

    public function getPrivateCerPath()
    {
        return $this->getParameter('privateCerPath');
    }

    public function setPrivateCerPath($value)
    {
        return $this->setParameter('privateCerPath', $value);
    }

    public function getPrivateKeyPath()
    {
        return $this->getParameter('privateKeyPath');
    }

    public function setPrivateKeyPath($value)
    {
        return $this->setParameter('privateKeyPath', $value);
    }

    public function getPrivateKeyPassphrase()
    {
        return $this->getParameter('privateKeyPassphrase');
    }

    public function setPrivateKeyPassphrase($value)
    {
        return $this->setParameter('privateKeyPassphrase', $value);
    }

    public function getIssuer()
    {
        return $this->getParameter('issuer');
    }

    public function setIssuer($value)
    {
        return $this->setParameter('issuer', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getTransactionId()
    {
        return $this->getParameter('transactionId');
    }

    public function setTransactionId($value)
    {
        return $this->setParameter('transactionId', $value);
    }

    public function getDescription()
    {
        return $this->getParameter('description');
    }

    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    public function fetchIssuers(array $parameters = [])
    {
        return $this->createRequest(FetchIssuers::class, $parameters);
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(Purchase::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(CompletePurchase::class, $parameters);
    }
}
