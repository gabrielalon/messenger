<?php

namespace AppBundle\Controller\Message;

use AppBundle\Controller\BaseController;
use AppBundle\Form\MessageType;
use AppBundle\Model\Message;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class EditController
 * @package AppBundle\Controller\Message
 *
 * @Route(
 *     service = "message_edit_controller"
 * )
 */
class EditController extends BaseController
{
    use MessageRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path         = "/{_locale}/message/edit/{messageId}",
     *     name         = "message_edit",
     *     requirements = {"messageId" = "\d+"}
     * )
     *
     * @Template(
     *     "message/edit.html.twig"
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

        $form = $this->createForm(MessageType::class, $message, array(
            'action' => $this->generateUrl('message_edit', array('messageId' => $message->getId())),
            'method' => 'POST'
        ));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash(
                'success',
                $this->getTranslator()->trans('notice.message_saved')
            );

            return $this->redirect($this->generateUrl('message_list'));
        }

        return array(
            'form' => $form->createView()
        );
    }
}