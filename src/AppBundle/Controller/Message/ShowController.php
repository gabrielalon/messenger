<?php

namespace AppBundle\Controller\Message;

use AppBundle\Model\Message;
use AppBundle\Repository\MessageRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ShowController
 * @package AppBundle\Controller\Message
 * @Route(service="message_show_controller")
 */
class ShowController extends Controller
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
    public function __construct(EntityManager $entityManager)
    {
        $this->messageRepository = $entityManager->getRepository('AppBundle:Message');
    }

    /**
     * @param Request $request
     *
     * @Route(
     *     path         = "/{_locale}/message/show/{messageId}",
     *     name         = "message_show",
     *     requirements = {"messageId" = "\d+"}
     * )
     * @Cache(maxage=3600)
     * @Template("message/show.html.twig")
     *
     * @return array
     */
    public function __invoke(Request $request)
    {
        $messageId = $request->get('messageId');

        /** @var Message $message */
        $message = $this->messageRepository->find($messageId);

        if (!$message) {
            throw $this->createNotFoundException(
                'No message: ' . $messageId
            );
        }

        return array(
            'message' => $message
        );
    }
}