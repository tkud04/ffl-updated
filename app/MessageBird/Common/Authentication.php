<?php

namespace App\MessageBird\Common;

/**
 * Class Authentication
 *
 * @package App\MessageBird\Common
 */
class Authentication
{

    public $accessKey;

    /**
     * @param $accessKey
     */
    public function __construct($accessKey)
    {
        $this->accessKey = $accessKey;
    }
}
