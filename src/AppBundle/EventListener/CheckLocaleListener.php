<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CheckLocaleListener
 * @package AppBundle\Listener
 */
class CheckLocaleListener
{
    /**
     * @var array
     */
    private $availableLocales;

    /**
     * CheckLocaleListener constructor.
     *
     * @param $availableLocales
     */
    public function __construct($availableLocales)
    {
        $this->availableLocales = $availableLocales;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function checkLocale(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($locale = $request->attributes->get('_locale')) {
            if (!in_array($locale, $this->availableLocales)) {
                throw new NotFoundHttpException();
            }
        }
    }
}