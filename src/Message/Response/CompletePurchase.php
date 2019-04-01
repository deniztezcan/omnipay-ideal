<?php
/**
 * CompletePurchase | src/Message/Response/CompletePurchase.php.
 *
 * @author      Deniz Tezcan <howdy@deniztezcan.me>
 * @package		Omnipay-iDeal
 * @since       v0.1
 */

namespace Omnipay\iDeal\Message\Response;

class CompletePurchase extends AbstractResponse
{

	public function rootElementExists(){
        return isset($this->data->Transaction);
    }
    
    public function getTransaction(){
            return $this->data->Transaction;
    }
    
    public function getTransactionID(){
        if (isset($this->data->Transaction)) {
            return (string)$this->data->Transaction->transactionID;
        }
    }
    
    public function getStatus(){
        if (isset($this->data->Transaction)) {
            return (string)$this->data->Transaction->status;
        }
    }
    
    public function getStatusDateTimestamp(){
        if (isset($this->data->Transaction)) {
            return (string)$this->data->Transaction->statusDateTimestamp;
        }
    }
    
    public function getConsumerName(){
        if (isset($this->data->Transaction)) {
            return (string)$this->data->Transaction->consumerName;
        }
    }
    
    public function getConsumerIBAN(){
        if (isset($this->data->Transaction)) {
            return (string)$this->data->Transaction->consumerIBAN;
        }
    }
    
    public function getConsumerBIC(){
        if (isset($this->data->Transaction)) {
            return (string)$this->data->Transaction->consumerBIC;
        }
    }
    
    public function getAmount(){
        if (isset($this->data->Transaction)) {
            return (float)$this->data->Transaction->amount;
        }
    }
    
    public function getCurrency(){
        if (isset($this->data->Transaction)) {
            return (string)$this->data->Transaction->currency;
        }
    }
}