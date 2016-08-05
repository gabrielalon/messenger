<?php

namespace AppBundle\Controller\Post;

use AppBundle\Controller\BaseController;
use AppBundle\Document\Post;
use AppBundle\Repository\PostRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ShowController
 * @package AppBundle\Controller\Post
 *
 * @Route(
 *     service = "post_show_controller"
 * )
 */
class ShowController extends BaseController
{
    use PostRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path         = "/{_locale}/post/show/{postId}",
     *     name         = "post_show",
     *     requirements = {"postId" = "[a-z0-9]+"}
     * )
     *
     * @Template(
     *     "post/show.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $postId = $request->get('postId');

        /** @var Post $post */
        $post = $this->postRepository->find($postId);

        if (!$post) {
            $this->addFlash(
                'warning',
                $this->getTranslator()->trans('warning.post_not_found')
            );

            return $this->redirect($this->generateUrl('post_list'));
        }

        return array(
            'post' => $post
        );
    }
}