<?php

namespace AppBundle\Controller\Message;

use AppBundle\Controller\BaseController;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class SearchController
 * @package AppBundle\Controller\Message
 *
 * @Route(
 *     service = "message_search_controller"
 * )
 */
class SearchController extends BaseController
{
    use MessageRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/{_locale}/message/search",
     *     name = "message_search"
     * )
     *
     * @Template(
     *     "message/search.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $term = $request->get('search');

        $messages = $this->messageRepository->findAllLikeContent($term);

        return array(
            'messages' => $messages
        );
    }
}