<?php

namespace App\MessageBird\Resources;

use App\MessageBird\Objects;
use App\MessageBird\Common;

/**
 * Class Messages
 *
 * @package App\MessageBird\Resources
 */
class Messages extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Message);
        $this->setResourceName('messages');

        parent::__construct($HttpClient);
    }
}
