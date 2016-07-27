<?php

namespace ApiBundle\Controller\MessageAuthor;

use ApiBundle\Controller\BaseController;
use AppBundle\Model\MessageAuthor;
use AppBundle\Repository\MessageAuthorRepositoryAwareTrait;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class GetController
 * @package ApiBundle\Controller\MessageAuthor
 *
 * @Route(
 *     service = "api_message_author_get_controller"
 * )
 */
class GetController extends BaseController
{
    use MessageAuthorRepositoryAwareTrait;

    /**
     *
     * @ApiDoc(
     *     resource    = true,
     *     description = "Displays message author model",
     *     output      = "AppBundle\Model\MessageAuthor",
     *     statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when message author not found"
     *     }
     * )
     *
     * @Rest\Get(
     *     path         = "/message_author/get/{authorId}.{_format}",
     *     requirements = {"authorId" = "\d+", "_format": "json|xml"}
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
        $authorId = $request->get('authorId');

        /** @var MessageAuthor $messageAuthor */
        $messageAuthor = $this->messageAuthorRepository->find($authorId);

        if (!$messageAuthor) {
            throw $this->createNotFoundException('Message author not found');
        }

        return $messageAuthor;
    }
}