<?php

namespace spec\AppBundle\Controller\Main;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class IndexControllerSpec
 * @package spec\AppBundle\Controller\Main
 */
class IndexControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Controller\Main\IndexController');
    }
}
