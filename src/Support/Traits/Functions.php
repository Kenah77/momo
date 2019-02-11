<?php

namespace Momo\Support\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

trait Functions
{
    protected $query = [];

    public function pay()
    {
        $this->query['query'] = [
            'idbouton' => $this->idbouton,
            'typebouton' => $this->typebouton,
            '_amount' => $this->amount,
            '_tel' => $this->tel,
            '_clP' => $this->cpl,
            '_email' => $this->email
        ];
        $client = new Client();
        $client->request(
            'GET',
            $this->url,
            [
                'form_params' => $this->query['query']
            ]
        );
    }
}
