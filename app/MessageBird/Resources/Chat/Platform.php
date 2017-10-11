<?php

namespace App\MessageBird\Resources\Chat;

use App\MessageBird\Objects;
use App\MessageBird\Common;
use App\MessageBird\Resources\Base;

/**
 * Class Platform
 *
 * @package App\MessageBird\Resources\Chat
 */
class Platform extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {

        $this->setObject(new Objects\Chat\Platform());
        $this->setResourceName('platforms');

        parent::__construct($HttpClient);
    }
}
