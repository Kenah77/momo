<?php

namespace Momo\Support;

trait MomoTransaction
{
    public function momo_transaction()
    {
        return $this->hasOne('Momo\Model\Transaction', 'id', config('momo.foreign_key'));
    }
}
