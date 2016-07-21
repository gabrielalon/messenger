<?php

namespace AppBundle\Controller\Message;

use AppBundle\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ListController
 * @package AppBundle\Controller\Message
 * @Route(service="message_list_controller")
 */
class ListController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * ListController constructor.
     *
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param Request $request
     *
     * @Route("/{_locale}/message/list", name="message_list")
     * @Cache(maxage=3600)
     * @Template("message/list.html.twig")
     *
     * @return array
     */
    public function __invoke(Request $request)
    {
        return array(

        );
    }
}