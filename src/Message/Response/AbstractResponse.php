<?php
/**
 * Purchase | src/Message/Response/Purchase.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 *
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Response;

use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

abstract class AbstractResponse extends CommonAbstractResponse
{
    public function isSuccessful()
    {
        return !isset($this->data['Error']) && isset($this->data['Acquirer']) && $this->rootElementExists();
    }

    abstract public function rootElementExists();

    public function getAcquirerID()
    {
        if (isset($this->data['Acquirer'])) {
            return (string) $this->data['Acquirer']['acquirerID'];
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getError()
    {
        return $this->data['Error'];
    }

    public function getErrorCode()
    {
        if (isset($this->data['Error'])) {
            return (string) $this->data['Error']['errorCode'];
        }
    }

    public function getErrorMessage()
    {
        if (isset($this->data['Error'])) {
            return (string) $this->data['Error']['errorMessage'];
        }
    }

    public function getErrorDetail()
    {
        if (isset($this->data['Error'])) {
            return (string) $this->data['Error']['errorDetail'];
        }
    }

    public function getConsumerMessage()
    {
        if (isset($this->data['Error'])) {
            return (string) $this->data['Error']['consumerMessage'];
        }
    }
}
