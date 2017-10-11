<?php

namespace App\MessageBird\Resources;

use App\MessageBird\Objects;
use App\MessageBird\Common;

/**
 * Class Hlr
 *
 * @package App\MessageBird\Resources
 */
class Hlr extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Hlr);
        $this->setResourceName('hlr');

        parent::__construct($HttpClient);
    }
}
