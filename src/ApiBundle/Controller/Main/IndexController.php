<?php

namespace ApiBundle\Controller\Main;

use ApiBundle\Controller\BaseController;
use ApiBundle\Model\Hello;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class IndexController
 * @package ApiBundle\Controller\Main
 */
class IndexController extends BaseController
{
    /**
     * Hello world action
     *
     * @ApiDoc(
     *     resource    = true,
     *     description = "This is simple action that displays hello world",
     *     output      = "string",
     *     statusCodes = {
     *          200 = "Returned when successful"
     *     }
     * )
     *
     * @Rest\Get(
     *     path         = "/hello.{_format}",
     *     requirements = {"_format": "json|xml"}
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
        return new Hello('world');
    }
}