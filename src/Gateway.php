<?php
/**
 * Gateway | src/Gateway.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package		Omnipay-iDeal
 * @since       v0.1
 */

namespace Omnipay\iDeal;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{

	public function getName() {
        return 'iDeal';
    }

	public function getDefaultParameters()
    {
        return [
            'acquirer' => array('', 'simulator', 'ing', 'rabobank'),
            'merchantId' => '',
            'publicKeyPath' => '',
            'privateKeyPath' => '',
            'privateKeyPassphrase' => '',
            'testMode' => false,
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

    public function getPublicKeyPath()
    {
        return $this->getParameter('publicKeyPath');
    }

    public function setPublicKeyPath($value)
    {
        return $this->setParameter('publicKeyPath', $value);
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

    public function fetchIssuers(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iDeal\Message\Request\FetchIssuers', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iDeal\Message\Request\Purchase', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iDeal\Message\Request\CompletePurchase', $parameters);
    }

}