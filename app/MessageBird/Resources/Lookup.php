<?php

namespace App\MessageBird\Resources;

use App\MessageBird\Objects;
use App\MessageBird\Common;
use InvalidArgumentException;

/**
 * Class Verify
 *
 * @package App\MessageBird\Resources
 */
class Lookup extends Base
{

    /**
     * @param Common\HttpClient $HttpClient
     */
    public function __construct(Common\HttpClient $HttpClient)
    {
        $this->setObject(new Objects\Lookup);
        $this->setResourceName('lookup');

        parent::__construct($HttpClient);
    }

    /**
     * @param string|int $phoneNumber
     * @param string     $countryCode
     *
     * @return $this->Object
     *
     * @throws \App\MessageBird\Exceptions\HttpException
     * @throws \App\MessageBird\Exceptions\RequestException
     * @throws \App\MessageBird\Exceptions\ServerException
     */
    public function read($phoneNumber = null, $countryCode = null)
    {
        if(empty($phoneNumber)) {
            throw new InvalidArgumentException('The phone number cannot be empty.');
        }
        $query = null;
        if ($countryCode != null) {
            $query = array("countryCode" => $countryCode);
        }
        $ResourceName = $this->resourceName . '/' . $phoneNumber;
        list(, , $body) = $this->HttpClient->performHttpRequest(Common\HttpClient::REQUEST_GET, $ResourceName, $query);
        return $this->processRequest($body);
    }
}
