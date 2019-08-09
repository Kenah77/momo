<?php

namespace Malico\Momo\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * Database Table
     * @var string
     */
    protected $table = "momo_transactions";

    /**
     * Hidden Attributes for this Model
     */
    protected $hidden = [
        'transaction_id', 'reference', 'receiver_tel'
    ];
}
