<?php
/**
 * Created by PhpStorm.
 * User: marekrode
 * Date: 27.07.2016
 * Time: 11:20
 */

namespace ApiBundle\Controller\Message;

use ApiBundle\Controller\BaseController;
use AppBundle\Repository\MessageRepositoryAwareTrait;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class ListController
 * @package ApiBundle\Controller\Message
 *
 * @Route(
 *     service = "api_message_list_controller"
 * )
 */
class ListController extends BaseController
{
    use MessageRepositoryAwareTrait;

    /**
     * This action returns a collection of message models
     *
     * @ApiDoc(
     *     resource    = true,
     *     description = "Displays collection of Message model",
     *     output      = "array",
     *     statusCodes = {
     *          200 = "Returned when successful",
     *          404 = "Returned when message not found"
     *     }
     * )
     *
     * @Rest\Get(
     *     path         = "/message/list.{_format}",
     *     requirements = {"_format": "json|xml"}
     * )
     *
     * @Rest\Get(
     *     path         = "/message/list/{page}.{_format}",
     *     requirements = {"page": "[1-9]\d*", "_format": "json|xml"}
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
        $page = $request->get('page', 1);
        $messages = $this->messageRepository->findAllPaginated($page);

        return $messages;
    }
}