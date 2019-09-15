<?php

namespace Malico\Momo\Exceptions;

use Exception;

class ConnectionFailure extends Exception
{
    /**
     * Throw connection Expception
     * @param  String $error
     * @return Static Exception
     */
    public static function failedConnection($error)
    {
        return new static($error);
    }
}
