<?php

namespace AppBundle\Controller\Post;

use AppBundle\Controller\BaseController;
use AppBundle\Repository\PostRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ListController
 * @package AppBundle\Controller\Post
 *
 * @Route(
 *     service = "post_list_controller"
 * )
 */
class ListController extends BaseController
{
    use PostRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/{_locale}/post/list",
     *     name = "post_list"
     * )
     *
     * @Route(
     *     path         = "/{_locale}/post/list/{page}",
     *     name         = "post_list_paginated",
     *     requirements = {"page": "[1-9]\d*"}
     * )
     *
     * @Template(
     *     "post/list.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $page = $request->get('page', 1);
        $posts = $this->postRepository->findLatest($page);

        return array(
            'posts' => $posts
        );
    }
}