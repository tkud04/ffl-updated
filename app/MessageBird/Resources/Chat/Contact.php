<?php

namespace App\MessageBird\Resources\Chat;

use App\MessageBird\Objects;
use App\MessageBird\Common;
use App\MessageBird\Resources\Base;

/**
 * Class Contact
 *
 * @package App\MessageBird\Resources\Chat
 */
class Contact extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {

        $this->setObject(new Objects\Chat\Contact());
        $this->setResourceName('contacts');

        parent::__construct($HttpClient);
    }
}
