<?php

namespace App\MessageBird\Resources;

use App\MessageBird\Objects;
use App\MessageBird\Common;

/**
 * Class Verify
 *
 * @package App\MessageBird\Resources
 */
class Verify extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Verify);
        $this->setResourceName('verify');

        parent::__construct($HttpClient);
    }

    /**
     * @param $id
     * @param $token
     *
     * @return $this->Object
     *
     * @throws \App\MessageBird\Exceptions\HttpException
     * @throws \App\MessageBird\Exceptions\RequestException
     * @throws \App\MessageBird\Exceptions\ServerException
     */
    public function verify($id, $token)
    {
        $ResourceName = $this->resourceName . (($id) ? '/' . $id : null);
        list(, , $body) = $this->HttpClient->performHttpRequest(Common\HttpClient::REQUEST_GET, $ResourceName, array('token' => $token));
        return $this->processRequest($body);
    }
}
