<?php

namespace Malico\Momo\Support;

use Malico\Momo\Momo;
use Malico\Momo\Model\Transaction;
use Illuminate\Database\Eloquent\Model;

class MomoBuilder
{
    /**
     * Amount to be checkouted
     * @var Integer
     */
    protected $amount = 0;

    /**
     * elphone Number
     * @var STring|Integer
     */
    protected $tel;

    /**
     * Owner of Transaction
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $owner;

    /**
     * Momo class
     * @var Malico\Momo\Momo
     */
    protected $momo;

    /**
     * Transaction
     */
    protected $transaction;

    public function __construct($owner, $tel, $amount = null)
    {
        $this->owner = $owner;
        $this->tel = $tel;
        $this->amount = $amount;
    }

    /**
     * Set Amount
     * @param  Integer $amount
     * @return Void
     */
    public function amount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Telephone
     * @param  String|Integer $tel
     * @return void
     */
    public function tel($tel)
    {
        $this->tel = $tel;
        return $this;
    }

    /**
     * Same as Tel
     * @param  String $tel
     * @return void
     */
    public function phone($tel)
    {
        $this->tel($tel);
        return $this;
    }

    /**
     * Make Payment
     * @return Malico\Momo\Model\Transaction
     */
    public function pay()
    {
        $this->momo = (new Momo($this->tel, $this->amount))->pay();

        $this->save();

        return $this->transaction;
    }

    /**
     * Save Transaction
     * @return void
     */
    protected function save()
    {
        $transaction = Transaction::create(json_decode(json_encode($this->momo), true));

        $this->owner->momo_transaction()->associate($transaction);

        $this->transaction = $transaction;
    }

    /**
     * Get Owner
     * @return Model
     */
    public function owner()
    {
        return $this->owner;
    }
}
