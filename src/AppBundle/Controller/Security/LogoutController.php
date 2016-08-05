<?php

namespace AppBundle\Controller\Security;

use AppBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class LogoutController
 * @package AppBundle\Controller\Security
 *
 * @Route(
 *     service = "security_logout_controller"
 * )
 */
class LogoutController extends BaseController
{

    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/{_locale}/logout",
     *     name = "security_logout"
     * )
     *
     * @Cache(
     *     maxage = 3600
     * )
     *
     * @Template(
     *     "security/logout.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();

        return array();
    }
}