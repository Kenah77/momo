<?php

namespace Momo\Support\Traits;

trait Variables
{
    protected $idbouton = 2;

    protected $cpl = '';

    protected $typebouton = "PAIE";

    /**
     * Request Method
     * Get | Post
     *
     * @var string
     */
    protected $method="GET";

    /**
     * Url to MTN Api
     * @var string
     */
    protected $url = "https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml";

    /**
     * Email used for User Registration on MTN Cameroon's Developer Page
     *
     * @var string
     */
    protected $email;

    /**
     * Amount to be Paid for Service
     *
     * @var integer | string
     */
    public $amount;

    /**
     * Users Telephone Number
     * @var integer | string
     */
    public $tel;

    /**
     * Tmp Variable for Transaction details
     * @var array
     */
    public $transaction = [];
}
