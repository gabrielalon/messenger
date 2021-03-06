<?php

namespace AppBundle\Controller\Message;

use AppBundle\Controller\BaseController;
use AppBundle\Model\Message;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ShowController
 * @package AppBundle\Controller\Message
 *
 * @Route(
 *     service = "message_show_controller"
 * )
 */
class ShowController extends BaseController
{
    use MessageRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path         = "/{_locale}/message/show/{messageId}",
     *     name         = "message_show",
     *     requirements = {"messageId" = "\d+"}
     * )
     *
     * @Template(
     *     "message/show.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $messageId = $request->get('messageId');

        /** @var Message $message */
        $message = $this->messageRepository->find($messageId);

        if (!$message) {
            $this->addFlash(
                'warning',
                $this->getTranslator()->trans('warning.message_not_found')
            );

            return $this->redirect($this->generateUrl('message_list'));
        }

        $form = $this->createDeleteForm($message);

        return array(
            'message' => $message,
            'form' => $form->createView()
        );
    }
}