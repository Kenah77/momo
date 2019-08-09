<?php

namespace Malico\Momo\Support\Traits;

use GuzzleHttp\Client;
use Malico\Momo\Model\Transaction;

trait Functions
{
    /**
     * Create new MOMO Request
     * @param string, number  $tel   Client Telephone Number
     * @param  integer $price
     */
    public function __construct($tel, $price = null)
    {
        $this->tel = $tel;
        $this->amount = $price ?? config('momo.default_price');
    }

    /**
     * Make Transaction and Record
     * @return Transaction
     */
    public function pay()
    {
        $client = new Client();

        $query = [
            'idbouton' => $this->idbouton,
            'typebouton' => $this->typebouton,
            '_amount' => $this->amount,
            '_tel' => $this->tel,
            '_clP' => $this->cpl,
            '_email' => $this->email ?? config('momo.email')
        ];

        $response = $client->request(
            'GET',
            $this->url,
            [
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false
                ],
                'query' => $query
            ]
        );

        if ($response->getStatusCode() != 200) {
            abort(500, "Can't connect to MTN Servers");
        } else {
            $this->transaction = json_decode($response->getBody(), true);
        }
        return $this->recordTransation();
    }

    /**
     * Save Transaction to DB
     * @return Transaction
     */
    protected function recordTransation()
    {
        $transaction = new Transaction();

        $transaction->amount = $this->transaction['Amount'];
        $transaction->tel = $this->transaction['SenderNumber'];
        $transaction->status = (int) $this->transaction['StatusCode'] == 1 ? true : false ;
        $transaction->comment = $this->transaction['OpComment'];
        $transaction->reference = $this->transaction['ProcessingNumber'];
        $transaction->receiver_tel =$this->transaction['ReceiverNumber'];
        $transaction->operation_type =$this->transaction['OperationType'];
        $transaction->transaction_id =$this->transaction['TransactionID'];

        if ($this->transaction['StatusCode'] == '01') {
            $transaction->desc = $this->transaction['StatusDesc'];
        } elseif ($this->transaction['StatusCode'] == '100') {
            $transaction->desc = "Transaction Denied";
        } else {
            $transaction->desc = "Transaction was not confirmed";
        }

        $transaction->save();

        return $transaction;
    }
}
