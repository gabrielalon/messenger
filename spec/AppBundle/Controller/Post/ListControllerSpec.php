<?php

namespace spec\AppBundle\Controller\Post;

use AppBundle\Controller\Post\ListController;
use AppBundle\Repository\PostRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ListControllerSpec
 * @package spec\AppBundle\Controller\Post
 * @mixin ListController
 */
class ListControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Controller\Post\ListController');
    }

    function it_should_respond_to_list_action(Request $request, PostRepository $postRepository)
    {
        $this->setPostRepository($postRepository);
        $response = $this->onInvoke($request);

        $response->shouldBeArray();
    }
}
