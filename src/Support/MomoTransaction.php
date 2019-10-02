<?php

namespace  Malico\Momo\Support;

use Malico\Momo\Momo;

trait MomoTransaction
{
    /**
     * relationshp to Momo Transaction
     */
    public function momo_transaction()
    {
        return $this->belongsTo('Malico\Momo\Model\Transaction', 'id', config('momo.foreign_key'));
    }

    /**
     * Return MOMO Builder
     * @param  STring|int|null $tel
     * @param  Int|NUll $amount
     * @return Malico\Momo\Support\MomoBuilder
     */
    public function momo($tel = null, $amount = null)
    {
        return (new MomoBuilder($this, $tel, $amount));
    }

    /**
     * Make Payment
     * @param  String|Int|Null $tel
     * @param  Int|Null $amount
     * @return void
     */
    public function pay($tel = null, $amount = null)
    {
        return  $this->momo($tel, $amount)->pay();
    }
}
