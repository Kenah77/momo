<?php

namespace Malico\Momo;

use JsonSerializable;
use Malico\Momo\Support\Traits\Variables;
use Malico\Momo\Support\Traits\Functions;

class Momo implements JsonSerializable
{
    use Variables, Functions;


    /**
     * Set Email
     * @param  String $email
     * @return $this
     */
    public function email($email)
    {
        $this->email = $email;
        return $this;
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
}
