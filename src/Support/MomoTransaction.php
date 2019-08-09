<?php

namespace  Malico\Momo\Support;

trait MomoTransaction
{
    public function momo_transaction()
    {
        return $this->hasOne('Malico\Momo\Model\Transaction', 'id', config('momo.foreign_key'));
    }
}
