<?php

namespace ApiBundle\Controller\MessageAuthor;

use ApiBundle\Controller\BaseController;
use AppBundle\Model\MessageAuthor;
use AppBundle\Repository\MessageAuthorRepositoryAwareTrait;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     *     path         = "/message_author/get/{authorId}",
     *     requirements = {"authorId" = "\d+"}
     * )
     *
     * @return View
     */
    public function onInvoke(Request $request)
    {
        $authorId = $request->get('authorId');

        /** @var MessageAuthor $messageAuthor */
        $messageAuthor = $this->messageAuthorRepository->find($authorId);

        if (!$messageAuthor) {
            throw $this->createNotFoundException('Message author not found');
        }

        return $this->view($messageAuthor, Response::HTTP_OK);
    }
}