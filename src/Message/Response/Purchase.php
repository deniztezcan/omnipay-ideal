<?php
/**
 * Purchase | src/Message/Response/Purchase.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package		Omnipay-iDeal
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Response;

class Purchase extends AbstractResponse
{

	public function rootElementExists(){
        return isset($this->data->Transaction) && isset($this->data->Issuer);
    }
    
    public function getIssuer() {
		return $this->data->Issuer;
	}
	
	public function getTransaction(){
		return $this->data->Transaction;
	}
	
	public function getIssuerAuthenticationURL() {
		if (isset($this->data->Issuer)) {
			return (string)$this->data->Issuer->issuerAuthenticationURL;
		}
	}
	
	public function getTransactionID(){
		if (isset($this->data->Transaction)) {
			return (string)$this->data->Transaction->transactionID;
		}
	}
	
	public function getTransactionCreateDateTimestamp() {
		if (isset($this->data->Transaction)) {
			return (string)$this->data->Transaction->transactionCreateDateTimestamp;
		}
	}
	
	public function getPurchaseID() {
		if (isset($this->data->Transaction)) {
			return (string)$this->data->Transaction->purchaseID;
		}
	}

}