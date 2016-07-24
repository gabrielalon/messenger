<?php

namespace ApiBundle\Controller\Message;

use ApiBundle\Controller\BaseController;
use AppBundle\Model\Message;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class GetController
 * @package ApiBundle\Controller\Message
 *
 * @Route(
 *     service = "api_message_get_controller"
 * )
 */
class GetController extends BaseController
{
    use MessageRepositoryAwareTrait;

    /**
     * @param Request $request
     *
     * @ApiDoc(
     *     resource    = true,
     *     description = "Displays hello world",
     *     output      = "string",
     *     statusCodes = {
     *          200 = "Returned when successful"
     *     }
     * )
     *
     * @Rest\Get(
     *     path         = "/message/get/{messageId}",
     *     requirements = {"messageId" = "\d+"}
     * )
     *
     * @return View
     */
    public function onInvoke(Request $request)
    {
        $messageId = $request->get('messageId');

        /** @var Message $message */
        $message = $this->messageRepository->find($messageId);

        if (!$message) {
            throw $this->createNotFoundException('Message not found');
        }

        return $this->view($message, Response::HTTP_OK);
    }
}