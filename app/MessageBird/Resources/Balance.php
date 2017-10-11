<?php

namespace App\MessageBird\Resources;

use App\MessageBird\Objects;
use App\MessageBird\Common;

/**
 * Class Balance
 *
 * @package App\MessageBird\Resources
 */
class Balance extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Balance);
        $this->setResourceName('balance');

        parent::__construct($HttpClient);
    }
}
