<?php

namespace App\MessageBird\Objects;

/**
 * Class Base
 *
 * @package App\MessageBird\Objects
 */
class Base
{
    /**
     * @param $object
     *
     * @return $this
     */
    public function loadFromArray($object)
    {
        if ($object) {
            foreach ($object AS $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
        return $this;
    }
}
