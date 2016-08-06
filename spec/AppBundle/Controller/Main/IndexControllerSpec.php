<?php

namespace spec\AppBundle\Controller\Main;

use AppBundle\Controller\Main\IndexController;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexControllerSpec
 * @package spec\AppBundle\Controller\Main
 * @mixin IndexController
 */
class IndexControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Controller\Main\IndexController');
    }

    function it_should_respond_to_index_action(Request $request)
    {
        $response = $this->onInvoke($request);

        $response->shouldBeArray();
    }
}
