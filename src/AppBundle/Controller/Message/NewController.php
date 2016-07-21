<?php

namespace AppBundle\Controller\Message;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class NewController
 * @package AppBundle\Controller\Message
 * @Route(service="message_new_controller")
 */
class NewController extends Controller
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * NewController constructor.
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
     * @Route("/{_locale}/message/new", name="message_new")
     * @Cache(maxage=3600)
     * @Template("message/new.html.twig")
     *
     * @return array
     */
    public function __invoke(Request $request)
    {
        return array(

        );
    }
}