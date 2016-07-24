<?php

namespace AppBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class IndexController
 * @package AppBundle\Controller\Home
 * @Route(service="main_index_controller")
 */
class IndexController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/",
     *     name = "homepage"
     * )
     *
     * @Route(
     *     path = "/{_locale}/",
     *     name = "homepage_locale"
     * )
     *
     * @Cache(
     *     maxage = 3600
     * )
     *
     * @Template(
     *     "main/index.html.twig"
     * )
     *
     * @return array
     */
    public function __invoke(Request $request)
    {
        return array(

        );
    }
}
