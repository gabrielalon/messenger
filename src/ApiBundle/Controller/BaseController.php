<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\DataCollectorTranslator;

/**
 * Class BaseController
 * @package ApiBundle\Controller
 */
abstract class BaseController extends FOSRestController
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $this->onInvoke($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    abstract public function onInvoke(Request $request);

    /**
     * @return DataCollectorTranslator
     */
    protected function getTranslator()
    {
        return $this->get('translator');
    }
}