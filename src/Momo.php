<?php

namespace Malico\Momo;

use JsonSerializable;
use Malico\Momo\Support\Traits\Variables;
use Malico\Momo\Support\Traits\Functions;

class Momo implements JsonSerializable
{
    use Variables, Functions;
}
