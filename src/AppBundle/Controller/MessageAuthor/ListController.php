<?php

namespace AppBundle\Controller\MessageAuthor;

use AppBundle\Controller\BaseController;
use AppBundle\Repository\MessageAuthorRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ListController
 * @package AppBundle\Controller\MessageAuthor
 *
 * @Route(
 *     service = "message_author_list_controller"
 * )
 */
class ListController extends BaseController
{
    use MessageAuthorRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/{_locale}/message_author/list",
     *     name = "message_author_list"
     * )
     *
     * @Route(
     *     path         = "/{_locale}/message_author/list/{page}",
     *     name         = "message_author_list_paginated",
     *     requirements = {"page": "[1-9]\d*"}
     * )
     *
     * @Cache(
     *     maxage = 3600
     * )
     *
     * @Template(
     *     "message_author/list.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $page = $request->get('page', 1);
        $authors = $this->messageAuthorRepository->findLatest($page);

        return array(
            'authors' => $authors
        );
    }
}