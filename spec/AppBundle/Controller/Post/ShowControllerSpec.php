<?php

namespace spec\AppBundle\Controller\Post;

use AppBundle\Controller\Post\ShowController;
use AppBundle\Repository\PostRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ShowControllerSpec
 * @package spec\AppBundle\Controller\Post
 * @mixin ShowController
 */
class ShowControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Controller\Post\ShowController');
        $this->shouldImplement('AppBundle\Controller\BaseController');
    }

    function it_should_respond_to_show_action(Request $request, PostRepository $postRepository)
    {
        $request->request->set('postId', 1);

        $this->setPostRepository($postRepository);
        $response = $this->onInvoke($request);

        $response->shouldBeArray();
    }
}
