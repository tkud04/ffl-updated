<?php

namespace App\MessageBird\Resources\Chat;

use App\MessageBird\Objects;
use App\MessageBird\Common;
use App\MessageBird\Resources\Base;

/**
 * Class Message
 *
 * @package App\MessageBird\Resources\Chat
 */
class Message extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {

        $this->setObject(new Objects\Chat\Message());
        $this->setResourceName('messages');

        parent::__construct($HttpClient);
    }
}
