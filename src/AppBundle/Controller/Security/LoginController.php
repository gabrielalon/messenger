<?php

namespace AppBundle\Controller\Security;

use AppBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class LoginController
 * @package AppBundle\Controller\Security
 *
 * @Route(
 *     service = "security_login_controller"
 * )
 */
class LoginController extends BaseController
{
    /**
     * @param Request $request
     *
     * @Route(
     *     path = "/{_locale}/login",
     *     name = "security_login"
     * )
     *
     * @Cache(
     *     maxage = 3600
     * )
     *
     * @Template(
     *     "security/login.html.twig"
     * )
     *
     * @return array
     */
    public function onInvoke(Request $request)
    {
        $helper = $this->get('security.authentication_utils');

        return array(
            // last username entered by the user (if any)
            'last_login' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        );
    }
}