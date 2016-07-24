<?php

namespace ApiBundle\Controller\Main;

use ApiBundle\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class IndexController
 * @package ApiBundle\Controller\Main
 */
class IndexController extends BaseController
{
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
     *     path = "/",
     * )
     *
     * @return View
     */
    public function onInvoke(Request $request)
    {
        return $this->view(['Hello world'], Response::HTTP_OK);
    }
}