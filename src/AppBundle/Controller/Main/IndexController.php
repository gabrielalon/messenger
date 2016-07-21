<?php

namespace AppBundle\Controller\Main;

use Doctrine\ORM\EntityManager;
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
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * IndexController constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     *
     * @Route("/", name = "homepage")
     * @Route("/{_locale}/", name = "homepage_locale")
     * @Cache(maxage=3600)
     * @Template("main/index.html.twig")
     *
     * @return array
     */
    public function __invoke(Request $request)
    {
        return array(

        );
    }
}
