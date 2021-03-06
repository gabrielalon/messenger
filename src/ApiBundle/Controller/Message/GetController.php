<?php

namespace ApiBundle\Controller\Message;

use ApiBundle\Controller\BaseController;
use AppBundle\Model\Message;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
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
     * This action return a message model
     *
     * @ApiDoc(
     *     resource    = true,
     *     description = "Displays Message model",
     *     output      = "AppBundle\Model\Message",
     *     statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when message not found"
     *     }
     * )
     *
     * @Rest\Get(
     *     path         = "/message/get/{messageId}.{_format}",
     *     requirements = {"messageId" = "\d+", "_format": "json|xml"}
     * )
     *
     * @Rest\View()
     *
     * @param Request $request
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $messageId = $request->get('messageId');

        /** @var Message $message */
        $message = $this->messageRepository->find($messageId);

        if (!$message) {
            throw $this->createNotFoundException('Message not found');
        }

        return $message;
    }
}