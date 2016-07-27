<?php
/**
 * Created by PhpStorm.
 * User: marekrode
 * Date: 24.07.2016
 * Time: 10:47
 */

namespace AppBundle\Controller\MessageAuthor;

use AppBundle\Controller\BaseController;
use AppBundle\Repository\MessageAuthorRepositoryAwareTrait;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ShowController
 * @package AppBundle\Controller\MessageAuthor
 *
 * @Route(
 *     service = "message_author_show_controller"
 * )
 */
class ShowController extends BaseController
{
    use MessageRepositoryAwareTrait;
    use MessageAuthorRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path         = "/{_locale}/message_author/show/{authorId}",
     *     name         = "message_author_show",
     *     requirements = {"authorId": "\d+"}
     * )
     *
     * @Route(
     *     path         = "/{_locale}/message_author/show/{authorId}/{page}",
     *     name         = "message_author_show_paginated",
     *     requirements = {"authorId": "\d+", "page": "[1-9]\d*"}
     * )
     *
     * @Template(
     *     "message_author/show.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $authorId = $request->get('authorId');

        $messageAuthor = $this->messageAuthorRepository->find($authorId);

        if (!$messageAuthor) {
            $this->addFlash(
                'warning',
                $this->getTranslator()->trans('warning.author_not_found')
            );

            return $this->redirect($this->generateUrl('message_author_list'));
        }

        $page = $request->get('page', 1);
        $messages = $this->messageRepository->findLatestForAuthor($messageAuthor, $page);

        return array(
            'messages' => $messages
        );
    }
}