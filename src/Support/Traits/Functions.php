<?php

namespace Momo\Support\Traits;

use Curl\Curl;
use Momo\Model\Transaction;

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
        $connection = new Curl();

        $query = [
            'idbouton' => $this->idbouton,
            'typebouton' => $this->typebouton,
            '_amount' => $this->amount,
            '_tel' => $this->tel,
            '_clP' => $this->cpl,
            '_email' => $this->email ?? config('momo.email')
        ];

        $connection->get(
            $this->url,
            $query
        );

        if ($connection->error) {
            abort(500, "Can't connect to MTN Servers");
        } else {
            $this->transaction = json_decode($connection->response, true);
        }

        $connection->close();

        return  $this->recordTransation();
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
        $transaction->desc = ucfirst(str_replace("_", " ", strtolower($this->transaction['StatusDesc'])));

        $transaction->save();

        return $transaction;
    }
}
