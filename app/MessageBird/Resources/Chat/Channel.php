<?php

namespace App\MessageBird\Resources\Chat;

use App\MessageBird\Objects;
use App\MessageBird\Common;
use App\MessageBird\Resources\Base;

/**
 * Class Channel
 *
 * @package App\MessageBird\Resources\Chat
 */
class Channel extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {

        $this->setObject(new Objects\Chat\Channel());
        $this->setResourceName('channels');

        parent::__construct($HttpClient);
    }
}
