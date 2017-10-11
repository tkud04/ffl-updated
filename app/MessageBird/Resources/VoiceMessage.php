<?php

namespace App\MessageBird\Resources;

use App\MessageBird\Objects;
use App\MessageBird\Common;

/**
 * Class VoiceMessage
 *
 * @package App\MessageBird\Resources
 */
class VoiceMessage extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\VoiceMessage);
        $this->setResourceName('voicemessages');

        parent::__construct($HttpClient);
    }
}
