<?php
/**
 * AbstractRequest | src/Message/Request/AbstractRequest.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 *
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Request;

use Carbon\Carbon;
use Exception;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Omnipay\iDeal\XmlToArray;
use Spatie\ArrayToXml\ArrayToXml;

abstract class AbstractRequest extends CommonAbstractRequest
{
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

    public function getExpirationPeriod()
    {
        return $this->getParameter('expirationPeriod') ?? 'PT1H';
    }

    public function getLocale()
    {
        return $this->getParameter('locale') ?? 'nl';
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

    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    public function setTransactionReference($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    public function getDigest($xml)
    {
        return base64_encode(openssl_digest($xml, 'sha256', true));
    }

    protected function makeTimestamp()
    {
        return Carbon::now()->format('Y-m-d\TH:i:s.000\Z');
    }

    public function getSignature($xml)
    {
        $privatekey = file_get_contents($this->getPrivateKeyPath());

        $key = openssl_get_publickey($privatekey);
        if (!empty($this->getPrivateKeyPassphrase())) {
            $key = openssl_pkey_get_private($privatekey, $this->getPrivateKeyPassphrase());
        }

        if (false === $key) {
            throw new Exception(openssl_error_string());
        }

        openssl_sign($xml, $signature, $key, OPENSSL_ALGO_SHA256);
        openssl_free_key($key);

        return base64_encode($signature);
    }

    public function getFingerPrint()
    {
        return strtoupper(sha1(base64_decode(str_replace(['-----BEGIN CERTIFICATE-----', '-----END CERTIFICATE-----'], '', file_get_contents($this->getPrivateCerPath())))));
    }

    public function buildMessageOptions($type, $config)
    {
        $config['digest'] = $this->getDigest($this->generateXml($type, 'digest', $config));
        $config['signature'] = $this->getSignature($this->generateXml($type, 'signature', $config));
        $config['fingerprint'] = $this->getFingerPrint();

        return $config;
    }

    public function generateXml($type, $name, $config)
    {
        if ($name === 'message') {
            $config = $this->buildMessageOptions($type, $config);
        }

        $data = include __DIR__."/../../Support/{$type}/{$name}.php";

        $xml = ArrayToXml::convert($data, '');
        $xml = str_replace(['    ', '<root>', '</root>', "\n", "\r", '<remove>remove</remove>'], '', $xml);
        if ($name !== 'message') {
            $xml = str_replace('<?xml version="1.0"?>', '', $xml);
        }

        return $xml;
    }

    public function getBaseData($type, $name, $config)
    {
        $this->validate('acquirer', 'testMode', 'merchantId', 'subId', 'privateCerPath', 'privateKeyPath', 'privateKeyPassphrase');
        $data = $this->generateXml($type, $name, $config);

        return $data;
    }

    public function sendData($data)
    {
        $response = $this->httpClient->request(
            'POST',
            $this->getEndpoint(),
            [
                'Content-Type' => 'application/json',
            ],
            $data
        );

        $content = $response->getBody()->getContents();

        $rawResponse = XmlToArray::convert($content);
        $rawResponse['raw'] = $content;
        return $this->createResponse($rawResponse);
    }

    abstract public function createResponse($payload);

    public function getEndpoint()
    {
        $this->validate('acquirer');

        $base = $this->getTestMode() ? 'https://idealtest.' : 'https://ideal.';

        switch ($this->getAcquirer()) {
            case 'ing':
                return $base.'secure-ing.com/ideal/iDEALv3';
            case 'rabobank':
                return $base.'rabobank.nl/ideal/iDEALv3';
            case 'bnpparibas':
                return $base.'bnpparibas.com/ideal/iDEALv3';
            case 'simulator':
                return 'https://www.ideal-checkout.nl:443/simulator/';
        }

        throw new InvalidRequestException('Invalid acquirer selected');
    }
}
