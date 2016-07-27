<?php

namespace AppBundle\Controller\Message;

use AppBundle\Controller\BaseController;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ListController
 * @package AppBundle\Controller\Message
 *
 * @Route(
 *     service = "message_list_controller"
 * )
 */
class ListController extends BaseController
{
    use MessageRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/{_locale}/message/list",
     *     name = "message_list"
     * )
     *
     * @Route(
     *     path         = "/{_locale}/message/list/{page}",
     *     name         = "message_list_paginated",
     *     requirements = {"page": "[1-9]\d*"}
     * )
     *
     * @Template(
     *     "message/list.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $page = $request->get('page', 1);
        $messages = $this->messageRepository->findLatest($page);

        return array(
            'messages' => $messages
        );
    }
}