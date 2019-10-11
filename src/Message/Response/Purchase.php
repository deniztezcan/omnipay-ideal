<?php
/**
 * Purchase | src/Message/Response/Purchase.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 *
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Response;

use Omnipay\Common\Message\RedirectResponseInterface;

class Purchase extends AbstractResponse implements RedirectResponseInterface
{
    public function isRedirect()
    {
        return $this->isSuccessful();
    }

    public function rootElementExists()
    {
        return isset($this->data['Transaction']) && isset($this->data['Issuer']);
    }

    public function getIssuer()
    {
        return $this->data['Issuer'];
    }

    public function getTransaction()
    {
        return $this->data['Transaction'];
    }

    public function getRedirectUrl()
    {
        if (isset($this->data['Issuer'])) {
            return (string) $this->data['Issuer']['issuerAuthenticationURL'];
        }
    }

    public function getTransactionID()
    {
        if (isset($this->data['Transaction'])) {
            return (string) $this->data['Transaction']['transactionID'];
        }
    }

    public function getTransactionCreateDateTimestamp()
    {
        if (isset($this->data['Transaction'])) {
            return (string) $this->data['Transaction']['transactionCreateDateTimestamp'];
        }
    }

    public function getPurchaseID()
    {
        if (isset($this->data['Transaction'])) {
            return (string) $this->data['Transaction']['purchaseID'];
        }
    }
}
