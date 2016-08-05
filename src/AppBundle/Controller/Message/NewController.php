<?php

namespace AppBundle\Controller\Message;

use AppBundle\Controller\BaseController;
use AppBundle\Form\MessageType;
use AppBundle\Model\Message;
use AppBundle\Model\MessageAuthor;
use AppBundle\Repository\MessageAuthorRepositoryAwareTrait;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class NewController
 * @package AppBundle\Controller\Message
 *
 * @Route(
 *     service = "message_new_controller"
 * )
 */
class NewController extends BaseController
{
    use MessageRepositoryAwareTrait;
    use MessageAuthorRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/{_locale}/message/new",
     *     name = "message_new"
     * )
     *
     * @Cache(
     *     maxage = 3600
     * )
     *
     * @Template(
     *     "message/new.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $message = new Message();

        $messageAuthor = null;
        if ($request->isMethod('POST')) {
            $messageData = $request->get('message');
            /** @var MessageAuthor $messageAuthor */
            $messageAuthor = $this->messageAuthorRepository
                ->findOneByEmail($messageData['author']['email']);
        }

        if (!$messageAuthor) {
            $messageAuthor = new MessageAuthor();
            $messageAuthor->setCreatedAt(new \DateTime());
            $messageAuthor->setUpdatedAt(new \DateTime());
        }

        $message->setAuthor($messageAuthor);
        $form = $this->createForm(MessageType::class, $message, array(
            'action' => $this->generateUrl('message_new'),
            'method' => 'POST'
        ));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $message->setCreatedAt(new \DateTime());

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