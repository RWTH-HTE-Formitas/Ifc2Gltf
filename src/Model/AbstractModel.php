<?php

namespace WebIfc\Model;

abstract class AbstractModel
{
    public static function fromArray(array $array): AbstractModel
    {
        $obj = new static();

        foreach ($array as $key => $value)
        {
            if (!property_exists($obj, $key))
            {
                throw new \LogicException("Unknown property: {$key}");
            }

            $obj->$key = $value;
        }

        return $obj;
    }
}
