<?php

namespace ApiBundle\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("hello")
 */
class Hello
{
    /**
     * @Serializer\XmlAttribute
     */
    private $hello;

    /**
     * Hello constructor.
     *
     * @param $hello
     */
    public function __construct($hello)
    {
        $this->hello = $hello;
    }
}