<?php

namespace AppBundle\Controller\Message;

use AppBundle\Controller\BaseController;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DeleteController
 * @package AppBundle\Controller\Message
 *
 * @Route(
 *     service = "message_delete_controller"
 * )
 */
class DeleteController extends BaseController
{
    use MessageRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path         = "/{_locale}/message/delete/{messageId}",
     *     name         = "message_delete",
     *     requirements = {"messageId" = "\d+"}
     * )
     *
     * @Cache(
     *     maxage = 3600
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
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($message);
            $entityManager->flush();

            $this->addFlash(
                'success',
                $this->getTranslator()->trans('notice.message_deleted')
            );
        }

        return $this->redirectToRoute('message_list');
    }
}